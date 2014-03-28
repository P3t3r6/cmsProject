<?php
include '../core/init.php';

if (isset($_GET['regToken'])){
	$token = $_GET['regToken'];
	$query = mysql_query('SELECT COUNT(*) FROM `regtokens` WHERE `token` = \'' . $token . '\'');
	
	if (mysql_result($query, 0) >= 1){
		echo '<p style="color:#3b4; position:absolute; top:35px; left:20px;">Token Validated</p>';
		
		$query = mysql_fetch_assoc(mysql_query('SELECT * FROM `regtokens` WHERE `token` = \'' . $token . '\''));
		$level = (trim(strtolower($query['givenBy'])) == 'system' ? 1 : 3);
		registerPage($level);
	} else {
		global $errors;
		include '../templates/getTop.php';
		echo '<br /><center><span style="font-size:18pt; color:#c33;">Invalid Token</span><center>';
		include '../templates/getBot.php';
		exit();
	}
} else {
	protectPage();
	restrictionLevel(2);
}

include '../templates/getTop.php';
?>

<?php
	if (isset($_GET['success'])){
		if (isset($_GET['regToken'])){
			mysql_query('DELETE FROM `regtokens` WHERE `token` = \'' . $token . '\'');
		}
		?>
			<center>
				<br />
				<p style='color:#3b4;'> You have been succefully registered! </p>
				<a href="index.php"><button>Go to home</button></a>
			</center>
		<?php
	} else {
		?>
			<h1 class="pageTitle">Register</h1>
				<form method="post">
					<input name="username" type="text" placeholder="Username" required/>
					<br /><input name="password" type="password" placeholder="Password" required/>
					<br /><input name="repeatPassword" type="password" placeholder="Repeat Password" required/>
					<br /><input name="firstName" type="text" placeholder="First Name" required/>
					<br /><input name="lastName" type="text" placeholder="Last Name" />
					<br /><input name="email" type="text" placeholder="Email" required/>
					<br /><button type="submit" name="register" value="register" style="margin-left:2px; width:209px;"> Submit </button>
					<p style="color:rgb(200,50,50)"><?php outputErrors($errors); ?></p>
				</form>
		<?php
	}
include '../templates/getBot.php'; ?>