<?php
include '../core/init.php';
//protectPage();
include '../templates/getTop.php';
?>

<script src="../plugins/ckeditor/ckeditor.js"></script>
<h1 class="articleTitle">Articles</h1>

<form method="GET">

	Title
	<br />
	<input type="text" name="title" id="title" required/>
	<br />
	
	Summary
	<br />
	<input type="text" name="summary" id="summary" required>
	<br />
	
	<br />
	<textarea name="content" id="content" required></textarea>
	<br />
	
	Publication Date (auto?)
	<input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['article']->publicationDate ? date( "Y-m-d", $results['article']->publicationDate ) : "" ?>" />
	<br />
	
	<center><button name="articles" value="new" style="padding:10px 50px; font-size:13pt;">Submit</button></center>

	<script>
		CKEDITOR.replace('content');
	</script>
</form>

<?php
	if (isset($_GET['articles'])){
		$articles = $_GET['articles'];
		
		$_GET['saveChanges'] = true;
		if ($articles == 'new'){
			newArticle();
		}
	}
?>

<?php include '../templates/getBot.php'; ?>