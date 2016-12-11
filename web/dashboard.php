<!DOCTYPE html>
<?php
	session_start();
	if($_SESSION['userid'] == "")
	{
		echo "Please Login!";
        header("location:index.php?error=3");
		exit();
	}

	if($_SESSION["permit"] != "ADMIN")
	{
		#echo "you not have permission.";
		#exit();
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

        <!-- Custom styles for this template -->
        <link href="./css/dashboard.css" rel="stylesheet">



    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">User Log Management System</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse" style="margin: 0.2cm;">
                    <ul class="nav navbar-nav navbar-right">



                        <li><font color="white">
                            <h5>User : <?php echo $objResult["username"];?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                            Permission : <?php echo $_SESSION["permit"]; ?> 
                                &nbsp;&nbsp;&nbsp;&nbsp;</h5>
                            </font>
                        </li>



                        <a href="logout.php" class="btn btn-danger" role="button">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span> logout
                        </a>



                    </ul>
                </div>
            </div>
        </nav>
<!--style="margin-top: 20px; -->
        <div class="container-fluid" ">
            
            
            <div class="col-sm-3 col-md-2 sidebar">

                <ul class="nav nav-sidebar" style="padding:0px 10px 0px 10px ">
                    <div class="jumbotron" style="padding:10px 10px 5px 10px">
                        <li>
                            <h4>User :  <?php echo $objResult["username"] ?>
                </h4>
                </li>
                <li>
                    <h5>Permission : <?php echo $_SESSION["permit"] ?> </h5></li>
                <p>
                    <div align="right"><a href="logout.php" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> logout</a></div>
                </p>
        </div>





  

        <li><a href="infomation.php" target="iframe555"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> userlog data<span class="sr-only">(current)</span></a></li>


        <li><a href="printreport.php" target="iframe555" ><span class="glyphicon glyphicon-print" aria-hidden="true"></span> print report</a></li>

        <?php 
            if($_SESSION["permit"] == "ADMIN"){
            print '

        <li><a href="backup2.php" target="iframe555" ><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> backup data data</a></li>

          
           '; } ?>




        </ul>

        </div>

    






 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="padding:0px 0px 0px 0px ; ">
    <iframe src="infomation.php" width="100%" height="600px" name="iframe555" margnheight="0" frameborder="0" ></iframe>
</div>


            <!-- Bootstrap core JavaScript
    ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="./js/jquery-3.1.1.min.js"></script>
            <script src="./js/bootstrap.min.js"></script>
    </body>

    </html>
