<!DOCTYPE html>
<?php
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
        exit();
	}else{
        $permit = admin ;
    }	
	
	mysql_connect("localhost","root","kks*5cvp768");
	mysql_select_db("radius");
	$strSQL = "SELECT * FROM radcheck WHERE id = '".$_SESSION['userid']."' ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
?>

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

        <div class="jumbotron " style="border-width: 0 px; padding:30px 50px 20px 50px;" align="left">

            <a href="logout.php" class="btn btn-danger" role="button">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> more than 90 days
            </a>
            ลบข้อมูลที่มีอายุมากกว่า 90 วัน
            <br>
            <br>
            <br>
            <a href="logout.php" class="btn btn-warning" role="button">
                <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> more than 2 years
            </a>
            ลบข้อมูลที่มีอายุมากกว่า 2 ปี
            <br>
        </div>


    </body>

    </html>
