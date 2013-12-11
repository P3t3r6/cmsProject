<head>
	<title>Welcome</title>
	<style type="text/css">
	@import url(http://fonts.googleapis.com/css?family=Poiret+One);
	
		body{
			background:#111;
			color:#eee;
			text-align:center;
			padding:20px;
			font-family:calibri;
			font-size:15pt;
			line-height:20pt;
		}
		
		input{
			padding:10px 0px 10px 10px;
			border:0px;
			transition:all 0.3s;
		}
		
		input:focus{
			padding:10px 50px 10px 10px;
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
		
		#options{
			padding:5px 10px;
			border:0px;
			background:#222;
			color:#fff;
			cursor:pointer;
			transition:all 0.3s;
		}
		
		#options:hover{
			background:#fff;
			color:#000;
		}
	</style>
</head>

<body>
<form name="configDb" action="" method="get">
	<br />
		<span style="font-family: 'Poiret One', cursive; font-size:70pt;">cmsProject</span>
	<br /><br /><br />
		Welcome to the <span style="font-family: 'Poiret One', cursive;">cmsProject</span><br />
		Please give your new project/database a name.<br /><br />
	<input type="text" name="dbName" placeholder="Database name"/>
	<button name="configDb" value="configDb" type="submit">Submit</button>
	<a id="options">&equiv;</a>
</form>

<?php
if(isset($_GET['configDb']))
{
mysql_connect('localhost','root','');
$dbName=$_GET["dbName"];
	
	if (mysql_query("CREATE DATABASE $dbName"))
	{
		echo "Database successfully created";
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
		
		mysql_select_db($dbName);
		if (mysql_query('CREATE TABLE templates(id INT AUTO_INCREMENT, PRIMARY KEY(id), name VARCHAR(30), active BOOLEAN)'))
		{
			echo "<br> Tables successfully created";
			if (mysql_query('INSERT INTO templates VALUES (NULL, "default", 1)'))
			{
				echo "<br> Values inserted into table";
				echo '<br><br><form action="index.php"><button type="submit">Homepage</button></form>';
			}
			else
			{
				echo "<br> Error inserting values into table: " . mysql_error();
			}
		}
		else
		{
		  echo "<br> Error creating table: " . mysql_error();
		}
	}
	else
	  {
	  echo "<br> Error creating database: " . mysql_error();
	  }
}
?>
</body>