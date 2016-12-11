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

*/
/*
$restore_file  = "/home/abdul/20140306_world_copy.sql";
$server_name   = "localhost";
$username      = "root";
$password      = "root";
$database_name = "test_world_copy";

$cmd = "mysql -h {$server_name} -u {$username} -p{$password} {$database_name} < $restore_file";
exec($cmd);
*/



?>
<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>