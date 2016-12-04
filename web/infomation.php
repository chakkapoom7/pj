<!DOCTYPE html>





<?php

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
		//echo "you not have permission.";
		$permit = user ;
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
<br>



        <!-- serachbox -->

        <div class="jumbotron " style="margin-bottom: 0px; margin: 0px border-width: 0 px; padding:30px 50px 20px 50px;" align="left">

            <form class="form-signin" name="form0" method="post" action="fillter.php" target="iframetable">

                <input type="hidden" id="aaa" name="username" value=<?php echo $objResult[ "Username"] ?>>

                <div align="center">
                    <label for="time">date time between </label>

                    <input type="date" name="date1">
                    <input type="time" name="time1">

                    <label for="time">and</label>

                    <input type="date" name="date2">
                    <input type="time" name="time2">

                    <br>


                    <!--
                    <input type="radio" name="type" value="4" checked> IP(v4) Address &nbsp&nbsp&nbsp
                    <input type="radio" name="type" value="6"> IP(v6) Address &nbsp&nbsp&nbsp
                    <input type="radio" name="type" value="0"> Mac Address &nbsp&nbsp
                    -->


                    <input type="text" class="form-control" style="width: 70%;" name="string" placeholder=" IP Address( v4 / v6 ) or MAC Address ">


                <?php
                  if($_SESSION['permit'] == "ADMIN"){
                    echo '
   
                          <input type="text" class="form-control" style="width: 70%;" name="usersearch" placeholder=" User">
                      
                      ';
                  }

                ?>
                </div>

                <div align="right">
                    <button class="btn btn-primary" role="button" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"> Search</button>
        </div>
      </form>
        
      </div> 
      <!-- finish searchbox --><!--
      <table class="table table-striped" style="margin-top: 0px;  padding: 0px">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>ACC time start</th>
                    <th>ACC time stop</th>
                    <th>Device Vender</th>
                    <th>Physical Address</th>
                    <th>IP Address</th>
                </tr>
            </thead>
        </table> 
-->
<iframe style="margin: 0px border-width: 0 px; padding: 0px;"  width="100%" height="390px" src="infomationtable.php" name="iframetable" margnheight="0" frameborder="0"></iframe>

    </body>

    </html>
