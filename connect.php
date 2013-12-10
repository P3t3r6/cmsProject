<?php
	$connect_error = 'An error as ocurred. ini.php error_reporting(0); or connect.php';

	mysql_connect('localhost', 'root', '') or die($connect_error);
	mysql_select_db('') or die($connect_error);
	?>