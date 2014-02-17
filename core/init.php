<?php
session_start();

require 'database/connect.php';

require 'vars.php';
require 'classes/article.php';
require 'functions/general.php';
require 'functions/users.php';
require 'functions/articles.php';

if (loggedIn() === true) {
	$sessionUserId = $_SESSION['userId'];
	$userData = userData($sessionUserId, 'userId', 'username', 'password', 'firstName', 'lastName', 'password', 'email');
	
	if (userActive($userData['username']) === false) {
		session_destroy();
		header('location: index.php');
		exit();
	}
}

$errors = array();
?>