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



        <!-- for table table-->
        <div class="table-responsive">
            <table class="table table-striped">
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

    </body>

    </html>