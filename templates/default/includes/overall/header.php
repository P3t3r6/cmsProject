<!DOCTYPE html>

<?php include $templatePath . 'includes/head.php'?>

<body>
	<input id="loginMenuHidder" type="checkbox" />
	
	<div id="loginMenu">	
		<label id="lmhButton" for="loginMenuHidder" onClick="stickyFooter()">&equiv;
			<span id="lmhName">
				<?php
					if (loggedIn() === true){
						echo $userData['username'];
					} else {
						echo 'Hi Guest!';
					}
				?>		
			</span>
		</label>
		
		<script type="text/javascript">
			function stickyFooter(){
				//alert('s1. loginMenu ' + $('#loginMenu').css('left') + '  footer ' + $('#footer').css('left'));
				
				if ($('#loginMenu').css('left') === '0px'){
					$('#footer').css('left', 0);
					setTimeout(function(){ $('body').css('overflow-x', 'auto'); },500);
				}
				
				if ($('#loginMenu').css('left') === '-250px'){
					$('#footer').css('left', 250);
					$('body').css('overflow-x', 'hidden');
				}
				
				//alert('2. loginMenu ' + $('#loginMenu').css('left') + '  footer ' + $('#footer').css('left'));
			}
			
			function updateFooter(){
				//alert('u1. loginMenu ' + $('#loginMenu').css('left') + '  footer ' + $('#footer').css('left'));
				
				if ($('#loginMenu').css('left') === '-250px'){
					$('#footer').css('left', 0);
					setTimeout(function(){ $('body').css('overflow-x', 'auto'); },500);
				}
				
				if ($('#loginMenu').css('left') === '0px'){
					$('#footer').css('left', 250);
					$('body').css('overflow-x', 'hidden');
				}
				
				//alert('2. loginMenu ' + $('#loginMenu').css('left') + '  footer ' + $('#footer').css('left'));
			}
			
			$(window).scroll(function(){
				if ($(this).scrollTop() > 120) {
					$('#lmhName').css('opacity', 0);
					$('#lmhName').css('left', 20);
				} else {
					$('#lmhName').css('opacity', 100);
					$('#lmhName').css('left', 31);
				}
			});
		</script>
		
		<br />
		<a href="../backoffice">Backoffice</a>
		
		<?php
		if (loggedIn() === false){
			if (isset($_POST['sidelogin'])){
				loginPage();
				?>
				<script type="text/javascript">
					$('#loginMenuHidder').prop('checked', true);
				</script>				
				<?php } ?>
				
			<form method="POST" style="margin: 15px auto;">
				<h1 class="articleTitle">Login</h1>
				<input type="text" name="username" placeholder="User" style="width:140px;" required/><br />
				<input type="password" name="password" placeholder="Password" style="width:140px;" required/><br />
				<button type="submit" name="sidelogin" style="padding:10px 0px; width:200px;">Login</button>
				<p style="font-size:10pt; color:#c33;"><?php if (isset($_POST['sidelogin'])){outputErrors($errors);} ?></p>
			</form>
		
		<h1 class="articleTitle">Register</h1>
		<a href="register.php">Register</a>
		
		<?php } else {
			echo '<br /><a href="?logout=logout">Get me outta here</a>';
		} ?>
	</div>
	
	<div id="mainDiv">
	
		<div id="logo">
			<?php include $templatePath . 'includes/logo.php'?>
		</div>
		
		<nav id="navMenu">
		 <ol id="menu">
		 	<?php include $templatePath . 'includes/menu.php'?>
		 </ol>
		</nav>
		
		<div id="pages">
			<!-- page display -->