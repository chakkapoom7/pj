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
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>

    </head>

    <body>

    <br>



        <div class="jumbotron " style="border-width: 0 px; padding:30px 50px 20px 50px;" align="center">
        


		<div >
		<form action="backup2.php"  >
		<button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> สำรองข้อมูล</button>
		</form>
		</div>
		<br>

		</div>
<center>
	<br>หรือ<br><br><br>

</center>



		<div class="jumbotron " style="border-width: 0 px; padding:30px 50px 20px 50px;" align="center">
			<div >
				<form method=post action="upload.php" enctype="multipart/form-data" >
				<input type="file" name="backup" >
				<br>
				<button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-floppy-open" aria-hidden="true"></span> นำเข้าข้อมูล</button>
				</form>
			</div>		
			<br>










            
        </div>


    </body>

    </html>
