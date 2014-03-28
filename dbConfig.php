<?php
session_start();
?>
<html>
<head>
	<title>Welcome</title>
	<style type="text/css">
	
		@font-face {
			font-family: 'Poiret One';
			font-style: normal;
			font-weight: 400;
			src: url('resources/PoiretOne-Regular.ttf');
		}
		
		a, a:active, a:focus, a:visited, a:hover{
			color:#fff;
		}
		
		html{
			margin:0px;
			padding:0px;
		}
		
		body{
			background:#111;
			color:#eee;
			text-align:center;
			padding:25px 0px;
			margin:0px;
			min-width:1080px;
			font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
			font-size:15pt;
			line-height:20pt;
		}
		
		input{
			padding:10px 50px 10px 10px;
			border:0px;
			transition:all 0.3s;
		}
		
		input:focus{
			padding:10px 100px 10px 10px;
		}
		
		button{
			padding:10px 20px;
			border:0px;
			background:#222;
			color:#fff;
			cursor:pointer;
			transition:all 0.3s;
		}
		
		button:hover{
			background:#fff;
			color:#000;
		}
		
		.button{
			background:#222;
			color:#fff;
			font-size:11pt;
			padding:8px 15px;
			border:0px;
			cursor:pointer;
			text-decoration:none;
			transition:all 0.3s;
		}
		
		.button:hover{
			background:#fff;
			color:#000;
		}
		
		label{
			cursor:pointer;
		}
		
		ul{
			list-style:none;
			text-align:left;
			display:inline-block;
			padding:0px;
			margin:0px;
		}
		
		#menuHiderlabel{
			background:#222;
			color:#eee;
			font-size:11pt;
			display:block;
			width:100%;
			margin:0px auto;
			padding:0px;
			transition:all 0.5s;
		}
		
		#menuHiderlabel:hover{
			background:#eee;
			color:#222;
		}
		
		#menuHider{
			display:none;
		}
		
		#menuHider:checked ~ #menu{
			max-height:90px;
		}
		
		#menuHider:checked ~ #menu li{
			-webkit-transform: translateY(0%);
			opacity:1;
		}
		
		#menu{
			border:0px solid red;
			background:#fff;
			color:#333;
			font-size:12pt;
			padding:0px;
			margin:0px;
			display:block;
			overflow:hidden;
			box-shadow:inset 0px 5px 10px rgba(0,0,0,0.2);
			max-height:0px;
			transition:all 0.5s;
		}
		
		#menu li{
			float:left;
			display:inline;
			width:24.3%;
			margin:0px;
			padding:10px 0px 10px 1%;
			text-align:left;
			opacity:0;
			cursor:pointer;
			-webkit-transform: translateY(-200%);
			transition:-webkit-transform 0.5s, opacity 1s, background 0.2s, color 0.2s;
		}
		
		#menu li:hover{
			background:#222;
			color:#eee;
		}
	
		.binary_switch {
			display:inline-block;
			position:relative;
			width:24px;
			height:14px;
			margin-top:-3px;
			vertical-align:middle;
			cursor:pointer;
		}

		.binary_switch input[type="checkbox"] {
			display:none;
			position:absolute;
			top:0;
			left:0;
		}

		.binary_switch_track {
			background-color:#444;
			position:absolute;
			top:0;
			left:0;
			width:100%;
			height:100%;
			margin:0;
			border-radius:7px;
			transition:all 0.3;
		}
		.binary_switch_button {
			background:#eee;
			position:absolute;
			top:2px;
			right:12px;
			bottom:2px;
			left:2px;
			border-radius:5px;
			transition:all 0.2s;
		}

		.binary_switch input[type="checkbox"]:checked ~ .binary_switch_button {
			background:rgba(50,180,70,1);
			right:2px;
			left:12px;
		}
		
		.hide{
			opacity:0;
			visibility:hidden;
		}
		
		.popup{
			background:#eee;
			color:#222;
			width:100%;
			margin:12% 0px 0px 0px;
			padding:20px 0px;
		}
		
		.popupbg{
			background:rgba(0,0,0,0.8);
			position:fixed;
			height:100%;
			width:100%;
			margin:0px;
			padding:0px;
			top:0px;
			left:0px;
			z-index:99;
			transition:all 0.3s ease-in-out 0.1s;
		}
	</style>
	
	<script src="resources/jquery-1.10.2.js"></script>
	<script type="text/javascript">
		function deleteIfExistsPopup(){
			if ($('#deleteIfExists').is(':checked')){
				$('#deleteIfExistsPopupbg').toggleClass('hide');
			}
		}
		
		function configAllPopup(){
			if (!$('#configAll').is(':checked')){
				$('#configAllPopupbg').toggleClass('hide');
			}
		}
	</script>
</head>

<body>
<div id="deleteIfExistsPopupbg" class="popupbg hide">
	<div class="popup" style="margin-top:13%">
		<div style="margin:0px auto; width:800px; text-align:left;">
			<h2 style="color:#c44; font-weight:100;">Careful!</h2>
			<p>This might delete important data to you!</p>
			<button onClick="$('#deleteIfExistsPopupbg').toggleClass('hide')">Ok</button>
			<button onClick="$('#deleteIfExistsPopupbg').toggleClass('hide'); $('#deleteIfExists').prop('checked', false);">Cancel</button>
			<p></p>
		</div>
	</div>
</div>

<input type="text" id="debugConsole" style="color:#333; width:100%; margin:0px; padding:5px; position:fixed; top:0px; left:0px; background:none; border:0px; outline:none;" />

<script type="text/javascript">
	a = 0;
	debugConsole.addEventListener('input', function(){
		if (debugConsole.value == "debug"){
			a++;
			if (a == 1){
				//alert("You are now debuging, Son.");
				debugConsole.value = "";
				debugMenu.style.visibility = "visible";
			}
			if (a >= 2){
				debugConsole.value = "";
				debugMenu.style.visibility = "hidden";
				a = 0;
			}
		}
		
		if (debugConsole.value == "do a barrel roll"){
			document.body.style.webkitTransform = "rotate(0deg)";
			document.body.style.transition = "all 2s";
			document.body.style.webkitTransform = "rotate(360deg)";
				setTimeOut(function(){
					document.body.style.transition = " ";
					document.body.style.webkitTransform = "rotate(0deg)";
				}, 3000);
		}
		
	}, true);
</script>

<form name="debugMenu" method="get" style="visibility:hidden; position:fixed; text-align:left;">
	<button name="debugMenu" value="connect" type="submit">connect()</button>
	<button name="debugMenu" value="dropdb" type="submit">drop()</button>
	<button name="debugMenu" value="createdb" type="submit">createdb()</button>
	<button name="debugMenu" value="createConnectFile" type="submit">createConnectFile()</button>
	<button name="debugMenu" value="createTemplates" type="submit">createTemplates()</button>
	<button name="debugMenu" value="createArticles" type="submit">createArticles()</button>
	<button name="debugMenu" value="createUsers" type="submit">createUsers()</button>
	<button name="debugMenu" value="createRegTokens" type="submit">createRegtokens()</button>
	<button name="debugMenu" value="logo" type="submit">logo()</button>
	<button name="debugMenu" value="session_destroy" type="submit">session_destroy()</button>
	<br />
	<input type="text" name="dbName" placeholder="Database name"/>
	<input type="text" name="dbHost" placeholder="Database host"/>
	<input type="text" name="dbUsername" placeholder="Database username"/>
	<input type="password" name="dbPassword" placeholder="Database password"/>
</form>

<form name="configDb" method="get">
	<br /><br />
		<span style="font-family: 'Poiret One', cursive; font-size:70pt;">cmsProject</span>
	<br /><br /><br />
		Welcome to the <span style="font-family:'Poiret One', cursive;">cmsProject</span><br />
		Please give your new project/database a name.<br />
		<span style="font-size:10pt; color:#aaa;"> (You will be able to edit this later) </span><br /><br />
		
	<input type="text" name="dbName" id="dbName" placeholder="Database name" required/>
	<button name="configDb" value="configDb" type="submit">Submit</button>
	
	<br /><br />
	<label id="menuHiderlabel" for="menuHider">Show advanced options</label>
	<input id="menuHider" type="checkbox"/>
	
	<ul id="menu">
		<label>
			<li>
				<label class="binary_switch">
					<input type="checkbox" name="deleteIfExists" onclick="deleteIfExistsPopup()" id="deleteIfExists" value="true">
						<span class="binary_switch_track"></span>
						<span class="binary_switch_button"></span>
					</input>
				</label>
				Delete database if it already exists
			</li>
		</label>
		
		<li style="padding:3px;">
			<input type="text" name="dbHost" placeholder="Database Host" style="margin:0px; height:40px; width:100%; box-shadow:inset 0px 0px 2px rgba(0,0,0,0.8);"/>
		</li>
	
		<li style="padding:3px;">
			<input type="text" name="dbUsername" placeholder="Database Username" style="margin:0px; height:40px; width:100%; box-shadow:inset 0px 0px 2px rgba(0,0,0,0.8);"/>
		</li>
		
		<li style="padding:3px;">
			<input type="password" name="dbPassword" placeholder="Database Password" style="margin:0px; height:40px; width:100%; box-shadow:inset 0px 0px 2px rgba(0,0,0,0.8);"/>
		</li>	
	
		<label>
			<li>
				<label class="binary_switch">
					<input type="checkbox" name="configAll" onclick="configAllPopup()" id="configAll" value="true" checked>
						<span class="binary_switch_track"></span>
						<span class="binary_switch_button"></span>
					</input>
				</label>
				Configure everything
			</li>
		</label>
	</ul>
	

	<div id="configAllPopupbg" class="popupbg hide">
		<div class="popup" style="margin-top:9%">
			<div style="margin:0px auto; width:600px; text-align:left;">
				<h2 style="color:#333; font-weight:100;">What do you want to setup?</h2>
					
					<label>
						<label class="binary_switch">
							<input type="checkbox" name="createdb" value="true" >
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Create Database
					</label>
					
					<br />
					<label>
						<label class="binary_switch">
							<input type="checkbox" name="createConnectFile" value="true" >
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Create Connect file
					</label>
					
					<br />
					<label>
						<label class="binary_switch">
							<input type="checkbox" name="createTemplates" value="true" >
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Create 'Templates' table
					</label>
					
					<br />
					<label>
						<label class="binary_switch">
							<input type="checkbox" name="logo" value="true" >
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Create logo
					</label>
					
					<br />
					<label>
						<label class="binary_switch">
							<input type="checkbox" name="createArticles" value="true" >
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Create 'Articles' table
					</label>
					
					<br />
					<label>
						<label class="binary_switch">
							<input type="checkbox" name="createUsers" value="true" >
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Create 'Users' table
					</label>
					
					<br />
					<label>
						<label class="binary_switch">
							<input type="checkbox" name="createRegtokens" value="true" >
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Create 'RegTokens' table
					</label>
					
					<br />
					<label>
						<label class="binary_switch">
							<input type="checkbox" name="newRegToken" value="true" >
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Generate token
					</label>
				
				<p><a class="button" onClick="$('#configAllPopupbg').toggleClass('hide');">Close</a></p>
				<p></p>
			</div>
		</div>
	</div>
</form>

<form style="font-size:13pt; line-height:16pt;">
<?php
$errors = array();
$messages = array();

if (isset($_GET['configDb']) && isset($_GET['configAll']) )
{
	if (connect()){
	if (createdb()){
		createConnectFile();
	if (createTemplates()){
		logo();
	if (createArticles()){
	if (createUsers()){
	if (createComments()){
	if (createRegtokens()){
		newRegToken();
		
		if ($errors){
			outputErrors($errors);
			echo '<br /><button type="submit">Submit</button>';
		} else {
			outputMessages($messages);
			session_destroy();
			set0FileTo1();
			renameRootFolder();
			echo '<br /><br /><a href="index.php" class="button">Homepage</a>';
		}
	}}}}}}}
}

if (isset($_GET['configDb']) && !isset($_GET['configAll'])){	
	if (isset($_SESSION['stored']) && $_SESSION['stored'] == true){
		storedConnect();
	} else {
		connect();
	}
	
	if (isset($_GET['createdb'])){ createdb();}
	if (isset($_GET['createConnectFile'])){createConnectFile();}
	if (isset($_GET['createTemplates']) || isset($_GET['overwriteTemplates'])){createTemplates();}
	if (isset($_GET['logo'])){logo();}
	if (isset($_GET['createArticles']) || isset($_GET['overwriteArticles'])){createArticles();}
	if (isset($_GET['createUsers']) || isset($_GET['overwriteUsers'])){createUsers();}
	if (isset($_GET['createComments()']) || isset($_GET['overwriteComments'])){createComments();}
	if (isset($_GET['createRegtokens']) || isset($_GET['overwriteRegtokens'])){createRegtokens();}
	if (isset($_GET['newRegToken'])){newRegToken();}
	if ($errors){
		outputErrors($errors);
		echo '<br /><button type="submit" name="configDb">Submit</button>';
	} else {
		session_destroy();
		set0FileTo1();
		renameRootFolder();
		echo '<br /><br /><a href="index.php" class="button">Homepage</a>';
	}
}

// -------------------------------------------- Functions ------------------------------------------- //

	function connect(){
		if (isset($_GET['dbHost']) && $_GET['dbHost'] != ''){
			$dbHost = $_GET['dbHost'];
		} else {
			$dbHost = 'localhost';
		}
		
		if (isset($_GET['dbUsername']) && $_GET['dbUsername'] != ''){
			$dbUsername = $_GET['dbUsername'];
		} else {
			$dbUsername = 'root';
		}
		
		if (isset($_GET['dbPassword'])){
			$dbPassword = $_GET['dbPassword'];
		} else {
			$dbPassword = '';
		}
		
		if (mysql_connect($dbHost, $dbUsername, $dbPassword))
		{
			//echo "<br />Connected.";
			mysql_select_db($_GET['dbName']);
			storeConnect($dbHost, $dbUsername, $dbPassword);
			$success = true;
		} else {
			echo mysql_error();
			$success = false;
		}
		return $success;
	}
	
// ------------------------------------------------------------- //

	function storeConnect($dbHost, $dbUsername, $dbPassword){
		$_SESSION['dbHost'] = $dbHost;
		$_SESSION['dbUser'] = $dbUsername;
		$_SESSION['dbPass'] = $dbPassword;
		$_SESSION['dbName'] = $_GET['dbName'];
		$_SESSION['stored'] = 'true';
	}

// ------------------------------------------------------------- //

	function storedConnect(){
		mysql_connect($_SESSION['dbHost'], $_SESSION['dbUser'], $_SESSION['dbPass']);
		mysql_select_db($_SESSION['dbName']);
	}

// ------------------------------------------------------------- //

	function createdb(){
		$dbName = $_GET["dbName"];
		
		if (isset($_GET["deleteIfExists"]) && $_GET["deleteIfExists"] == "true"){
			dropdb();
		}
		
		if (mysql_query("CREATE DATABASE $dbName"))
		{
			echo "<br />Database successfully created";
			$success = true;
		}
		else
		{
			if (mysql_errno() == 1007 )
			{
				echo "<script type=\"text/javascript\">
						function check()
						{
							document.getElementById(\"menuHider\").checked=true
						}
						
						function fillInput()
						{
							document.getElementById(\"dbName\").value=\"$dbName\"
						}
						
						check();
						fillInput();
					 </script>";
				echo "<br />Database \"$dbName\" already exists!";
				echo "<br><br>
						<ul>
							<li>Please turn on \"Delete database if it already exists\" to replace it </li>
							<li>Give your database a different name</li>
							<li>Go to <a href='index.php'>Homepage</a>. (Might not be working correctly!)</li>
						</ul>";
			}
				else
			{
				echo "<br /> Error creating database: " . mysql_error(); // exists - errno() 1007
			}
			$success = false;
		}
		return $success;
	}
	
// ------------------------------------------------------------- //
	
	function dropdb(){
		$dbName = $_GET["dbName"];
		
		if (mysql_query("DROP DATABASE $dbName"))
		{
			echo "Database dropped";
			$success = true;
		}
			else
		{
			echo mysql_error();
			$success = false;
		}
		return $success;
	}

// ------------------------------------------------------------- //

	function createConnectFile(){
		if (isset($_GET['dbHost']) && $_GET['dbHost'] != ''){
			$dbHost = $_GET['dbHost'];
		} else {
			$dbHost = 'localhost';
		}
		
		if (isset($_GET['dbUsername']) && $_GET['dbUsername'] != ''){
			$dbUsername = $_GET['dbUsername'];
		} else {
			$dbUsername = 'root';
		}
		
		if (isset($_GET['dbPassword'])){
			$dbPassword = $_GET['dbPassword'];
		} else {
			$dbPassword = '';
		}
		
		$dbName = $_GET['dbName'];
		
		$fileName = "core/database/connect.php";
		$handle = fopen($fileName, 'w') or die('<br />Cannot open connect.php');
		$data = '<?php
$connect_error = \'An error as ocurred. ini.php error_reporting(0); or connect.php\';

$dbHost = \'' . $dbHost . '\';
$dbUser = \'' . $dbUsername . '\';
$dbPass = \'' . $dbPassword . '\';
$dbName = \'' . $dbName . '\';

mysql_connect($dbHost, $dbUser, $dbPass) or die($connect_error);
mysql_select_db($dbName) or die($connect_error);
?>';
			fwrite($handle, $data);
			fclose($handle);
			echo "<br>Created connect.php file";
			createVarsFile();
	}

// ------------------------------------------------------------- //

	function createVarsFile(){
		$dbName = $_GET['dbName'];
		
		$fileName = 'core/vars.php';
		$handle = fopen($fileName, 'w') or die('<br />Cannot open vars.php');
		$data = '<?php
// ----------------------------------------------------------------------------------

date_default_timezone_set( "Europe/Lisbon" );

// ----------------------------------------------------------------------------------

$name = \'' . $dbName . '\';

// ----------------------------------------------------------------------------------

$rootPath = $_SERVER[\'DOCUMENT_ROOT\'] . \'/\' . $name ;
$uriPath = $_SERVER[\'DOCUMENT_ROOT\'] . \'/\' . $name ;

// ----------------------------------------------------------------------------------

$query = mysql_query(\'SELECT * FROM `templates` WHERE `active` = 1\');
$activeTemplate = mysql_fetch_array($query);

$templatePath = $rootPath . \'/templates/\' . $activeTemplate[\'name\'] . \'/\';

// ----------------------------------------------------------------------------------

$errors = array();
$msgs = array();

// ----------------------------------------------------------------------------------
?>';
		fwrite($handle, $data);
		fclose($handle);
		echo "<br>Created vars.php file";
	}

// ------------------------------------------------------------- //

	function createTemplates(){
		$dbName = $_GET["dbName"];
		mysql_select_db($dbName);
		
		if (mysql_query('CREATE TABLE templates(id INT AUTO_INCREMENT, PRIMARY KEY(id), name VARCHAR(30) UNIQUE, active BOOLEAN)'))
		{
			echo "<br> Templates table successfully created";
			if (mysql_query('INSERT INTO templates VALUES (NULL, "default", 1)')){
				if (mysql_query('INSERT INTO templates VALUES (NULL, "portfolio", 0)')){
					echo "<br> Values inserted into templates table";
				}
			}
			else
			{
				echo "<br> Error inserting values into templates table: " . mysql_error();
				$success = false;
				break;
			}
			$success = true;
		}
		else
		{
			if (mysql_errno() == 1050 )
			{ ?>
				<br /> Templates table already exists! 
					<label style="font-size:10pt;">
						<label class="binary_switch">
							<input type="checkbox" name="overwriteTemplates" value="true">
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Overwrite?
					</label>
			<?php }
				else
			{
				echo "<br /> Error creating table: " . mysql_error(); // exists - errno() 1050
			}
			$success = false;
		}
		return $success;
	}

// ------------------------------------------------------------- //

	function createArticles(){
		
		if (mysql_query('CREATE TABLE articles(id INT AUTO_INCREMENT, PRIMARY KEY(id), publicationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, title VARCHAR(255), summary TEXT, content TEXT, tags TEXT)'))
		{
			echo "<br> Articles table successfully created";
			$success = true;
		}
		else
		{
			if (mysql_errno() == 1050 && isset($_GET['overwriteArticles'])){
				echo 'drop table';
			} else if (mysql_errno() == 1050){
				global $errors;
				$errors[] = ' ';
			?>
				<br /> Articles table already exists!
				<label style="font-size:10pt;">
						<label class="binary_switch">
							<input type="checkbox" name="overwriteArticles" value="true">
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Overwrite?
					</label>
	  <?php } else {
				 echo "<br> Error creating table: " . mysql_error(); // exists - errno() 1050
			}
			$success = false;
		}
		return $success;
	}
	
// ------------------------------------------------------------- //

	function createUsers(){
		$dbName = $_GET["dbName"];
		mysql_select_db($dbName);
		
		if (mysql_query('CREATE TABLE users(id INT AUTO_INCREMENT, PRIMARY KEY(id), username TEXT, password TEXT, firstName TEXT, lastName TEXT, email TEXT, level INT, active BOOLEAN)'))
		{
			if (mysql_query('INSERT INTO users (`id`, `username`, `password`, `firstName`, `lastName`, `email`, `level`, `active`) VALUES (NULL, \'System\', NULL, \'System\', NULL, NULL, 1, 1)')){
				echo "<br> Users table successfully created";
				$success = true;
			}
		}
		else
		{
			if (mysql_errno() == 1050 )
			{ ?>
				<br /> Users table already exists!
				<label style="font-size:10pt;">
						<label class="binary_switch">
							<input type="checkbox" name="overwriteTemplates" value="true">
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Overwrite?
				</label>
			<?php }
				else
			{
				echo "<br> Error creating table: " . mysql_error(); // exists - errno() 1050
			}
			$success = false;
		}
		return $success;
	}
	
// ------------------------------------------------------------- //

	function createComments(){
		if (mysql_query('CREATE TABLE comments (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id), articleId INT, userId INT, content TEXT, timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)'))
		{
			mysql_query('ALTER TABLE comments ADD FOREIGN KEY(articleId) REFERENCES articles(id) ON DELETE CASCADE ON UPDATE CASCADE;');
			$success = true;
		} else {
			$success = false;
		}
		return $success;
	}

// ------------------------------------------------------------- //

	function createRegtokens(){
		$dbName = $_GET["dbName"];
		mysql_select_db($dbName);
		
		if (mysql_query('CREATE TABLE regtokens(id INT AUTO_INCREMENT, PRIMARY KEY(id), token TEXT, level INT, givenBy TEXT)'))
		{
			echo "<br /> Regtokens table successfully created";
			$success = true;
		}
		else
		{
			if (mysql_errno() == 1050 )
			{ ?>
				<br />Regtokens table already exists!
				<label style="font-size:10pt;">
						<label class="binary_switch">
							<input type="checkbox" name="overwriteRegtokens" value="true">
								<span class="binary_switch_track"></span>
								<span class="binary_switch_button"></span>
							</input>
						</label>
					Overwrite?
				</label>
			<?php }
				else
			{
				echo "<br /> Error creating table: " . mysql_error(); // exists - errno() 1050
			}
			$success = false;
		}
		return $success;
	}
	
// ------------------------------------------------------------- //

	function newRegToken(){
		$token = md5(rand(100,2000));
		
		$query = 'INSERT INTO `regtokens` (`id`, `token`, `level`, `givenBy`) VALUES (NULL, \'' . $token . '\', 1, \' System \')';
		mysql_query($query);
		?>
		<br />
		<span style="">Token created</span>
		<br />
		<span style="font-size:14pt; line-height:15pt; color:#c33;">
			It is important that you do this now, otherwise you'll have no control over your site.
			<br />
			Either do it now, or save the link and do it as soon as possible
		</span>
				
		<p style="margin:10px; line-height:20pt;">
			<a href="backoffice/register.php?regToken=<?= $token ?>" class="button">Register admin account</a>
		</p>
		<?php
	}

// ------------------------------------------------------------- //

	function logo(){
	$dbName = $_GET["dbName"];
	
	include "core/database/connect.php";
	include "core/vars.php";
	
	$templatePath = "templates/" . $activeTemplate['name'] . "/includes/";
	
	$fileName = $templatePath . "logo.php";
	
	$handle = fopen($fileName, 'w') or die('Cannot open file: '.$my_file);
	$data = $dbName;
		fwrite($handle, $data);
		fclose($handle);
		echo "<br>Created logo";
	}


// ------------------------------------------------------------- //

	function set0FileTo1(){
		$files = scandir('.');
		foreach ($files as $file){
			if ($file == '0'){
				rename('0','1');
			}
		}
	}

// ------------------------------------------------------------- //

	function renameRootFolder(){
		$dbName = $_GET["dbName"];
		$path = explode('\\', getcwd());
		$folderName = end($path);
		chdir('../');
		rename($folderName, $dbName);
	}

// ------------------------------------------------------------- //

	function outputMessages($msgs){
		foreach ($msgs as $msg){
				echo '<br />' . $msg;
		}
	}		

// ------------------------------------------------------------- //

	function outputErrors($errors){
		foreach ($errors as $error){
				echo '<br />' . $error;
		}
	}		

// ------------------------------------------- Debug Menu ---------------------------------------- //

if(isset($_GET['debugMenu']))
{
	$debugMenu = $_GET['debugMenu'];
	
	switch ($debugMenu){
		case 'connect':
			connect();
			break;
		case 'dropdb':
			connect();
			dropdb();
			break;
		case 'createdb':
			connect();
			createdb();
			break;
		case 'createConnectFile':
			connect();
			createConnectFile();
			break;
		case 'createTemplates':
			connect();
			createTemplates();
			break;
		case 'createArticles':
			connect();
			createArticles();
			break;
		case 'createUsers':
			connect();
			createUsers();
			break;
		case 'createRegTokens':
			connect();
			createRegtokens();
			break;
		case 'logo':
			connect();
			logo();
			break;
		case 'session_destroy':
			session_destroy();
			break;
	}
}
?>
</form>
</body>
</html>