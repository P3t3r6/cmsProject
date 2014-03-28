<?php
include '../core/init.php'; 
protectPage();
restrictionLevel(3);

if (isset($_POST['articles'])){
	$articles = $_POST['articles'];
	
	$_POST['saveChanges'] = true;
	if ($articles == 'new'){
		newArticle();
	}
}

include '../templates/getTop.php';

if (isset($_GET['status']) && $_GET['status'] == 'saved'){
	?>
		<center>
			<br />
			<p style='color:#3b4; font-size:18pt;'> Saved!</p>
			<div style="width:200px;">
				<a href="index.php"><button style="width:200px;">Backoffice</button></a>
				<a href="newArticle.php"><button style="width:200px;">Create a new article</button></a>
			</div>
		</center>
	<?php
} else {
?>

<!-- ---------------------------------------------------------------------- -->
<link rel="stylesheet" href="../plugins/redactor/redactor/redactor.css" />
<script src="../plugins/redactor/redactor/redactor.min.js"></script>
<script>
$(document).ready(
	function(){
			$('#content').redactor({
				imageUpload: '../demo/scripts/image_upload.php',
				fileUpload: '../demo/scripts/file_upload.php',
				minHeight: 150
			});
		}
	);
</script>
<!-- ---------------------------------------------------------------------- -->

<h1 class="pageTitle">New Article</h1>

<form method="POST" style="border:0px solid red; width:100%;">
	Title
	<br />
		<input type="text" name="title" id="title" style="width:95%;" required/>
	<br /><br />
	
	Summary
	<br />
		<input type="text" name="summary" id="summary" style="width:95%;" required>
	<br /><br />

	<br />
	<textarea name="content" id="content" required></textarea>
	<br />
	
	Tags
	<br />
	<input type="text" name="tags" id="tags" style="width:95%;" />
	<br /><br />
	<center><button name="articles" value="new" style="width:100%; padding:10px; font-size:13pt;">Submit</button></center>
</form>

<?php 
}
include '../templates/getBot.php'; ?>