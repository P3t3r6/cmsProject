<?php
include '../core/init.php';
protectPage();

if (empty($_POST) === false) {
	$required = array('currentPassword', 'password', 'repeatPassword');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required) === true) {
			$errors[] = 'Please fill the required fields.';
			break 1;
		}
	}
	
	if (md5($_POST['currentPassword']) === $userData['password']) {
		if (trim($_POST['password']) !== trim($_POST['repeatPassword'])) {
			$errors[] = 'The new passwords do not match';
		} else if (strlen($_POST['password']) < 6) {
			$errors[] = 'Your password must be at least 6 characters long.';
		}
	} else {
		$errors[] = 'The current password is incorrect';
	}
	
	print_r($errors);
}

include '../templates/getTop.php';
?>

<h1 class="title">Change Password</h1>

<form action="" method="post">
		
		<p/><input name="currentPassword" class="registerInputText" type="text" placeholder="Current Password" required/>
		
		<p/><input name="password" class="registerInputText" type="text" placeholder="New Password" required/>

		<p/><input name="repeatPassword" class="registerInputText" type="text" placeholder="Repeat New Password" required/>
		
		<p/><input type="submit" value="Submit" action="" class="defaultBtn" style="font-weight:bold; font-size:11pt; margin:2px 10px;"/>
</form>

<?php include '../templates/getBot.php'; ?>