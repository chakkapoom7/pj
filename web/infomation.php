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




        <!-- serachbox -->

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
      <!-- finish searchbox -->  
        




        










        
        <!-- for table table
        <div class="table-responsive" style="margin-top: 0px;"> -->
        <table class="table table-striped" style="margin-top: 0px;  padding:">
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
            <tbody>

  <?php
     # macvendor lib

    include "lib/MacvendorsApi.php";
    use \macvendors_co;

    $api = new \macvendors_co\MacVendorsApi();



$internalvender['key1'] = "value1";
$internalvender['key2'] = "value2";
$internalvender['key3'] = "value3";

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
         $strquery = "SELECT * FROM radacct ORDER BY STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) DESC ";
     }
     else{
         $strquery = "SELECT * FROM radacct WHERE username =  '".$objResult["username"]."' ORDER BY STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) DESC";
     }
 }
 else{
    $strquery = $_POST[query_str];
 }
  #echo     $strquery."   & ipfilter = ".$_POST[ip_filter]   ;                
                    
#query DB -----------------------------------------------------------------
 $data = mysql_query($strquery) or die(mysql_error());
#print table ------------------------------------------------------------
  while($info = mysql_fetch_array( $data ))
  {
    $filterFlag = 0;
    $strCHeck = "<tr> <td>".$info['username']. "</td> <td>".$info['acctstarttime']. "</td>";
    /*echo "";
    echo "<td>".$info['username']. "</td>";
    echo "<td>".$info['acctstarttime']. "</td>";
      */
    if($info['acctstoptime']==""){
        #echo "<td>connect until now</td>";
        $strCHeck = $strCHeck."<td>connect until now</td>";
    }else{
        #echo "<td>".$info['acctstoptime']. "</td>";
        $strCHeck = $strCHeck."<td>".$info['acctstoptime']. "</td>";
    }  
     
    #$vendor = $api->get_vendor ($info['callingstationid'],'csv');
    $macvendor = substr( $info['callingstationid'],0,8) ;


    # SEARCH INTERNAL IF HAVE BUT IF NOT USE API TO SHOW ADD INTERNAL 
    if (!(array_key_exists("$macvendor",$internalvender)))
    {
      $vendor = $api->get_vendor ($info['callingstationid'],'csv');
      $internalvender[$macvendor] = $vendor['company'];
      #echo " add \n";
    }
    /*
    else{
    
      echo " - \n";
    } 
  */



    #echo "<td>".$internalvender[$macvendor]."</td>"; #===========================
    $strCHeck = $strCHeck."<td>".$internalvender[$macvendor]."</td>";
    
    #echo "<td>".$info['callingstationid']. "</td>";
    $strCHeck = $strCHeck."<td>".$info['callingstationid']. "</td>";
      
    if($info['callingstationid'] == $_POST[ip_filter]){
      $filterFlag = 1;
    }


      ###########################################*/
      


     #echo "<td>";  
     $strCHeck = $strCHeck."<td>";

      $strsubquery = "SELECT `ip` FROM `proj`.`ipRef` WHERE `radRefId`= ".$info['radacctid'];

      
      
      $subdata = mysql_query($strsubquery) or die(mysql_error());

      
      
      while($subinfo = mysql_fetch_array( $subdata ))
      {
           #echo $subinfo['ip']."<br>";
          $strCHeck = $strCHeck.$subinfo['ip']."<br>";
          if($subinfo['ip'] == $_POST[ip_filter]){
            $filterFlag = 1;
          }
      }

      #echo "</td>";
      $subinfo['ip']."<br></td></tr>";
    
    #echo "</tr>";

    if($_POST[ip_filter] == "" ){
      echo $strCHeck;
    }else if($filterFlag == 1){
      echo $strCHeck;
    }

    

  }
 ?>
            </tbody>
        </table>
        <!-- </div> -->

    </body>

    </html>
