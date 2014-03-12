<?php
include '../core/init.php';

if (isset($_POST['articles'])){
	$articles = $_POST['articles'];
	
	$_POST['saveChanges'] = true;
	if ($articles == 'new'){
		newArticle();
	}
}
 
protectPage();
include '../templates/getTop.php';

if (isset($_GET['status']) && $_GET['status'] == 'saved'){
	?>
		<center>
			<br />
			<p style='color:#3b4; font-size:18pt;'> Saved!</p>
			<a href="index.php"><button>Go to home</button></a>
		</center>
	<?php
} else {
?>

<script src="../plugins/ckeditor/ckeditor.js"></script>

<h1 class="pageTitle">New Article</h1>

<form method="POST">
<table>
	<tr>
		<td valign="top" style="padding:20px;">
			Title
			<br />
			<input type="text" name="title" id="title" style="width:80%;" required/>
			<br /><br />
			
			Summary
			<br />
			<input type="text" name="summary" id="summary" style="width:80%;" required>
			<br /><br />
			
			Tags
			<br />
			<input type="text" name="tags" id="tags" style="width:80%;" />
			<br /><br />
			
			<br /><br /><br /><br />
			
			<center><button name="articles" value="new" style="padding:10px 60px; font-size:13pt;">Submit</button></center>
		</td>
		
		<td>
			<br />
			<textarea name="content" id="content" required></textarea>
			<br />
		</td>
	</tr>
</table>

	<script>
		CKEDITOR.replace('content');
	</script>
</form>

<?php 
}
include '../templates/getBot.php'; ?>