<?php include '../core/init.php';
protectPage();
restrictionLevel(2);
include '../templates/getTop.php';

if (isset($_POST['delete'])){
	$article = Article::getById($_POST['delete']);
?>
	<form method="POST">
		<div class="popupbg">
			<div class="popup" style="margin-top:13%">
				<div style="margin:0px auto; width:800px; text-align:left;">
					<h2 style="color:#c44; font-weight:100;">Delete Article</h2>
					<p style="margin:5px;">You are about to delete:</p>
					<p style="margin:8px; font-weight:bold; font-size:15pt;"><?php echo $article->title ?></p>
					<br />
					<button name="confirmDelete" value="<?= $_POST['delete'] ?>">Delete</button>
					<a href="listArticles.php"><button>Cancel</button></a>
					<p></p>
				</div>
			</div>
		</div>
	</form>
<?php }

if (isset($_POST['confirmDelete'])){
	mysql_query('DELETE FROM articles WHERE id = ' . $_POST['confirmDelete']);
}

$results = array();
$data = Article::getList();
$results['articles'] = $data['results'];
$results['totalRows'] = $data['totalRows'];
?>
	<form method="POST">
	<table style="width:100%; text-align:center; table-layout:fixed; overflow:hidden; white-space:nowrap;">
	
		<?php
		foreach ( $results['articles'] as $article ) { ?>
		<tr>
			<td style="width:141px; padding:0px;">
				<a class="button" href="editArticle.php?articleId=<?= $article->id ?>">Edit</a>
				<button name="delete" value="<?= $article->id ?>" style="margin:0px;">Delete</button>
			</td>
			<td style="width:12%; font-size:10pt; background:rgba(150,150,150,0.1); overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">	
				<a href="viewArticle.php?action=viewArticle&amp;articleId=<?= $article->id?>">
					<?= htmlspecialchars( $article->title )?>
				</a>
			</td>
			
			<td style="width:12%; font-size:8pt; background:rgba(150,150,150,0.1); overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
				<?= htmlspecialchars($article->summary)?>
			</td>
			
			<td style="width:10%; font-size:10pt; background:rgba(150,150,150,0.1); overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
				<?= htmlspecialchars(date('j M y', $article->publicationDate))?>
			</td>
			
			<td style="width:50%; font-size:10pt; text-align:left; background:rgba(150,150,150,0.1); overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
				<?= htmlspecialchars($article->content) ?>
			</td>
		</tr>
		<?php } ?>
	</table>
	</form>
	
<?php include '../templates/getBot.php'; ?>