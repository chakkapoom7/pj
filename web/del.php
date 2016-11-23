<?php

mysql_connect("localhost","root","kks*5cvp768");
mysql_select_db("proj");



#####  session check 
	session_start();
	if($_SESSION['userid'] == "")
	{
		echo "Please Login!";
        header("location:index.php?error=3");
		exit();
	}

	if($_SESSION['permit'] != "ADMIN")
	{
		echo "you not have permission.";
		$permit = user ;
	}else{
        $permit = admin ;
    }	
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Dashboard Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>

<center>


<?php  

if($_POST[query_str] == "longterm"){
	
	$today = new DateTime('now');
	date_sub($today, date_interval_create_from_date_string('2 years'));
	#echo "<br>". date_format($today, 'Y-m-d')."<br>";


	$str_demo = "<br>ลบข้อมลก่อน ".date_format($today, 'Y-m-d')." แล้ว ";

}else if($_POST[query_str] == "shortterm"){


	$today = new DateTime('now');
	date_sub($today, date_interval_create_from_date_string('90 days'));
	#echo "<br>". date_format($today, 'Y-m-d')."<br>";

	$str_demo = "<br>ลบข้อมลก่อน ".date_format($today, 'Y-m-d')." แล้ว ";

}

    $strSQL = "DELETE FROM ipRef WHERE dateTime < '".date_format($today, 'Y-m-d')." 00:00:00'";
    
    #echo $strSQL."<br>";
    $objQuery = mysql_query($strSQL);
    #$objResult = mysql_fetch_array($objQuery);


	echo $str_demo;


################## if you want to delete row from radius uncomment this section  ##########################
mysql_connect("localhost","root","kks*5cvp768"); # radius serverip usermane and password
mysql_select_db("radius");  # radius access data table


$strSQL2 = "DELETE FROM radacct WHERE STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) < '".date_format($today, 'Y-m-d')." 00:00:00'";
    
$objQuery = mysql_query($strSQL2);

###########################################################################################################



?>


</center>
    </body>