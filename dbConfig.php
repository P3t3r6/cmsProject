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
		
		body{
			background:#111;
			color:#eee;
			text-align:center;
			padding:25px 0px;
			margin:0px;
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
			max-height:45px;
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
			width:24%;
			margin:0px;
			padding:10px 0px 10px 1%;
			text-align:left;
			opacity:0;
			cursor:pointer;
			-webkit-transform: translateY(-100%);
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
			transition:all 0.3s ease-in-out 0.3s;
		}
	</style>
	
	<script src="resources/jquery-1.10.2.js"></script>
	<script type="text/javascript">
		function deleteIfExistsPopup(){
			if ($('#deleteIfExists').is(':checked'))
			{
				$('#popupbg').toggleClass('hide');
			}
		}
	</script>
</head>

<body>
<div id="popupbg" class="popupbg hide">
	<div class="popup">
		<div style="margin:0px auto; width:800px; text-align:left;">
			<h2 style="color:#c44; font-weight:100;">Careful!</h2>
			<p>This might delete important data to you!</p>
			<button onClick="$('#popupbg').toggleClass('hide')">Ok</button>
			<button onClick="$('#popupbg').toggleClass('hide'); $('#deleteIfExists').prop('checked', false);">Cancel</button>
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
	<br />
	<input type="text" name="dbName" placeholder="Database name"/>
	<input type="text" name="dbHost" placeholder="Database host"/>
	<input type="text" name="dbUsername" placeholder="Database username"/>
	<input type="password" name="dbPassword" placeholder="Database password"/>
</form>

<form name="configDb"  method="get">
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
	</ul>
</form>

<?php
if (isset($_GET["configDb"]))
{
	if (connect()){
	if (createdb()){
		createConnectFile();
	if (createTemplates()){
		logo();
	if (createArticles()){
	if (createUsers()){
	if (createRegtokens()){
		newRegToken();
		foreach ($errors as $error){
			echo '<br />' . $error;
		}
		echo '<br><br><form action="index.php"><button type="submit">Homepage</button></form>';
	}}}}}}
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

	function createdb(){
		$dbName = $_GET["dbName"];
		
		if (isset($_GET["deleteIfExists"]) && $_GET["deleteIfExists"] == "true")
		{
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
				echo "<br> Error creating database: " . mysql_error(); // exists - errno() 1007
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
		$handle = fopen($fileName, 'w') or die('<br />Cannot open file: ' . $my_file);
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
	}

// ------------------------------------------------------------- //

	function createTemplates(){
		$dbName = $_GET["dbName"];
		mysql_select_db($dbName);
		
		if (mysql_query('CREATE TABLE templates(id INT AUTO_INCREMENT, PRIMARY KEY(id), name VARCHAR(30) UNIQUE, active BOOLEAN)'))
		{
			echo "<br> Templates table successfully created";
			if (mysql_query('INSERT INTO templates VALUES (NULL, "default", 1)'))
			{
				echo "<br> Values inserted into templates table";
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
			{
				echo "Table already exists!";
			}
				else
			{
				echo "<br> Error creating table: " . mysql_error();  // exists - errno() 1050
			}
			$success = false;
		}
		return $success;
	}

// ------------------------------------------------------------- //

	function createArticles(){
		$dbName = $_GET["dbName"];
		mysql_select_db($dbName);
		
		if (mysql_query('CREATE TABLE articles(id INT AUTO_INCREMENT, PRIMARY KEY(id), publicationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, title VARCHAR(255), summary TEXT, content TEXT, tags TEXT)'))
		{
			echo "<br> Articles table successfully created";
			$success = true;
		}
		else
		{
			if (mysql_errno() == 1050 )
			{
				echo "Table already exists!";
			}
				else
			{
				echo "<br> Error creating table: " . mysql_error();  // exists - errno() 1050
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
			echo "<br> Users table successfully created";
			$success = true;
		}
		else
		{
			if (mysql_errno() == 1050 )
			{
				echo "Table already exists!";
			}
				else
			{
				echo "<br> Error creating table: " . mysql_error();  // exists - errno() 1050
			}
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
			echo "<br> Regtokens table successfully created";
			$success = true;
		}
		else
		{
			if (mysql_errno() == 1050 )
			{
				echo "Table already exists!";
			}
				else
			{
				echo "<br> Error creating table: " . mysql_error();  // exists - errno() 1050
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
		
		global $errors;
		$errors[] = 'Token created';
		$errors[] = '<a style="color:#3b4;" href="backoffice/register.php?regToken=' . $token . '">backoffice/register.php?regToken=' . $token . '</a>';
	}

// ------------------------------------------------------------- //

	function logo(){
	$dbName = $_GET["dbName"];
	
	include "core/database/connect.php";
	include "core/vars.php";
	
	$templatePath = "templates/" . $activeTemplate['name'] . "/includes/";
	
	$fileName = $templatePath . "logo.php";
	
	$handle = fopen($fileName, 'w') or die('Cannot open file:  '.$my_file);
	$data = $dbName;
		fwrite($handle, $data);
		fclose($handle);
		echo "<br>Created logo";
	}
	
// -------------------------------------------  Debug Menu  ---------------------------------------- //

if(isset($_GET['debugMenu']))
{
	$debugMenu = $_GET['debugMenu'];
	
	switch ($debugMenu){
		case "connect":
			connect();
			break;
		case "dropdb":
			connect();
			dropdb();
			break;
		case "createdb":
			connect();
			createdb();
			break;
		case "createConnectFile":
			connect();
			createConnectFile();
			break;
		case "createTemplates":
			connect();
			createTemplates();
			break;
		case "createArticles":
			connect();
			createArticles();
			break;
		case "createUsers":
			connect();
			createUsers();
			break;
		case "createRegTokens":
			connect();
			createRegtokens();
			break;
		case "logo":
			connect();
			logo();
			break;
	}
}
?>
</body>