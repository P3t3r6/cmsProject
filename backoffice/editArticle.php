<?php
include '../core/init.php';
protectPage();
restrictionLevel(3);

if (isset($_POST['articles'])){
	$articles = $_POST['articles'];
	$_POST['saveChanges'] = true;
	if ($articles == 'update'){
		editArticle();
	}
}

if (isset($_GET['articleId']) && !isset($_GET['status'])){
	$article = Article::getById($_GET['articleId']);
} else if (!isset($_GET['articleId']) && !isset($_GET['status'])){
	header('location:index.php');
	exit();
}

include '../templates/getTop.php';

if (isset($_GET['status']) && $_GET['status'] == 'changesSaved'){
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

<script src="../plugins/ckeditor/ckeditor.js"></script>

<h1 class="pageTitle">New Article</h1>

<form method="POST" style="border:0px solid red; width:100%;">
	Title
	<br />
		<input type="text" name="title" id="title" style="width:95%;" required value="<?= $article -> title ?>" />
	<br /><br />
	
	Summary
	<br />
		<input type="text" name="summary" id="summary" style="width:95%;" required value="<?= $article -> summary ?>" />
	<br /><br />

	<br />
	<textarea name="content" id="content" required><?= $article -> content ?></textarea>
	<br />
	
	Tags
	<br />
	<input type="text" name="tags" id="tags" style="width:95%;" value="<?= $article -> tags ?>" />
	<br /><br />
	<center><button name="articles" value="update" style="width:100%; padding:10px; font-size:13pt;">Submit</button></center>

	<script>
		CKEDITOR.replace('content');
	</script>
</form>

<?php 
}
include '../templates/getBot.php'; ?>