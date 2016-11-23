<?php
	session_start();
	if($_SESSION['userid'] == "")
	{
		echo "Please Login!";
		exit();
	}
/*
	echo "date1 = " . $_POST['date1'] . "<br>";
    echo "time1 = " . $_POST['time1'] . "<br><br>";
    echo "date2 = " . $_POST['date2'] . "<br>";
    echo "time2 = " . $_POST['time2'] . "<br><br>";
    echo "user = " . $_POST['usersearch'] . "<br>";
    echo "string = " . $_POST['string'] . "<br><br><br>";
*/


    mysql_connect("localhost","root","kks*5cvp768");
    mysql_select_db("radius");
    $strSQL = "SELECT * FROM radcheck WHERE id = '".$_SESSION['userid']."' ";
    $objQuery = mysql_query($strSQL);
    $objResult = mysql_fetch_array($objQuery);













$baseString = "SELECT * FROM radacct ";


$whereString = "" ;
$dateTime1 = "" ;
$dateTime2 = "" ;
$strString = "" ;
$userString = "" ;

    if($_POST['date1'] != ""){
        $tmp_time = "00:00";
        if($_POST['time1'] != "" ){
            $tmp_time = $_POST['time1'] ;
        }
        $tmp_time = $tmp_time . ":00:000";
        $dateTime1 = $_POST['date1']." ".$tmp_time ;
        $whereString = $whereString." AND STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) >  '".$dateTime1. "' "  ;
    }
    



    if($_POST['date2'] != ""){
        $tmp_time = "00:00";
        if($_POST['time2'] != "" ){
            $tmp_time = $_POST['time2'] ;
        }
        $tmp_time = $tmp_time . ":00:000";
        $dateTime2 = $_POST['date2']." ".$tmp_time ;
        $whereString = $whereString." AND STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) <  '".$dateTime2. "' "  ;
    }





    if($_SESSION['permit'] != "ADMIN"){
        $userString = $objResult["username"] ;
    }else{
        $userString = $_POST['usersearch'] ;
    }

    if($userString != ""){
        $whereString = $whereString." AND username = '".$userString. "' "  ;
    }


$orderString = "ORDER BY STR_TO_DATE( acctstarttime,  '%Y-%m-%d %H:%i:%s' ) DESC";










if($whereString != ""){
    $whereString = "WHERE ".substr( $whereString,4) ;
}

$sql_string_query = $baseString.$whereString.$orderString ;


?>


<!--
<br><br><br><br><br>
 strquery should =  <?php echo $whereString." <br> <br> " ;?>
<?php echo $sql_string_query ."<br>". $userString ." username =  ". $objResult["username"];?>
 <br><br>
<?php echo $dateTime1   ."   -------       ".  $dateTime2   .  "\"".$userString.  "\"" ; ?>
 <br><br><br>

-->



    <form id="querystr" name="hidenform" method="post" action="infomation.php">
        <input type="hidden" id="aaa" name="query_str" value="<?php echo $sql_string_query ;?>">
        <input type="hidden" id="bbb" name="ip_filter" value="<?php echo $_POST['string'] ;?>">
    </form>


    <script language="JavaScript">
        

        document.hidenform.submit();

    </script>
