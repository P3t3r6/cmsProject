<?php
include '../core/init.php';
loggedInLockPage();
include '../templates/getTop.php';

if (empty($_POST) === false) {
	$required = array('username', 'password', 'repeatPassword', 'firstName', 'email');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required) === true) {
			$errors[] = 'Please fill the required fields.';
			break 1;
		}
	}
	
	if (empty($errors) === true) {
		if (userExists($_POST['username']) === true) {
			$errors[] = 'Sorry, that username already exists.';
		}
		
		if (preg_match("/\\s/", $_POST['username']) == true) {
			$errors[] = 'Your username can not contain any spaces.';
		}
		
		if (strlen($_POST['password']) < 6) {
			$errors[] = 'Your password must be at least 6 characters long.';
		}
		
		if ($_POST['password'] !== $_POST['repeatPassword']) {
			$errors[] = 'Your passwords do not match.';
		}
		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'A valid email adress is required.';
		}
		
		if (emailExists($_POST['email']) === true) {
			$errors[] = 'Sorry, that email is already in use.';
		}
	}
}
?>

<?php
	if (isset($_GET['success']) && empty($_GET['success'])) {
	} else {
	echo '<h1 class="title">Register</h1>';
	};
?>

<h4 style="color:rgb(200,50,50)">
<?php
	if (isset($_GET['success']) && empty($_GET['success'])) {
		echo '<h3 style="color:rgb(50,150,50)"> You have been succefully registered! </h3>
			  <a href="index.php" class="defaultBtn" style="color:#fff;">Go to home</a>
			  ';
	} else {
	if (empty($_POST) === false && empty($errors) === true) {
		$registerData = array(
			'username' 			=> $_POST['username'],
			'password' 			=> $_POST['password'],
			'firstName' 		=> $_POST['firstName'],
			'lastName' 			=> $_POST['lastName'],
			'email' 			=> $_POST['email']
		);
		
		registerUser($registerData);
		header('location: register.php?success');
		exit();
		
	} else if (empty($errors) === false) {
		echo outputErrors($errors);
	}
	?>
	</h4>

	<form action="" method="post">
		<p/><input name="username" class="registerInputText" type="text" placeholder="Username" required/>

		<p/><input name="password" class="registerInputText" type="password" placeholder="Password" required/>

		<p/><input name="repeatPassword" class="registerInputText" type="password" placeholder="Repeat Password" required/>

		<p/><input name="firstName" class="registerInputText" type="text" placeholder="First Name" required/>

		<p/><input name="lastName" class="registerInputText" type="text" placeholder="Last Name" />

		<p/><input name="email" class="registerInputText" type="text" placeholder="Email" required/>


		<p/><input type="checkbox" required/> Li e aceito, bla bla bla, nobody cares, #YOLO#SWAG !

		<p/><input type="submit" value="Submit" action="" class="defaultBtn" style="font-weight:bold; font-size:11pt; margin:2px 10px;"/>
	</form>

<?php
}
include '../templates/getBot.php'; ?>