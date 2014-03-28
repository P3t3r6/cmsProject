<?php
require 'database/connect.php';
require 'vars.php';

global $name;
session_name($name);
session_start();

require 'classes/article.php';
require 'functions/general.php';
require 'functions/users.php';
require 'functions/articles.php';


if (loggedIn() === true) {
	$sessionUserId = $_SESSION['id'];
	
	global $userData;
	$userData = userData($sessionUserId, 'id', 'username', 'password', 'firstName', 'lastName', 'email', 'level', 'active');
	
	if (userActive($userData['username']) === false) {
		session_destroy();
		header('location: index.php');
		exit();
	}
}
?>