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
		echo "you not have permission.";
        exit();
	}else{
        $permit = admin ;
    }	
	
	mysql_connect("localhost","root","kks*5cvp768");
	mysql_select_db("radius");
	$strSQL = "SELECT * FROM radcheck WHERE id = '".$_SESSION['userid']."' ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
?>




<?php
exec("rm -rf /var/www/html/uploads/*");
echo "<br><center>";
#===================== upload file ====================

$file=$_FILES['backup'];
$place2place="uploads"; //ระบุตำแหน่งที่เก็บไฟล์

echo "ชื่อของไฟล์ คือ ".$file[name]."<br>";
echo "ขนาดของไฟล์ คือ ".$file[size]." bytes<br>";
#echo "เนื้อหาของไฟล์ คือ ".$file[tmp_name]."<br>";
#echo "ชนิดของไฟล์ คือ ".$file[type]."<br><br>";

if(@copy($file[tmp_name],"$place2place/".$file[name]))
{
#if(eregi("^image",$file[type]))
#echo "<img src=\"$place2place/$file[name]\">";
#else
#echo "<a href=\"$place2place/$file[name]\">$file[name] </a>";
}
else
echo "ไม่มีทาง";








#============== unzip part ================

	$ZipName = "$place2place/".$file[name];
	$DesName = "uploads";
	require_once("lib/dunzip/dUnzip2.inc.php"); // include Class
	$zip = new dUnzip2($ZipName); // New Class
	$zip->unzipAll($DesName); // Unzip All 
	//$zip->unzip("thaicreate1.txt", $DesName."/thaicreate1.txt");  // Unzip one file
#	echo "<br><br>Extract to Folder <b>$DesName<b>";









#====================== sql paet =======================

$radserver_name   = "localhost";
$radusername      = "root";
$radpassword      = "kks*5cvp768";
$raddatabase_name = "radius";

$logserver_name   = "localhost";
$logusername      = "root";
$logpassword      = "kks*5cvp768";
$logdatabase_name = "proj";


$restore_filerad  = $place2place . "/". substr($file[name], 7, -4) . "_radius.sql";
$restore_filelog  = $place2place . "/". substr($file[name], 7, -4) . "_proj.sql";

$cmdrad = "mysql -h {$radserver_name} -u {$radusername} -p{$radpassword} {$raddatabase_name} < $restore_filerad";
$cmdlog = "mysql -h {$logserver_name} -u {$logusername} -p{$logpassword} {$logdatabase_name} < $restore_filelog";

#echo $cmdrad."<br>";
#echo $cmdlog."<br>";
exec($cmdrad);
exec($cmdlog);
echo "นำเข้าข้อมูลเสร็จสมบูรณ์<br>";

echo "</center>";
?>