<?php
	session_start();
	


    mysql_connect("localhost","root","kks*5cvp768");


	mysql_select_db("radius");
	$strSQL = "SELECT * FROM radcheck WHERE username = '".mysql_real_escape_string($_POST['txtUsername'])."' 
	and value = '".mysql_real_escape_string($_POST['txtPassword'])."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);

    mysql_select_db("proj");
	$strSQL2 = "SELECT * FROM permit WHERE userid = '".mysql_real_escape_string($objResult[id])."' 
	";
	$objQuery2 = mysql_query($strSQL2);
	$objResult2 = mysql_fetch_array($objQuery2);
	

echo $_POST['txtUsername']."".$_POST['txtPassword']." --//-- ".$objResult[username]."".$objResult[value];

if(!$objResult2){
   $permittion = "USER";
}else{
    $permittion = "ADMIN";
}

echo $objResult2[userid];


    if(!$objResult)
	{	
        //echo " <h1><center> <br> ชื่อผู้ใช้ไม่ถูกต้อง <br><br> Username and Password Incorrect! </center></h1>";
        header("location:index.php?error=1");
	}	
    else
    {
			$_SESSION["userid"] = $objResult["id"];
			$_SESSION["permit"] = $permittion;

			session_write_close();
			
			if($permittion == "ADMIN")
			{
				header("location:dashboard.php");
			}
			else if($permittion == "USER")
			{
				header("location:userpage.php");
			}
            else
            {
                header("location:index.php?error=2");

            }
	}   

	mysql_close();
?>
