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

function levelRestriction($level){
	if ($userData['level'] === $level){
		
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
?>