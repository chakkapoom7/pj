<?php

/*

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

*/

$restore_file  = "/home/abdul/20140306_world_copy.sql";
$server_name   = "localhost";
$username      = "root";
$password      = "root";
$database_name = "test_world_copy";

$cmd = "mysql -h {$server_name} -u {$username} -p{$password} {$database_name} < $restore_file";
exec($cmd);

?>