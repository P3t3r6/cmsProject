<?php
function loggedInLockPage() {
	if (loggedIn() === true) {
		header('location: index.php');
		exit();
	}
}

function protectPage() {
	if (loggedIn() === false) {
		header('location: protect.php');
		exit();
	}
}

function restrictionLevel($level){
	global $userData;
	if ($userData['level'] > $level){
		header('location:accessDenied.php');
		exit();
	}
}

function arraySanitize(&$item) {
	$item = mysql_real_escape_string($item);
}

function sanitize($data) {
	return mysql_real_escape_string($data);
}

function outputErrors($errors){
	if (empty($errors) === false){
		foreach($errors as $error){
			echo '&times; &nbsp;' . $error, '<br />';
		}
	}
}

function outputMessages($msg){
	if (empty($msg) === false){
		foreach($msg as $msg){
			echo '&#10004; &nbsp;' . $msg, '<br />';
		}
	}
}
?>