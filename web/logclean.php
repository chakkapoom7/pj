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

        <div class="jumbotron " style="border-width: 0 px; padding:30px 50px 20px 50px;" align="left">

            <a class="btn btn-danger" role="button" data-toggle="modal" data-target=#myModal90d>
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> more than 90 days
            </a>
            ลบข้อมูลที่มีอายุมากกว่า 90 วัน
            <br>
            <br>
            <br>
            <a class="btn btn-warning" role="button" data-toggle="modal" data-target=#myModal2y>
                <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> more than 2 years
            </a>
            ลบข้อมูลที่มีอายุมากกว่า 2 ปี
            <br>
        </div>




<div class="container">
 
  <!-- Modal 90d-->
  <div class="modal fade" id="myModal90d" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.    90 d</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" >yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
          
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<!-- Modal 2y-->
  <div class="modal fade" id="myModal2y" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.     2y</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" >yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
          
        </div>
      </div>
      
    </div>
  </div>
  
</div>


    </body>

    </html>
