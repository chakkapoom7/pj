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
เพิ่มข้อมูลทดสอบ

<?php 


mysql_connect("localhost","root","kks*5cvp768"); # radius serverip usermane and password
mysql_select_db("radius");  # radius access data table


$strSQL2 = "INSERT INTO  `radius`.`radacct` (
`radacctid` ,
`username` ,
`acctstarttime` ,
`acctstoptime` ,
`callingstationid` 
)
VALUES (
'50', 'test','2012-01-31 00:00:00',  '2012-12-16 00:00:00', 'test delete 2 year'
)";
    
$objQuery = mysql_query($strSQL2);


$strSQL2 = "INSERT INTO  `radius`.`radacct` (
`radacctid` ,
`username` ,
`acctstarttime` ,
`acctstoptime` ,
`callingstationid` 
)
VALUES (
'52', 'test','2015-01-01 00:00:00',  '2015-12-16 00:00:00', 'test delete 90 day'
)";
    
$objQuery = mysql_query($strSQL2);




$strSQL2 = "INSERT INTO  `proj`.`ipRef` (
`radRefId` ,
`ip` ,
)
VALUES ( '50',  'test delete'
), (
NULL ,  '52',  'test delete'
);";
    
$objQuery = mysql_query($strSQL2);

?>



</center>
    </body>