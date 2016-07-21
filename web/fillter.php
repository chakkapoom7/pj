<?php
	session_start();
	if($_SESSION['userid'] == "")
	{
		echo "Please Login!";
		exit();
	}

	echo "date1 = " . $_POST['date1'] . "<br>";
    echo "time1 = " . $_POST['time1'] . "<br>";
    echo "date2 = " . $_POST['date2'] . "<br>";
    echo "time2 = " . $_POST['time2'] . "<br>";
    echo "type = " . $_POST['type'] . "<br>";
    echo "string = " . $_POST['string'] . "<br><br><br>";



	mysql_connect("localhost","root","kks*5cvp768");
	mysql_select_db("radius");
	$strSQL = "SELECT * FROM radcheck WHERE id = '".$_SESSION['userid']."' ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);


// Connects to your Database
 mysql_connect("localhost", "root", "kks*5cvp768") or die(mysql_error());
 mysql_select_db("radius") or die(mysql_error());

 #find userid on log table------------------------------------------------------------
 $tmp_string_user = "SELECT * FROM radcheck WHERE id = '".$_SESSION['userid']."' ";
 $ob_userid = mysql_query($tmp_string_user) or die(mysql_error());
 $objuserResult = mysql_fetch_array($ob_userid);



#------------------------------------------------------------------------------------------------------------------------------------------




 $sql_string_query = "SELECT * FROM radacct  ";
    



    $tmp = "";

    #start point --------------------------------------------------------
    if($_POST['date1'] != ""){
        $tmp_time = "00:00:";
        if($_POST['time1'] != "" ){
            $tmp_time = $_POST['time1'] ;
        }
        $tmp_time = $tmp_time . ":00:000";
        
        $tmp = $tmp . " AND a.time  >= '" . $_POST['date1'] . "T" . $tmp_time . "'";
    }

    #endpoint ------------------------------------------------------------
    if($_POST['date2'] != ""){
        $tmp_time = "00:00:";
        if($_POST['time2'] != "" ){
            $tmp_time = $_POST['time2'] ;
        }
        $tmp_time = $tmp_time . ":00:000";
        
        $tmp = $tmp . " AND a.time  <= '" . $_POST['date2'] . "T" . $tmp_time . "'";
    }
    
    #add AND for ip seach ---------------------------------------------------

    if($_POST['string'] != ""){
        
        #iden type of  ip  ------------------------------------------------------------------------
        if($_POST['type'] == 4){
            $table = "d.ip";
        }
        if($_POST['type'] == 6){
            $table = "e.ip";
        }
        if($_POST['type'] == 0){
            $table = "c.address";
        }
        
        
        #add string -------------------------------------------------------------------------------
         $tmp = $tmp . " AND " . $table . " = '" . $_POST['string'] . "'" ;
    }
    
    if($_POST['usersearch'] != ""){
        
        $tmp_string_user = "SELECT id FROM user WHERE user = '" . $_POST['usersearch'] . "'";
     
        echo "<br>" . $tmp_string_user ."<br>";
// $ob_userid = mysql_query($tmp_string_user) or die(mysql_error());
        //$objResult = mysql_fetch_array($ob_userid);
        
        
        $tmp = $tmp . " AND a.userid='" . $objResult[id] . "'" ;
    }
 




//echo "" . $tmp . "<br><br>";

    if($tmp != ""){
        $tmp = " WHERE" . substr($tmp,4) ;
    }


    
    #echo "$sql_string_query = " . $sql_string_query ;

    echo '<pre>';
    print_r($objResult);
    echo '</pre>';


    echo '<pre>';
    print_r($_POST);
    echo '</pre>';


    $sql_string_query = $sql_string_query . $tmp ."ORDER BY STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) DESC";

    echo $sql_string_query."<br>";


?>
    <form id="querystr" name="hidenform" method="post" action="infomation.php">
        <input type="text" id="aaa" name="query_str" value="<?php echo $sql_string_query ?>">
    </form>


    <script language="JavaScript">
        //document.hidenform.submit();

    </script>
