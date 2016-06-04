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
		//echo "you not have permission.";
		$permit = Admin ;
	}else{
        $permit = user ;
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
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">

                    <ul class="nav nav-sidebar" style="padding:0px 10px 0px 10px ">
                        <div class="jumbotron" style="padding:10px 10px 5px 10px">
                            <li>
                                <h4>User : <?php echo $objResult["username"];?></h4></li>
                            <li>
                                <h5>Permission : Admin</h5></li>
                            <p>
                                <div align="right"><a href="logout.php" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> logout</a></div>
                            </p>
                        </div>

                        <li class="active"><a href="admin_page.php">userlog data<span class="sr-only">(current)</span></a></li>
                        <li><a href="admin_useredit.php">edit user</a></li>
                        <li><a href="admin_addmember.php">add new user</a></li>

                    </ul>

                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

                    <div class="jumbotron " style="padding:30px 50px 20px 50px" align="left">










                        <form class="form-signin" name="form0" method="post" action="find1.php">

                            <input type="hidden" id="aaa" name="username" value=<?php echo $objResult[ "Username"] ?>>

                            <div align="center">
                                <label for="time">date time between </label>

                                <input type="date" name="date1">
                                <input type="time" name="time1">

                                <label for="time">to</label>

                                <input type="date" name="date2">
                                <input type="time" name="time2">

                                <br>
                                <br>


                                <input type="radio" name="type" value="4" checked> IP(v4) Address &nbsp&nbsp&nbsp
                                <input type="radio" name="type" value="6"> IP(v6) Address &nbsp&nbsp&nbsp
                                <input type="radio" name="type" value="0"> Mac Address &nbsp&nbsp
                                <input type="text" class="form-control" style="width: 70%;" name="string" placeholder=" Address">

                                <br>

                                <input type="text" class="form-control" style="width: 70%;" name="usersearch" placeholder=" User">

                            </div>


                            <div align="right">
                                <button class="btn btn-primary" role="button" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"> Search</button>
        </div>
      </form>
        
     </div><!--jumbotron-->
            
            

            
            
            <!-- for table table-->
    <div class="table-responsive" >
    <table class="table table-striped" >
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>PhysicalAddress</th>
          <th>IP Address(v4)</th>
          <th>IP Address(v6)</th>
          <th>date time</th>
        </tr>
      </thead>
      <tbody>

<?php
 // Connects to your Database
 mysql_connect("localhost", "root", "kks*5cvp768") or die(mysql_error());
 mysql_select_db("proj") or die(mysql_error());

 #find userid on log table------------------------------------------------------------
 $tmp_string_user = "SELECT id FROM user WHERE user = '" . $objResult["Username"] . "'";
 $ob_userid = mysql_query($tmp_string_user) or die(mysql_error());
 $objuserResult = mysql_fetch_array($ob_userid);

#define sql str query------------------------------------------------------------------
if($_POST[query_str] == ""){
    $strquery = "SELECT a.id,b.user,c.address AS mac,d.ip AS ipv4,e.ip AS ipv6,a.time FROM log a LEFT JOIN user b ON a.userid=b.id LEFT JOIN mac c ON a.macid=c.id LEFT JOIN v4 d ON a.v4id=d.id LEFT JOIN v6 e ON a.v6id=e.id ORDER BY time DESC ;";
}
else{
   $strquery = $_POST[query_str];
}
#query DB -----------------------------------------------------------------
 $data = mysql_query($strquery) or die(mysql_error());
#print table ------------------------------------------------------------
  while($info = mysql_fetch_array( $data ))
  {
    print "<tr>";
     print "<td>".$info['id']. "</td>";
     print "<td>".$info['user']. "</td>";
     print "<td>".$info['mac']. "</td>";
     print "<td>".$info['ipv4']. "</td>";
     print "<td>".$info['ipv6']. "</td>";
     print "<td>".$info['time']. "</td>";
    print "</tr>";
  }
 ?>
     </tbody>
   </table>
   </div>
            
              
          </div>
            
          </div>
      </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>
