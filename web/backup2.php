<?php
define("BACKUP_PATH", "/var/www/html/backup/");
$date_string   = date("Y-m-d");

$radserver_name   = "localhost";
$radusername      = "root";
$radpassword      = "kks*5cvp768";
$raddatabase_name = "radius";

$logserver_name   = "localhost";
$logusername      = "root";
$logpassword      = "kks*5cvp768";
$logdatabase_name = "proj";

$dir_str = BACKUP_PATH."$date_string";
mkdir($dir_str, 0777);

$cmd1 = "mysqldump --routines -h {$radserver_name} -u {$radusername} -p{$radpassword} {$raddatabase_name} > " .$dir_str."/" . "{$date_string}_{$raddatabase_name}.sql";



$cmd2 = "mysqldump --routines -h {$logserver_name} -u {$logusername} -p{$logpassword} {$logdatabase_name} > " .$dir_str."/" . "{$date_string}_{$logdatabase_name}.sql";

#echo $cmd1;
#echo "<br>";
#echo $cmd1;

exec($cmd1);
exec($cmd2);
?>