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
			background:rgba(60,200,80,1);
			right:2px;
			left:12px;
		}

		.binary_switch input[type="checkbox"]:active ~ .binary_switch_button {
			opacity:.8
		}

	</style>
</head>

<body>
<form name="dropdb" action="" method="get">
	<button name="dropdb" value="dropdb" type="submit" style="top:0px; left:0px; position:fixed;">Drop 'cmsProject'</button>
</form>

<form name="configDb" action="" method="get">
	<br />
		<span style="font-family: 'Poiret One', cursive; font-size:70pt;">cmsProject</span>
	<br /><br /><br />
		Welcome to the <span style="font-family: 'Poiret One', cursive;">cmsProject</span><br />
		Please give your new project/database a name.<br />
		<span style="font-size:8pt;"> You can edit later </span><br /><br />
		
	<input type="text" name="dbName" id="dbName" placeholder="Database name" required/>
	<button name="configDb" value="configDb" type="submit">Submit</button>
	
	<br /><br />
	<label id="menuHiderlabel" for="menuHider">Show advanced options</label>
	<input id="menuHider" type="checkbox"/>
	
	<ul id="menu">
		<label>
			<li>
				<label class="binary_switch">
					<input type="checkbox" name="deleteIfExists" value="deleteIfExists">
						<span class="binary_switch_track"></span>
						<span class="binary_switch_button"></span>
					</input>
				</label>
				Delete database if it already exists
				<!----------------------------------------- PHP ---------------------------------------------------------->
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
		
		<label>
			<li>
				<label class="binary_switch">
					<input type="checkbox">
						<span class="binary_switch_track"></span>
						<span class="binary_switch_button"></span>
					</input>
				</label>
			Option 3
			</li>
		</label>
	</ul>
</form>

<style type="text/css">
	#consoleDiv{
		border:10px solid #222;
		margin:0px auto;
		padding:10px;
		font-size:13pt;
		text-align:left;
		background:#000;
		color:#0f0;
		height:300px;
		width:700px;
		border-radius:10px;
	}
	
	@-webkit-keyframes blinking{
			0%{opacity:1;}
			55%{opacity:1;}
			60%{opacity:0;}
			95%{opacity:0;}
	}
	
	#blink{
		opacity:1;
		-webkit-animation:blinking 1s infinite;
	}
</style>

<div id="consoleDiv">
<code>
<?php
if(isset($_GET['configDb']))
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
			$success = true;
		}
			else
		{
			mysql_error();
			$success = false;
		}
		return $success;
	}
	
// ------------------------------------ //

	function createdb()
	{
		$dbName = $_GET["dbName"];
		
		if (mysql_query("CREATE DATABASE $dbName"))
		{
			echo "Database successfully created";
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
				echo "Database \"$dbName\" already exists!";
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
	
// ------------------------------------ //

if(isset($_GET['dropdb']))
{
	connect();
	
	if (mysql_query('DROP DATABASE cmsProject'))
	{
		echo "Database dropped";
	}
		else
	{
		mysql_error();
	}
}

?>
<br />localhost> <span id="blink"><b>_</b></span>
</code>
</div>
</body>