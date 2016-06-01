#!/usr/bin/perl -w
use strict;
use warnings;
use DBI;
use Data::Dumper;
use List::Util 'max';

my $driver = "mysql";
my $database = "proj";
my $dsn = "DBI:$driver:database=$database";
my $userid = "root";
my $password = "kks*5cvp768";

my $dbh = DBI->connect($dsn, $userid, $password , {AutoCommit => 0,RaiseError => 1,} );

my @init;
my $switch_v6address;
my $interval;


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
      $line++ ;
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
  my $data = `snmpwalk -c public -v 1 udp6:[$ip_address] IP-MIB::ipNetToMediaPhysAddress`; ######### v4 snmp command ##
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
      #print "$bbb[$line][0]  $bbb[$line][1]\n";
      $line ++ ;
    }
  }

  return @bbb;
}



sub toDB

{my @datapack = @{$_[0]};
#  my (@datapack) = @_ ;
#  print "$datapack[0]  $datapack[1] \n";
    print "$datapack[0]  $datapack[1]  $datapack[2] \n";
}




#####################################################  get value #########################################
sub getValue{    
  print "getting data from switch. . . \n";
  my $taget_v6address = ($_[0]) ;
  my @v6Table ;
  my @v4Table ;

  (my $sec,my $min,my $hour,my $mday,my $mon,my $year,my $wday,my $yday,my $isdst) = localtime(time);

  print "time = $hour:$min:$sec\n";
  $year += 1900 ;
  $mon += 1;
  my $datetime = "$year-$mon-$mday $hour:$min:$sec";

  
  
  @v6Table = getv6($taget_v6address);
  ##########  @v6Table[$index][ 0 = mac | 1 = v6 ]  ###########



  @v4Table = getv4($taget_v6address);
  ##########  @vTable[$index][ 0 = mac | 1 = v6 ]  ###########

  
  my $qq;
  
 # foreach $qq (@v6Table){
 #   my @asd_f = {$qq[0],$qq[1]}
#    toDB(\@asd_f);
  #}
#  
#  foreach $qq (\@v4Table){
#    toDB($qq);
#  }

  print "send to database. . . \n";


}


########################################################### main ###########################################################


@init = getInitialValue();
$switch_v6address = $init[1];
$interval = $init[3];

print "time interval = $interval min\n";
print "switch address = $switch_v6address\n";
###while(1){
getValue($switch_v6address);
#  sleep($interval);
####}
