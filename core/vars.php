<?php
$query = mysql_query('SELECT * FROM `templates` WHERE `active` = 1');
$activeTemplate = mysql_fetch_array($query);

$templatePath = "../templates/" . $activeTemplate['name'] . "/includes/";
?>