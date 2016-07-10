#!/usr/bin/perl -w

use strict;
use warnings;
use DBI;
use Data::Dumper;
use List::Util 'max';
use List::MoreUtils qw(uniq);

my $driver = "mysql";
my $database = "proj";
my $dsn = "DBI:$driver:database=$database";
my $userid = "root";
my $password = "kks*5cvp768";

my $dbh = DBI->connect($dsn, $userid, $password , {AutoCommit => 0,RaiseError => 1,} );

my @init;
my $switch_v6address;
my $interval;
my $datetimeGlobal;


my @arraynew88;
my @arraynew99;
sub addZero{
  my $tmpValue = $_[0];
  if((length $tmpValue) == 1){
    return "0$tmpValue";
  }else{
    return $tmpValue;
  }
}

sub macFormat{
  my $mac = $_[0];
  chomp($mac);
  $mac = uc($mac);
  #print "\n$mac\n";
  my @macElement = split(":",$mac);

  my $i;
  my $size = @macElement;
  for (my $i = 0 ; $i < $size  ; $i++ ){
    $macElement[$i] = addZero($macElement[$i]);
  }
  return "$macElement[0]-$macElement[1]-$macElement[2]-$macElement[3]-$macElement[4]-$macElement[5]";
}


sub getInitialValue{
  open(File,"config.cnf");

  my @AllFile = <File>;
  close(File);
  chomp @AllFile;
  return @AllFile;
}

sub v6_16to32{
  my $v16 = ($_[0]) ;
  my @pctmp = split(":",$v16);
  my $v32 = "$pctmp[0]$pctmp[1]:$pctmp[2]$pctmp[3]:$pctmp[4]$pctmp[5]:$pctmp[6]$pctmp[7]:$pctmp[8]$pctmp[9]:$pctmp[10]$pctmp[11]:$pctmp[12]$pctmp[13]:$pctmp[14]$pctmp[15]";
  #print "$v32";
  return $v32;
}

sub getv6{
  my $ip_address = $_[0] ;
  chomp($ip_address);
my i;
foreach $i (@arraynew99){

  #Using System Command and keep resault to $data
  my $data = `snmpwalk -c public -v 1 udp6:[$ip_address] IP-MIB::ipNetToPhysicalPhysAddress `;

  

  chomp($data);

  my @aaa = split("IP-MIB::ipNetToPhysicalPhysAddress.",$data);
  my @bbb ;
  my $line = 0;
  my $iden = 0;
  my $size = @aaa - 1 ;

  shift(@aaa);

  #loop
  for (my $i = 0 ; $i < $size  ; $i++ ){
    $iden=0;

    my $tmp = $i;
    my @tmp2 = split("\" = STRING: ",$aaa[$tmp]);
    chomp(@tmp2);

    #Fillter No mac address
    if(length($tmp2[1]) < 11 ){
      $iden++ ;
    }

    my @tmp3 = split(".ipv6.\"",$tmp2[0]);

    $tmp2[0] =	v6_16to32($tmp3[1]);

    $aaa[$tmp] = "mac: $tmp2[1] \t\tipv6: $tmp2[0]"; #######################################################

    if($iden == 0){
      $bbb[$line][0] = "$tmp2[1]";
     # print "$bbb[$line][0]  ";
      $bbb[$line][1] = "$tmp2[0]";
     # print "$bbb[$line][1]  \n";
      my $mmmmm = macFormat($bbb[$line][0]);
      my $nnnn = uc($bbb[$line][1]);
      toDB($mmmmm,$nnnn);
      $line++ ;
    }
  }

}

  #print "resault of v6:  $line  line    of  $size \n\n";
  #print "$bbb[0][0] - - $bbb[0][1]\n";

  return @bbb;
}

sub removeJ{
  my $pain = ($_[0]) ;
  my @tmp = split(/\./,$pain);
  my $removed = "$tmp[1].$tmp[2].$tmp[3].$tmp[4]";
  #print "$removed\n";
  return $removed;
}

sub getv4{
  my $ip_address = $_[0] ;


  chomp($ip_address);
  #Using System Command and keep resault to $data
  my $data = `snmpwalk -c public -v 1 udp6:[$ip_address] IP-MIB::ipNetToMediaPhysAddress  | grep 172.30.231.*`; ######### v4 snmp command ##
  chomp($data);


  #print "$data\n\n";


  my @aaa = split("IP-MIB::ipNetToMediaPhysAddress.",$data);
  my @bbb ;   #*************************
  my $line = 0;
  my $iden = 0;
  my $size = @aaa - 1 ;#**********************

  shift(@aaa);#*************

  #loop
  for (my $i = 0 ; $i < $size  ; $i++ ){
    $iden=0;

    my $tmp = $i;
    chomp($aaa[$tmp]);
    #print "aaa = $aaa[$tmp]\n";
    my @tmp2 = split(" = STRING: ",$aaa[$tmp]);
    chomp(@tmp2);
    #print "tmp2 = $tmp2[0] + $tmp2[1]\n";

    #Fillter No mac address
    if(length($tmp2[1]) < 11 ){
      $iden++ ;
    }

    if($iden == 0){
      $bbb[$line][0] = "$tmp2[1]";
      #removeJ($tmp2[0]);
      $bbb[$line][1] = removeJ($tmp2[0]);
      

      push @arraynew88, $bbb[$line][0];

      my $wwwwww = macFormat($bbb[$line][0]);
      toDB($wwwwww,$bbb[$line][1]);

      

      #print "$bbb[$line][0]  $wwwwww  $bbb[$line][1]\n";
      $line ++ ;
    }
    @arraynew99 = uniq @arraynew88;
  }

  return @bbb;
}



sub toDB

{my @datapack = @_;
#  my (@datapack) = @_ ;
#  print "$datapack[0]  $datapack[1] \n";
    #print "$datapack[0]  $datapack[1] \t $datetimeGlobal \n";

}




#####################################################  get value #########################################
sub getValue{    
  print "getting data from switch. . . \n";
  my $taget_v6address = ($_[0]) ;

  (my $sec,my $min,my $hour,my $mday,my $mon,my $year,my $wday,my $yday,my $isdst) = localtime(time);

  print "time = $hour:$min:$sec\n";
  $year += 1900 ;
  $mon += 1;
  my $datetime = "$year-$mon-$mday $hour:$min:$sec";

  $datetimeGlobal = $datetime;
  

#create array



getv4($taget_v6address);

# v4 to DB

#print "@arraynew88";

getv6($taget_v6address);

@arraynew88 = ();
@arraynew99 = ();


  print "\nsend to database. . . \n";


}


########################################################### main ###########################################################


@init = getInitialValue();
$switch_v6address = $init[1];
$interval = $init[3];

print "time interval = $interval min\n";
print "switch address = $switch_v6address\n";
###while(1){
getValue($switch_v6address);
#getValue($switch_v6address);
#  sleep($interval);
####}
