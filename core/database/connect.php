<?php
$connect_error = 'An error as ocurred. ini.php error_reporting(0); or connect.php';

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'cmsProject';

mysql_connect($dbHost, $dbUser, $dbPass) or die($connect_error);
mysql_select_db($dbName) or die($connect_error);
?>