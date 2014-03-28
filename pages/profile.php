<?php include '../core/init.php';
protectPage();
include '../templates/getTop.php'; ?>

<link rel="stylesheet" type="text/css" href="../plugins/imgareaselect/css/imgareaselect-default.css" />

<script type="text/javascript" src="../plugins/imgareaselect/scripts/jquery.imgareaselect.pack.js"></script>

<script type="text/javascript">
$(document).ready(function () {
	//alert("alert");
    $('img').imgAreaSelect({
		show: true,
		aspectRatio: '4:4',
        onSelectEnd: someFunction,
		x1: 120, y1: 90, x2: 280, y2: 210 
    });
});
</script>


<?php
if (isset($_FILES['file'])){
	$_FILES["file"]["name"] = $userData['id'] . '.jpg';
	move_uploaded_file($_FILES["file"]["tmp_name"], "../images/users/" . $_FILES["file"]["name"]);
}

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
	
	if (!$errors){
		global $userData;
		mysql_query('UPDATE users SET password = \'' . md5($_POST['password']) . '\' WHERE id = ' . $userData['id']);
		$msgs[] = 'Saved!';
	}
}
?>

<h1 class="pageTitle">Hello <?= $userData['firstName']; ?>!</h1>

<table style="padding:10px; width:100%;" cellspacing="5px">
	<tr>
		<td style="background:rgba(150,150,150,0.1); width:200px; padding:15px; vertical-align:top;">
			<center>Upload image</center>
			<br />
			<img src="<?= userImage(); ?>" style="width:200px; border-radius:3px;" />
			<br /><br />
			<form method="POST" enctype="multipart/form-data">
				<input style="width:100%; margin:15px 0px;" type="file" name="file"><br />
				<button style="width:100%;">Submit</button>
			</form>
		</td>
		
		<td style="background:rgba(150,150,150,0.1); width:200px; padding:15px; vertical-align:top;">
			<form method="POST">
				<center>Change Password</center>
				<br />
				<input name="currentPassword" type="password" placeholder="Current Password" required/>
				<br />
				<input name="password" type="password" placeholder="New Password" required/>
				<br />
				<input name="repeatPassword" type="password" placeholder="Repeat New Password" required/>
				<br />
				<button type="submit" value="Submit" style="width:210px; margin:2px;">Submit</button>
			</form>
			<br />
			<span style="color:#c33;"><?php outputErrors($errors); ?></span>
			<span style="color:#3b4;"><?php outputMessages($msgs); ?></span>
		</td>
		
		<td style="background:rgba(150,150,150,0.1); padding:15px; vertical-align:top;">
			Username 
			<br /><?= $userData['username'] ?>
			<br />
			<br />Name
			<br /><?= $userData['firstName'] . ' ' . $userData['lastName'] ?>
			<br />
			<br />Email
			<br /><?= $userData['email'] ?>
		</td>
	</tr>
</table>

<?php include '../templates/getBot.php'; ?>