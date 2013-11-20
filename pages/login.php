<?php
include '../core/init.php';
loggedInLockPage();
if (empty($_POST) == true) {header('location: index.php');}

if (empty($_POST) == false) {
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
			$_SESSION['userId'] = $login;
			header('location: index.php');
			exit();
		}
	}
} else {
	$errors = "Enter a Username and Password!";
}

	include '../templates/getTop.php';
	echo '<center>';
	
	echo '<h4 style="color:rgb(200,50,50); margin:0px;">';
	outputErrors($errors);
	echo '</h4>';
	
	include "../templates/" . $activeTemplate['name'] . "/includes/overall/widgets/login.php";
	
	
	echo '</center>';
	include "../templates/" . $activeTemplate['name'] . "/includes/overall/footerNoSidebar.php";
	
?>