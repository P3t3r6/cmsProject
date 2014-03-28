<?php
include '../core/init.php';
loginPage();
include '../templates/getTop.php';
?>

<center>
<br /><br />
<h4 style="color:rgb(200,50,50); margin:0px;">Please login to continue</h4>
<span style="color:rgb(200,50,50);"><?php echo outputErrors($errors); ?></span>

	<form method="POST" style="margin: 15px auto;">
		<input type="text" name="username" placeholder="User" required/>
		<br />
		<input type="password" name="password" placeholder="Password" required/>
		<br /><br />
		<button type="submit" style="padding:10px 60px;">Login</button>
	</form>
	
</center>

<?php include '../templates/getBot.php'; ?>