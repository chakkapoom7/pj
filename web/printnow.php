<?php
    session_start();
    if($_SESSION['userid'] == "")
    {
        echo "Please Login!";
        exit();
    }
/*
    echo "date1 = " . $_POST['date1'] . "<br>";
    echo "time1 = " . $_POST['time1'] . "<br><br>";
    echo "date2 = " . $_POST['date2'] . "<br>";
    echo "time2 = " . $_POST['time2'] . "<br><br>";
    echo "user = " . $_POST['usersearch'] . "<br>";
    echo "string = " . $_POST['string'] . "<br><br><br>";


*/
    mysql_connect("localhost","root","kks*5cvp768");
    mysql_select_db("radius");
    $strSQL = "SELECT * FROM radcheck WHERE id = '".$_SESSION['userid']."' ";
    $objQuery = mysql_query($strSQL);
    $objResult = mysql_fetch_array($objQuery);













$baseString = "SELECT * FROM radacct ";


$whereString = "" ;
$where2 ="";
$dateTime1 = "" ;
$dateTime2 = "" ;
$strString = "" ;
$userString = "" ;

    if($_POST['date1'] != ""){
        $tmp_time = "00:00";
        if($_POST['time1'] != "" ){
            $tmp_time = $_POST['time1'] ;
        }
        $tmp_time = $tmp_time . ":00:000";
        $dateTime1 = $_POST['date1']." ".$tmp_time ;
        $whereString = $whereString." AND STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) >  '".$dateTime1. "' "  ;
        $where2 = $where2. " AND STR_TO_DATE( acctstoptime,  '%Y-%m-%d %H:%i:%s' ) >  '".$dateTime1. "' ";
    }
    



    if($_POST['date2'] != ""){
        $tmp_time = "23:59";
        if($_POST['time2'] != "" ){
            $tmp_time = $_POST['time2'] ;
        }
        $tmp_time = $tmp_time . ":59:000";
        $dateTime2 = $_POST['date2']." ".$tmp_time ;
        $whereString = $whereString." AND STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) <  '".$dateTime2. "' "  ;
        $where2 = $where2." AND STR_TO_DATE( acctstoptime,  '%Y-%m-%d %H:%i:%s' ) <  '".$dateTime2. "' "  ;
    }





    if($_SESSION['permit'] != "ADMIN"){
        $userString = $objResult["username"] ;
    }else{
        $userString = $_POST['usersearch'] ;
    }
    if($where2 != ""){
         $where2 = " OR ( " .substr( $where2,4). " ) ";
    }
   

    if($userString != ""){
        $where2 = $where2." AND username = '".$userString. "' "  ;
    }


$orderString = "ORDER BY STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) DESC";








    $whereString = $whereString.$where2;

if($whereString != ""){

    $whereString = "WHERE ".substr( $whereString,4) ;
}

$sql_string_query = $baseString.$whereString.$orderString ;




$datenow = new DateTime('now');
$printtime = $datenow->format('Y-m-d H:i:s');

$dateTime1 = substr($dateTime1, 0 ,-7);
$dateTime2 = substr($dateTime2, 0 ,-7);



$strdateshow = "";
if(($dateTime1 != "") && ($dateTime2 != "")){
    $strdateshow = "ระหว่างวันที่ ".$dateTime1." ถึง ".$dateTime2." <br>";
}elseif ($dateTime1 != "") {
    $strdateshow = "ตั้งแต่วันที่ ".$dateTime1." ถึงปัจจุบัน <br>";
}elseif ($dateTime2 != "") {
    $strdateshow = "ก่อนวันที่ ".$dateTime2." <br>";
}


#echo $strdateshow."<br>";



$strsearchshow="";
if ($_POST['string'] != "") {
    $strsearchshow = "กรองโดย IP Address หรือ MAC Address = '".$_POST['string']."' <br>";
}
#echo $strsearchshow."<br>";

$strusershow="";
if ($_SESSION['permit'] != "ADMIN") {
    $strusershow="ของผู้ใช้ ".$_SESSION['username']." <br>";
}elseif ($_POST['usersearch'] != "") {
    $strusershow = "ของผู้ใช้ ".$_POST['usersearch']." <br>";
}

require_once('lib/mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
ob_start(); // ทำการเก็บค่า html นะครับ
?>

    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
 



    </head>

    <body>

     <table border="0"  align="center" style="line-height : 60 pt ;">
            <thead>
                <tr >
                    <th><font size="6">ข้อมูลการเชื่อมต่อ และหมายเลข IP Address</font></th>
                </tr>
                <tr >
                    <th>
                        <?php 
                            echo $strusershow.$strdateshow.$strsearchshow;
                        ?>
                    </th>
                </tr>
                <tr >
                    <th>พิมพ์ข้อมูลเมื่อ : <?php  echo $printtime ?></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <br>




        <table border="1" cellPadding="10" style=" border-collapse: collapse;" align="center" >
            <thead>
                <tr style="background-color: #EEEEEE"><h2>
                    <th>Username</th>
                    <th>ACC time start</th>
                    <th>ACC time stop</th>
                    <th>Device Vender</th>
                    <th>Physical Address</th>
                    <th>IP Address</th>
                    </h2>
                </tr>
            </thead>
            <tbody>

  <?php
     # macvendor lib

    include "lib/MacvendorsApi.php";
    use \macvendors_co;

    $api = new \macvendors_co\MacVendorsApi();



$internalvender['key1'] = "value1";
$internalvender['key2'] = "value2";
$internalvender['key3'] = "value3";

 // Connects to your Database
 mysql_connect("localhost", "root", "kks*5cvp768") or die(mysql_error());
 mysql_select_db("radius") or die(mysql_error());

 #find userid on log table------------------------------------------------------------
 $tmp_string_user = "SELECT * FROM radcheck WHERE id = '".$_SESSION['userid']."' ";
 $ob_userid = mysql_query($tmp_string_user) or die(mysql_error());
 $objuserResult = mysql_fetch_array($ob_userid);

#define sql str query------------------------------------------------------------------
  $strquery = $sql_string_query;                  
 ##WHERE username =  '".$objResult["username"]."'


#print "====> ".$strquery."<br>";

  #echo     $strquery."   & ipfilter = ".$_POST[ip_filter]   ;                
                    
#query DB -----------------------------------------------------------------
 $data = mysql_query($strquery) or die(mysql_error());
#print table ------------------------------------------------------------
  while($info = mysql_fetch_array( $data ))
  {
    $filterFlag = 0;
    $strCHeck = "<tr> <td> ".$info['username']. " </td> <td>".$info['acctstarttime']. "</td>";
    /*echo "";
    echo "<td>".$info['username']. "</td>";
    echo "<td>".$info['acctstarttime']. "</td>";
      */
    if($info['acctstoptime']==""){
        #echo "<td>connect until now</td>";
        $strCHeck = $strCHeck."<td>connect until now</td>";
    }else{
        #echo "<td>".$info['acctstoptime']. "</td>";
        $strCHeck = $strCHeck."<td>".$info['acctstoptime']. "</td>";
    }  
     
    #$vendor = $api->get_vendor ($info['callingstationid'],'csv');
    $macvendor = substr( $info['callingstationid'],0,8) ;


    # SEARCH INTERNAL IF HAVE BUT IF NOT USE API TO SHOW ADD INTERNAL 
    if (!(array_key_exists("$macvendor",$internalvender)))
    {
      $vendor = $api->get_vendor ($info['callingstationid'],'csv');
      $internalvender[$macvendor] = $vendor['company'];
      #echo " add \n";
    }
    /*
    else{
    
      echo " - \n";
    } 
  */



    #echo "<td>".$internalvender[$macvendor]."</td>"; #===========================
    $strCHeck = $strCHeck."<td>".$internalvender[$macvendor]."</td>";
    
    #echo "<td>".$info['callingstationid']. "</td>";
    $strCHeck = $strCHeck."<td>".$info['callingstationid']. "</td>";
      
    if($info['callingstationid'] == $_POST[ip_filter]){
      $filterFlag = 1;
    }


      ###########################################*/
      


     #echo "<td>";  
     $strCHeck = $strCHeck."<td>";

      $strsubquery = "SELECT `ip` FROM `proj`.`ipRef` WHERE `radRefId`= ".$info['radacctid'];

      
      
      $subdata = mysql_query($strsubquery) or die(mysql_error());

      
      
      while($subinfo = mysql_fetch_array( $subdata ))
      {
           #echo $subinfo['ip']."<br>";
          $strCHeck = $strCHeck.$subinfo['ip']."<br>";
          if($subinfo['ip'] == $_POST[ip_filter]){
            $filterFlag = 1;
          }
      }

      #echo "</td>";
      $subinfo['ip']."<br></td></tr>";
    
    #echo "</tr>";

    if($_POST[ip_filter] == "" ){
      echo $strCHeck;
    }else if($filterFlag == 1){
      echo $strCHeck;
    }

    

  }
 ?>
            </tbody>
        </table>
        <!-- </div> -->

    </body>

    </html>



<?Php  
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4-L', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->setFooter('หน้าที่ {PAGENO}');
$pdf->WriteHTML($html, 2);
$pdf->Output("pdf/print.pdf","I");

?>