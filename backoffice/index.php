<?php include '../core/init.php';

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

<script src="../plugins/ckeditor/ckeditor.js"></script>

<form method="get">
<h1 class="articleTitle">Template</h1>
<table>
	<tr>
		<td>
			<?php
				$templates = array();
				$templates = mysql_query('SELECT * FROM templates');
				
				echo "<select name='newTemplate'>";
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
			<button type="submit" name="setTemplate" value="set">Set</button>
		</td>
	</tr>
	
	<tr>
		<td><input type="text" placeholder="Template name"/></td>
		<td><button type="submit" name="newTemplate" value="newTemplate">New</button></td>
		<td>
		<?php 
			if (mysql_query('INSERT INTO templates VALUES (NULL, "default", 1)'))
			{
				echo "<span style='color:#5d7;'>Template Created</span>";
			}
			else
			{
				echo "<br> Error inserting values into templates table: " . mysql_error();
			}
		?>
		</td>
	</tr>
</table>
</form>

<?php

?>

<h1 class="articleTitle">Articles</h1>
<button>Create</button>
<button>Edit</button>
<button>Delete</button>

<script>
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace( 'editor1' );
</script>

<?php include '../templates/getBot.php'; ?>