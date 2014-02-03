<!DOCTYPE html>
<head>
	
	<title>cmsProject</title>

	<link rel="stylesheet" type="text/css" href="../templates/<?php echo $activeTemplate['name'] ?>/css/style.css"/>
	<link href="../images/favicon.ico?" rel="shortcut icon" type="image/x-icon"/>

	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js?ver=1.7.0'></script>	
</head>

<body>
	<div id="mainDiv">
		<div id="logo">
			cmsProject
		</div>
		
		<nav id="navMenu">
		 <ol id="menu">
		 	<a href="index.php"><li>Home</li></a>
		 	<a href="archive.php"><li>Archive</li></a>
		 	<a href="downloads.php"><li>Downloads</li></a>
		 	<li>Docs
		 		<ol>
		 			<li>Tutorials</li>
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