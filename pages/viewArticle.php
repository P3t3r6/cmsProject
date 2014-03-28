<?php include '../core/init.php';
	  include '../templates/getTop.php';
	  
	viewArticle();
	if (isset($_POST['newComment'])){
		newComment();
	}

	if (isset($_POST['deleteComment'])){
		deleteComment();
	}
	
	if (isset($_GET['delete'])){
	$article = Article::getById($_GET['delete']);
	?>
		<form method="POST">
			<div class="popupbg">
				<div class="popup" style="margin-top:13%">
					<div style="margin:0px auto; width:800px; text-align:left;">
						<h2 style="color:#c44; font-weight:100;">Delete Article</h2>
						<p style="margin:5px;">You are about to delete:</p>
						<p style="margin:8px; font-weight:bold; font-size:15pt;"><?php echo $article->title ?></p>
						<br />
						<button name="confirmDelete" value="<?= $_GET['delete'] ?>">Delete</button>
						<a href="?action=viewArticle&articleId=<?= $_GET['delete'] ?>" class="button">Cancel</a>
						<p></p>
					</div>
				</div>
			</div>
		</form>
	<?php }

	if (isset($_POST['confirmDelete'])){
		mysql_query('DELETE FROM articles WHERE id = ' . $_POST['confirmDelete']);
		header('location:index.php');
		exit();
	}
?>

<div class="article" style="width:100%;">
	<h1 class="articleTitle"><?php echo htmlspecialchars( $results['article']->title )?></h1>
	<div style="background:rgba(255,255,255,0.03); padding:1px 15px; overflow:auto;"><?php echo $results['article']->content?></div>
	<p class="pubDate">Published on <?php echo date('j F Y', $results['article']->publicationDate)?>
		<?php
		if (loggedIn()){
			global $userData;
			if ($userData['level'] <= 3){?>
			<span style="float:right;">
				<a href="../backoffice/editArticle.php?articleId=<?= $results['article']->id ?>" class="button" style="padding:6px 20px;">Edit</a>
				<a href="?action=viewArticle&articleId=<?= $results['article']->id ?>&delete=<?= $results['article']->id ?>" class="button" style="padding:6px 20px;">Delete</a>
			</span>
		<?php
			}
		}
		?>
	</p>

	<h5 class="articleTitle">Comments</h5>
<?php if (loggedIn()){ ?>
	<form method="POST" style="padding:10px;">
		<input type="hidden" name="action" value="viewArticle"/>
		<input type="hidden" name="articleId" value="<?= $results['article']->id ?>"/>
		<table>
			<tr>
				<td style="vertical-align:top;">
					<div style="background-image:url('<?= userImage() ?>'); background-size:cover; background-position:center; float:left; height:45px; width:45px; border-radius:3px; box-shadow:0px 1px 5px rgba(0,0,0,0.5);">
					</div>
				</td>
				<td><textarea type="text" name="comment" rows="3" style="width:550px; border-radius:3px; resize:none;"></textarea></td>
				<td><button type="submit" name="newComment" style="height:100%; margin:0px;">Submit</button></td>
			</tr>
		</table>
	</form>
<?php } ?>
	<?php showComments(); ?>
</div>

<?php include '../templates/getBot.php'; ?>