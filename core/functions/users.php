<?php

function registerUser($registerData) {
	array_walk($registerData, 'arraySanitize');
	$registerData['password'] = md5($registerData['password']);
	
	$fields = '`' . implode('` , `', array_keys($registerData)) . '`';
	$data = '\'' .implode('\', \'', $registerData) . '\'';
	
	echo "INSERT INTO `users` ($fields) VALUES ($data)";
	
	mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
}

function userCount() {
	return mysql_result(mysql_query("SELECT COUNT(`userId`) FROM `users` WHERE `active` =  1 "), 0);
}

function userData($userId) {
	$data = array();
	$userId = (int)$userId;
	
	$funcNumArgs = func_num_args();
	$funcGetArgs = func_get_args();
	
	if ($funcNumArgs > 1) {
		unset($funcGetArgs[0]);
		
		$fields = '`' . implode('`, `', $funcGetArgs) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `userId` = $userId"));
		return $data;
	}
	
	//print_r($funcGetArgs);
	//echo $funcNumArgs;
	//echo $fields;
}

function loggedIn() {
	return (isset($_SESSION['userId'])) ? true : false;
}

function userExists($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`userId`) FROM `users` WHERE `username` = '$username'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function userActive($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`userId`) FROM `users` WHERE `username` = '$username' AND `active` = 1");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function userIdFromUsername($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT `userId` FROM `users` WHERE `username` = '$username'");
	return mysql_result($query, 0, 'userId');
}

function emailExists($email) {
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`userId`) FROM `users` WHERE `email` = '$email'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function login($username, $password) {
		$userId = userIdFromUsername($username);
		
		$username = sanitize($username);
		$password = md5($password);
		
		$query = mysql_query("SELECT COUNT(`userId`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
		return (mysql_result($query, 0) == 1) ? $userId : false;
		//return mysql_result($query, 0, 'userId');
}
?>