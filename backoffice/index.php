<?php include '../core/init.php';
	  include '../templates/getTop.php'; ?>

<form name="configVars" action="" method="get">
Databse Name - <input type="text" name="dbName"/>
<br /><button name="configVars" value="configVars" type="submit">Submit</button>
</form>

<form name="createTemplates" action="" method="get">
<button name="createTemplates" value="createTemplates" type="submit" >Create Templates Table</button>
</form>

<?php
if(isset($_GET['configVars'])){
	$dbName=$_GET['dbName'];
	if (mysql_query("CREATE DATABASE $dbName"))
	  {
	  echo "Database created successfully";
	  }
	else
	  {
	  echo "Error creating database: " . mysql_error();
	  }
}

if(isset($_GET['createTemplates'])){
	if (mysql_query('CREATE TABLE Templates(id INT AUTO_INCREMENT, PRIMARY KEY(id), name VARCHAR(30), active BOOLEAN)'))
	  {
	  echo "'Templates' successfully created";
	  }
	else
	  {
	  echo "Error creating database: " . mysql_error();
	  }
}
?>

<?php include '../templates/getBot.php'; ?>