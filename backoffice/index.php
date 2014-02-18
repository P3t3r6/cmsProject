<?php include '../core/init.php';
//protectPage();

	if (isset($_GET['setTemplate']))
	{
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
		
		$newTemplate = $_GET['newTemplate'];
		mysql_query('UPDATE templates SET active = "1" WHERE name = "' . $newTemplate . '"');
	}
	
	include '../templates/getTop.php'; ?>

<table style="width:100%;">
	<tr style="vertical-align:top;">
		<td style="width:50%;">
			<form method="get">
				<h1 class="articleTitle">Template</h1>
				<table>
					<tr>
						<td>
							<?php
								$templates = array();
								$templates = mysql_query('SELECT * FROM templates');
								
								echo "<select name='newTemplate' style='width:99%;'>";
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
							<button type="submit" name="setTemplate" value="set" style="width:100%;">Set</button>
						</td>
					</tr>
					
					<tr>
						<td><input type="text" name="newTemplateName" placeholder="Template name"/></td>
						<td><button type="submit" name="newTemplate" value="newTemplate" style="width:100%;">New</button></td>
						<td>
						<?php
							if (isset($_GET['newTemplate'])){
								$newTemplateName = $_GET['newTemplateName'];
								
								if (mysql_query('INSERT IGNORE INTO templates VALUES (NULL, \'' . $newTemplateName . '\', 0)'))
								{
									echo "<span style='color:#3b4;'>Template Created</span>";
								}
								else
								{
									echo "<br> Error inserting values into templates table: " . mysql_error();
								}
							}
						?>
						</td>
					</tr>
				</table>
			</form>
		</td>
		
		<td style="width:50%;">
			<h1 class="articleTitle">something</h1>
		</td>
		
	</tr>
	
	<tr style=" vertical-align:top;">
		<td style="width:50%;">
			<form method="GET">
				<h1 class="articleTitle">Pages</h1>
				<input type="text" name="pageName" placeholder="New page name"/>
				<button name="pages" value="new">New Page</button>
			</form>
		</td>
		
		<td style="width:50%;">
			<h1 class="articleTitle">Articles</h1>
			<a href="newArticle.php"><button>Create</button></a>
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
			echo "Page created!";
	}
?>

<?php include '../templates/getBot.php'; ?>