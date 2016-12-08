<?php
define("BACKUP_PATH", "/var/www/html/backup/");
require_once('lib/dunzip/dZip.inc.php'); // include Class
$date_string   = date("Y-m-d");

$radserver_name   = "localhost";
$radusername      = "root";
$radpassword      = "kks*5cvp768";
$raddatabase_name = "radius";

$logserver_name   = "localhost";
$logusername      = "root";
$logpassword      = "kks*5cvp768";
$logdatabase_name = "proj";


$cmd1 = "mysqldump --routines -h {$radserver_name} -u {$radusername} -p{$radpassword} {$raddatabase_name} > " .BACKUP_PATH . "{$date_string}_{$raddatabase_name}.sql";



$cmd2 = "mysqldump --routines -h {$logserver_name} -u {$logusername} -p{$logpassword} {$logdatabase_name} > " .BACKUP_PATH . "{$date_string}_{$logdatabase_name}.sql";

#echo $cmd1;
#echo "<br>";
#echo $cmd1;

exec($cmd1);
exec($cmd2);


	$ZipName = "backup/".$date_string.".zip";

	$zip = new dZip($ZipName); // New Class
	$zip->addFile("/var/www/html/backup/{$date_string}_{$raddatabase_name}.sql", "{$date_string}_{$raddatabase_name}.sql"); // Source,Destination
	$zip->addFile("/var/www/html/backup/{$date_string}_{$logdatabase_name}.sql", "{$date_string}_{$logdatabase_name}.sql");
	#$zip->addDir($dir_str); // Add Folder
	#$zip->addFile("{$date_string}_{$logdatabase_name}.sql", BACKUP_PATH. "{$date_string}_{$logdatabase_name}.sql"); // Add file to Sub
	#$zip->addFile("{$date_string}_{$logdatabase_name}.sql", BACKUP_PATH . "{$date_string}_{$raddatabase_name}.sql");
	$zip->save();
	echo "Zip Successful Click <a href=$ZipName>here</a> to Download";

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<!--
<script type="text/javascript">
	window.location = "<?php echo $ZipName; ?>";
</script>  -->
</body>
</html>