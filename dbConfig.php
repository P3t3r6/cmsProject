<head>
	<title>Welcome</title>
	<style type="text/css">
	@import url(http://fonts.googleapis.com/css?family=Poiret+One);
	
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
			max-height:60px;
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
			overflow:hidden;
			box-shadow:inset 0px 5px 15px rgba(0,0,0,0.5);
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
	
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript">
		a = 0;
		function deleteIfExistsPopup(){
			a++;
			if (a == 1){
				$("#popupbg").toggleClass("hide");
			}
			
			if(a >= 2){
				a = 0;
			}
		}
		
		//.prop( "checked" )
		/// ------------------------------------------- USE IS.(CHECKED)
	</script>
</head>

<body>
<div id="popupbg" class="popupbg hide">
	<div class="popup">
		<div style="margin:0px auto; width:800px; text-align:left;">
			<h2 style="color:#c44;">Careful!</h2>
			<p>This might delete important data to you!</p>
			<button onClick="$('#popupbg').toggleClass('hide')">I got this</button>
			<button onClick="$('#popupbg').toggleClass('hide'); deleteIfExists.checked=true;">Nah bro, undo it</button>
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

<form id="debugMenu" method="get" style="visibility:hidden; position:fixed; text-align:left;">
	<button name="debugMenu" value="connect" type="submit">connect()</button>
	<button name="debugMenu" value="dropdb" type="submit">drop()</button>
	<button name="debugMenu" value="createdb" type="submit">createdb()</button>
	<button name="debugMenu" value="createConnectFile" type="submit">createConnectFile()</button>
	<button name="debugMenu" value="createTemplates" type="submit">createTemplates()</button>
	<br />
	<input type="text" name="dbName" placeholder="Database name"/>
</form>

<form name="configDb" action="" method="get">
	<br /><br />
		<span style="font-family: 'Poiret One', cursive; font-size:70pt;">cmsProject</span>
	<br /><br /><br />
		Welcome to the <span style="font-family: 'Poiret One', cursive;">cmsProject</span><br />
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
		
		<label>
			<li>
				<label class="binary_switch">
					<input type="checkbox">
						<span class="binary_switch_track"></span>
						<span class="binary_switch_button"></span>
					</input>
				</label>
				Create users table
			</li>
		</label>
		
	</ul>
</form>

<?php
if (isset($_GET["configDb"]))
{
	if (connect())
	{
		if (createdb())
		{
			createConnectFile();
			createTemplates();
		}
	}
}

// -------------------------------------------- Functions ------------------------------------------- //

	function connect()
	{
		if (mysql_connect('localhost','root',''))
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
	
// ------------------------------------ //

	function createdb()
	{
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
				echo "<br><br>Please turn on \"Delete database if it already exists\" to replace it <br> or <br> give your database a different name.";
			}
				else
			{
				echo "<br> Error creating database: " . mysql_error(); // exists - errno() 1007
			}
			$success = false;
		}
		return $success;
	}
	
// ------------------------------------ //
	
	function dropdb()
	{
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

// ------------------------------------ //

	function createConnectFile()
	{
		$dbName = $_GET["dbName"];
		
		$fileName = "core/database/connect.php";
		$handle = fopen($fileName, 'w') or die('Cannot open file:  '.$my_file);
		$data = "<?php
\$connect_error = 'An error as ocurred. ini.php error_reporting(0); or connect.php';

mysql_connect('localhost', 'root', '') or die(\$connect_error);
mysql_select_db('" . $dbName . "') or die(\$connect_error);
?>";
			fwrite($handle, $data);
			fclose($handle);
			echo "<br>Created connect.php file";
	}

// ------------------------------------ //

	function createTemplates()
	{
		$dbName = $_GET["dbName"];
		mysql_select_db($dbName);
		
		if (mysql_query('CREATE TABLE templates(id INT AUTO_INCREMENT, PRIMARY KEY(id), name VARCHAR(30), active BOOLEAN)'))
		{
			echo "<br> Templates table successfully created";
			if (mysql_query('INSERT INTO templates VALUES (NULL, "default", 1)'))
			{
				echo "<br> Values inserted into templates table";
				echo '<br><br><form action="index.php"><button type="submit">Homepage</button></form>';
			}
			else
			{
				echo "<br> Error inserting values into templates table: " . mysql_error();
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
	}
}
?>
</body>