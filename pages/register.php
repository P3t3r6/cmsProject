<?php
include '../core/init.php';
registerPage(4);
include '../templates/getTop.php';
?>

<?php
	if (isset($_GET['success'])){
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