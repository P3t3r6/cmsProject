<?php
if (isset($_POST['sidelogin'])){
	loginPage();
?>
	<script type="text/javascript">
		$('#loginMenuHidder').prop('checked', true);
	</script>				
<?php } ?>

<form method="POST" style="margin:20px auto;">
	<h1 class="articleTitle">Login</h1>
	<input type="text" name="username" placeholder="User" style="width:140px;" required/><br />
	<input type="password" name="password" placeholder="Password" style="width:140px;" required/><br />
	<button type="submit" name="sidelogin" style="padding:10px 0px; width:200px;">Login</button>
	<p style="font-size:10pt; color:#c33;"><?php if (isset($_POST['sidelogin'])){outputErrors($errors);} ?></p>
</form>
<br />
<h1 class="articleTitle" style="font-size:15pt;">Not a member yet?</h1>
<a href="register.php"><button style="width:100%;">Register</button></a>