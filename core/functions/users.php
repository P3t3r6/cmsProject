<?php

function userCount(){
	return mysql_result(mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `active` =  1 "), 0);
}

function userData($userId){
	$data = array();
	$userId = (int)$userId;
	
	$funcNumArgs = func_num_args();
	$funcGetArgs = func_get_args();
	
	if ($funcNumArgs > 1) {
		unset($funcGetArgs[0]);
		
		$fields = '`' . implode('`, `', $funcGetArgs) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `id` = $userId"));
		return $data;
	}
	
	//print_r($funcGetArgs);
	//echo $funcNumArgs;
	//echo $fields;
}

function loggedIn(){
	return (isset($_SESSION['id'])) ? true : false;
}

function userExists($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `username` = '$username'");
	return (mysql_result($query, 0) >= 1) ? true : false;
}

function userActive($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `username` = '$username' AND `active` = 1");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function userIdFromUsername($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT `id` FROM `users` WHERE `username` = '$username'");
	return mysql_result($query, 0, 'id');
}

function emailExists($email){
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `email` = '$email'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function newRegToken(){
	$token = md5(rand(100,2000));
	
	global $userData;
	
	$countQuery = 'SELECT COUNT(*) FROM regtokens WHERE givenBy = \'' . $userData['username'] . '\'';
	
	if (mysql_result(mysql_query($countQuery), 0) >= 3){
		global $errors;
		$errors[] = 'There can only be 3 tokens given by you at the same time.';
	} else {
		$query = 'INSERT INTO `regtokens` (`id`, `token`, `level`, `givenBy`) VALUES (NULL, \'' . $token . '\', 3, \'' . $userData['username'] . '\')';
		mysql_query($query);
		
		global $errors;
		$errors[] = 'Token created';
		$errors[] = '<a style="color:#3b4;" href="register.php?regToken=' . $token . '">backoffice/register.php?regToken=' . $token . '</a>';
	}
}

function registerUser($registerData){
	array_walk($registerData, 'arraySanitize');
	$registerData['password'] = md5($registerData['password']);
	
	$fields = '`' . implode('` , `', array_keys($registerData)) . '`';
	$data = '\'' .implode('\', \'', $registerData) . '\'';
	
	//echo "INSERT INTO `users` ($fields) VALUES ($data)";
	
	if (mysql_query("INSERT INTO `users` ($fields) VALUES ($data)")){
		return true;
	}
}

function registerPage(){
	if (isset($_POST['register'])){
		global $errors;
		$required = array('username', 'password', 'repeatPassword', 'firstName', 'email');
		
		foreach($_POST as $key=>$value) {
			if (empty($value) && in_array($key, $required) === true) {
				$errors[] = 'Please fill the required fields.';
				break 1;
			}
		}
		
		if (userExists($_POST['username']) === true) {
			$errors[] = 'Sorry, that username already exists.';
		}
		
		if (preg_match("/\\s/", $_POST['username']) == true) {
			$errors[] = 'Your username cannot contain any spaces.';
		}
		
		if (strlen($_POST['password']) < 6) {
			$errors[] = 'Your password must be at least 6 characters long.';
		}
		
		if ($_POST['password'] !== $_POST['repeatPassword']) {
			$errors[] = 'Your passwords do not match.';
		}
		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'A valid email address is required.';
		}
		
		if (emailExists($_POST['email']) === true) {
			$errors[] = 'Sorry, that email is already in use.';
		}
		
		if (empty($errors) === true){
		
			$registerData = array(
				'username' 	=> $_POST['username'],
				'password' 	=> $_POST['password'],
				'firstName' => $_POST['firstName'],
				'lastName' 	=> $_POST['lastName'],
				'email' 	=> $_POST['email']
			);
			
			if (registerUser($registerData)){
				if (empty($_GET)){
					header('location:?success');
					exit();
				} else {
				
					if (isset($_GET['regToken'])){
						header('location:?regToken=' . $_GET['regToken'] . '&success');
						exit();
					}
					
					header('location:&success');
					exit();
				}
			} else {
				echo 'error on register';
			}
		}
	}
}

function login($username, $password){
	$userId = userIdFromUsername($username);
	
	$username = sanitize($username);
	$password = md5($password);
	
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
	return (mysql_result($query, 0) == 1) ? $userId : false;
	//return mysql_result($query, 0, 'userId');
}

function loginPage(){
	loggedInLockPage();
	global $errors;
	
	if (empty($_POST) == false){
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username) == true || empty($password) == true) {
			$errors[] = 'Enter a Username and Password!';
		} else if (userExists($username) == false) {
			$errors[] = 'This User does not exist!';
		} else {
			$login = login($username, $password);
			if ($login == false) {
				$errors[] = 'Incorrect Password for this User!';
			} else if (userActive($username) == false) {
			$errors[] = 'Activate your account first!';
			} else {
				$_SESSION['id'] = $login;
				header('location: index.php');
				exit();
			}
		}
	} else {
		//$errors[] = "Enter a Username and Password!";
	}
}

if (isset($_POST['logout']) or isset($_GET['logout'])){
	logout();
}

function logout(){
	session_start();
	session_destroy();
	header('location: index.php');
}

?>