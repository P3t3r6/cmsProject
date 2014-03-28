<!DOCTYPE html>

<?php include $templatePath . 'includes/head.php'?>

<body>
	<input id="loginMenuHidder" type="checkbox" />
	
	<div id="loginMenu">
		<?php include $templatePath . 'includes/sidebar.php'?>
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