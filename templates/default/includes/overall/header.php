<!DOCTYPE html>
<head>
	
	<title>cmsProject</title>

	<link rel="stylesheet" type="text/css" href="../templates/<?php echo $activeTemplate['name'] ?>/css/style.css"/>
	<link href="../images/favicon.ico?" rel="shortcut icon" type="image/x-icon"/>

	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js?ver=1.7.0'></script>	
	<script>
		jQuery(window).load(function(){
			jQuery('#loading').fadeOut(2000);
		});
	</script>
</head>

<body>
 <div id="loading"></div>
	<div id="mainDiv">
		<div id="logo">
			cmsProject
		</div>
		
		<nav id="navMenu">
		 <ol id="menu">
		 	<li>Home</li>
		 	<a href="http://facebook.com"><li>Downloads</li></a>
		 	<li>Docs
		 		<ol>
		 			<li>Tutorial</li>
		 			<li>Manual and guide</li>
		 			<li style="border-bottom:0px solid #fff;">API</li>
		 		</ol>
		 	</li>
		 	<li>About</li>
		 	<li style="border-right:0px solid #fff;">Contacts</li>
		 </ol>
		</nav>
		
		<div id="pages">
			<!-- page display -->