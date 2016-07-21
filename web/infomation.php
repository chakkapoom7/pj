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

        <div class="jumbotron " style="border-width: 0 px; padding:30px 50px 20px 50px;" align="left">



            <form class="form-signin" name="form0" method="post" action="fillter.php">

                <input type="hidden" id="aaa" name="username" value=<?php echo $objResult[ "Username"] ?>>

                <div align="center">
                    <label for="time">date time between </label>

                    <input type="date" name="date1">
                    <input type="time" name="time1">

                    <label for="time">and</label>

                    <input type="date" name="date2">
                    <input type="time" name="time2">

                    <br>

                    <input type="radio" name="type" value="4" checked> IP(v4) Address &nbsp&nbsp&nbsp
                    <input type="radio" name="type" value="6"> IP(v6) Address &nbsp&nbsp&nbsp
                    <input type="radio" name="type" value="0"> Mac Address &nbsp&nbsp
                    <input type="text" class="form-control" style="width: 70%;" name="string" placeholder=" Address">

                    <input type="text" class="form-control" style="width: 70%;" name="usersearch" placeholder=" User">

                </div>


                <div align="right">
                    <button class="btn btn-primary" role="button" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"> Search</button>
        </div>
      </form>
        
     </div> 
        
        
        <!-- for table table
        <div class="table-responsive" style="margin-top: 0px;"> -->
        <table class="table table-striped" style="margin-top: 0px;  padding:">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>ACC time start</th>
                    <th>ACC time stop</th>
                    <th>Type</th>
                    <th>Physical Address</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>

                <?php
 // Connects to your Database
 mysql_connect("localhost", "root", "kks*5cvp768") or die(mysql_error());
 mysql_select_db("radius") or die(mysql_error());

 #find userid on log table------------------------------------------------------------
 $tmp_string_user = "SELECT * FROM radcheck WHERE id = '".$_SESSION['userid']."' ";
 $ob_userid = mysql_query($tmp_string_user) or die(mysql_error());
 $objuserResult = mysql_fetch_array($ob_userid);

#define sql str query------------------------------------------------------------------
                    
                    ##WHERE username =  '".$objResult["username"]."'
 if($_POST[query_str] == ""){
     if($_SESSION['permit'] == "ADMIN"){
         $strquery = "SELECT * FROM radacct  ORDER BY STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) DESC LIMIT 0 , 100";
     }
     else{
         $strquery = "SELECT * FROM radacct WHERE username =  '".$objResult["username"]."' ORDER BY STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) DESC LIMIT 0 , 100";
     }
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
    print "<td>".$info['username']. "</td>";
    print "<td>".$info['acctstarttime']. "</td>";
      
    if($info['acctstoptime']==""){
        print "<td>connect until now</td>";
    }else{
        print "<td>".$info['acctstoptime']. "</td>";
    }  
      

    print "<td>".$info['nasporttype']. "</td>";
    print "<td>".$info['callingstationid']. "</td>";
      
      

      
      
     print "<td>";  
      
      if($info['acctstoptime'] == ""){
          
          $strsubquery = "SELECT DISTINCT  `ip` 
FROM  `proj`.`macIP` 
WHERE  `mac` =  '".$info['callingstationid']."'
AND  `date-time` >=  '".$info['acctstarttime']."'
AND  `date-time` <=  '".date("Y-m-d H:i:sa")."';";
          

      }
      else  {
          $strsubquery = "SELECT DISTINCT  `ip` 
FROM  `proj`.`macIP` 
WHERE  `mac` =  '".$info['callingstationid']."'
AND  `date-time` >=  '".$info['acctstarttime']."'
AND  `date-time` <=  '".$info['acctstoptime']."';";
      }
      
      #print $strsubquery."<br>";
      
      
      $subdata = mysql_query($strsubquery) or die(mysql_error());

      
      
      while($subinfo = mysql_fetch_array( $subdata ))
      {
           print $subinfo['ip']."<br>";
      }
      print "</td>";

    
    print "</tr>";
  }
 ?>
            </tbody>
        </table>
        <!-- </div> -->

    </body>

    </html>
