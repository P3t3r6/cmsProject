<?php include '../core/init.php';
	if (isset($_GET['logout'])){
		logout();
	}

	protectPage();

	if (isset($_GET['newTemplate'])){
		$newTemplateName = $_GET['newTemplateName'];
		
		if (mysql_query('INSERT IGNORE INTO templates VALUES (NULL, \'' . $newTemplateName . '\', 0)'))
		{
			header('location:?templateCreated');
			exit();
		}
		else
		{
			echo "<br> Error inserting values into templates table: " . mysql_error();
		}
	}

	if (isset($_GET['setTemplate'])){
		$templates = mysql_query('SELECT * FROM templates');
		while ($template = mysql_fetch_array($templates))
		{
				if ($template['active'] == 1)
				{
					mysql_query('UPDATE templates SET active = 0');
				}
				else
				{
					echo '<option value="' . $template["name"] . '">' . $template["name"] . '</option>';
				}
		}
		
		$setTemplate = $_GET['setTemplate'];
		mysql_query('UPDATE templates SET active = "1" WHERE name = "' . $setTemplate . '"');
	}
	
	if (isset($_GET['newRegToken'])){
		newRegToken();
	}
	include '../templates/getTop.php'; ?>

<br />
<table style="width:100%;">
	<tr>
		<td colspan="2">
			<center>
			<!-- <div style="background:rgba(150,150,150,0.05); display:block; width:95px; height:61px; padding-top:34px; padding:0px auto; border-radius:100px; box-shadow:0px 1px 1px rgba(255,255,255,0.2), inset 0px 5px 20px rgba(0,0,0,0.5);"> -->
				<?php
					echo date('d M Y') . '<br />' . date('H:i');
				?>
			<!-- </div> -->
			</center>
			<br />
		</td>
	</tr>

<!-- --------------------------------- User --------------------------------------- -->
	<tr style="vertical-align:top;">
		<td colspan="2" style="width:100%; background:rgba(125,125,125,0.1); padding:10px 30px 25px 30px;">
			<h1 class="pageTitle">User area</h1>
			
			<p>Nice to see you, <?= $userData['username']?>.</p>
			
			<p style="color:#3b4;"><?php outputErrors($errors); ?></p>
			
			<a href="register.php"><button>Register new user</button></a>
			<a href="?newRegToken=new"><button>Generate new Register Token</button></a>
			<a href="?logout=logout"><button>Logout</button></a>
		</td>
		
	</tr>
	
	<tr style="vertical-align:top;">
<!-- --------------------------------- Templates --------------------------------------- -->
		<td style="width:50%;">
			<h1 class="articleTitle">Template</h1>
			<table>
			<form method="get">
				<tr>
					<td>
						<?php
							$templates = array();
							$templates = mysql_query('SELECT * FROM templates');
							
							echo "<select name='setTemplate' style='width:99%;'>";
								while ($template = mysql_fetch_array($templates)){
									if ($template['active'] == 1)
									{
										echo '<option value="' . $template["name"] . '">' . $template["name"] . ' (Current)' .'</option>';
									}
									else
									{
										echo '<option value="' . $template["name"] . '">' . $template["name"] . '</option>';
									}
								}
							echo "</select>";
						?>
					</td>
					
					<td>
						<button type="submit" style="width:100%;">Set</button>
					</td>
				</tr>
			</form>
			
			<form method="get">
				<tr>
					<td><input type="text" name="newTemplateName" placeholder="Template name" required/></td>
					<td><button type="submit" name="newTemplate" value="newTemplate" style="width:100%;">New</button></td>
					<td>
					<?php
						if (isset($_GET['templateCreated'])){
							echo "<span style='color:#3b4;'>Template Created</span>";
						}
					?>
					</td>
				</tr>
			</form>
			</table>
		</td>
		
<!-- --------------------------------- Menu --------------------------------------- -->
		<td style="width:50%;">
			<h1 class="articleTitle">Edit Template</h1>
			<a href="editTemplatePart.php?toEdit=logo"><button>Logo</button></a>
			<a href="editTemplatePart.php?toEdit=menu"><button>Menu</button></a>
			<a href="editTemplatePart.php?toEdit=footer"><button>Footer</button></a>
		</td>
	</tr>
	
	<tr style=" vertical-align:top;">
		
<!-- --------------------------------- Pages --------------------------------------- -->
		
		<td style="width:50%;">
			<form method="GET">
				<h1 class="articleTitle">Pages</h1>
				<input type="text" name="pageName" placeholder="New page name"/>
				<button name="pages" value="new">New Page</button>
			</form>
		</td>
		
<!-- --------------------------------- Articles --------------------------------------- -->
		<td style="width:50%;">
			<h1 class="articleTitle">Articles</h1>
			<a href="newArticle.php"><button>Create</button></a>
			<a href="listArticles.php"><button>List</button></a>
			<button>Edit</button>
			<button>Delete</button>
		</td>
	</tr>
</table>

<?php
	if (isset($_GET['pages'])){
		
		$pageName = $_GET['pageName'];
		$pages = $_GET['pages'];
		
		switch ($pages){
			case "new":
				newPage($pageName);
				break;
		}
	}
	
	function newPage($name){
		$fileName = "../pages/$name.php";
		$handle = fopen($fileName, 'w') or die('Cannot open file:  '.$my_file);
		$data = "<?php include '../core/init.php';
include '../templates/getTop.php'; ?>

<h1 class=\"pageTitle\">$name</h1>

<?php tagPage('$name'); ?>

<?php include '../templates/getBot.php'; ?>";
			fwrite($handle, $data);
			fclose($handle);
			echo "<span style='color:#3b4;'>Page created!";
	}
?>

<?php include '../templates/getBot.php'; ?>