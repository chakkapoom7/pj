<?php
	session_start();
	


    mysql_connect("localhost","root","kks*5cvp768");
	mysql_select_db("proj");
	$strSQL = "SELECT * FROM member WHERE Username = '".mysql_real_escape_string($_POST['txtUsername'])."' 
	and Password = '".mysql_real_escape_string($_POST['txtPassword'])."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	


    if(!$objResult)
	{
			
        echo " <h1><center> <br> ชื่อผู้ใช้ไม่ถูกต้อง <br><br> Username and Password Incorrect! </center></h1>";
        header("location:index.php?fail=true");
	}	
    else
    {
			$_SESSION["UserID"] = $objResult["UserID"];
			$_SESSION["Status"] = $objResult["Status"];

			session_write_close();
			
			if($objResult["Status"] == "ADMIN")
			{
				header("location:admin_page.php");
			}
			else if($objResult["Status"] == "USER")
			{
				header("location:userpage.php");
			}
            else
            {
                header("location:index.php?fail=true");
                

            }
	}
	mysql_close();
?>
