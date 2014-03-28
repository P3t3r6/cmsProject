<?php

function archive() {
  global $results;
  $results = array();
  //$data = article::archiveGetList();
  
  $sql = "SELECT COUNT(id) FROM articles";
	$query = mysql_query($sql);
	$row = mysql_fetch_row($query);
	$rows = $row[0];
	$page_rows = 6;
	$last = ceil($rows/$page_rows);
	if($last < 1){
		$last = 1;
	}
	$pagenum = 1;
	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}
	if ($pagenum < 1) { 
		$pagenum = 1; 
	} else if ($pagenum > $last) { 
		$pagenum = $last; 
	}
	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	$sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles ORDER BY id DESC $limit";

	$query = mysql_query($sql);

	$textline1 = "<b>$rows</b> Articles - ";
	$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";

	$paginationCtrls = '';

	if($last != 1){
		if ($pagenum > 1) {
			$previous = $pagenum - 1;
			$paginationCtrls .= ' <a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> ';
			
			for($i = $pagenum-4; $i < $pagenum; $i++){
				if($i > 0){
					$paginationCtrls .= ' <a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> ';
				}
			}
		}
		
		$paginationCtrls .= ' <span style="text-decoration:underline;">'.$pagenum.'</span> ';
		
		for($i = $pagenum+1; $i <= $last; $i++){
			$paginationCtrls .= ' <a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> ';
			if($i >= $pagenum+4){
				break;
			}
		}
		
		if ($pagenum != $last) {
			$next = $pagenum + 1;
			$paginationCtrls .= ' <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> ';
		}
	}
	$list = array();
		while ($row = mysql_fetch_array($query)) {
		  $article = new Article( $row );
		  $list[] = $article;
		}
		$data = array("results" => $list);
  
	$results['articles'] = $data['results'];
	
	?><div style="background:rgba(150,150,150,0.05); text-align:center; padding:8px;"><?php echo $paginationCtrls; ?></div><?php
	
	foreach ( $results['articles'] as $article ) {
		?>
		<div class="article">
			<h1 class="articleTitle">
				<a href="viewArticle.php?action=viewArticle&amp;articleId=<?php echo $article->id?>">
					<?php echo htmlspecialchars( $article->title )?>
				</a>
			</h1>
			<p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>

			<span class="pubDate"><?php echo date('j F Y', $article->publicationDate)?></span>
			<?php if ($article->tags){ ?>
			- <span class="tags"><?php echo htmlspecialchars($article->tags)?></span>
		<?php } ?>
		</div>
		<?php
	}
	?><div style="background:rgba(150,150,150,0.05); text-align:center; padding:8px;"><?php echo $paginationCtrls; ?></div><?php
}

function tagPage($tag){
	global $results;
	$results = array();
	$data = article::getList();
	$results['articles'] = $data['results'];
	$results['totalRows'] = $data['totalRows'];
	$results['pageTitle'] = "Article Archive | Page Title";
  
	foreach ( $results['articles'] as $article ) {
		if ($article->tags == $tag){
			?>
			<div class="article">
				<h1 class="articleTitle">
					<a href="viewArticle.php?action=viewArticle&amp;articleId=<?php echo $article->id?>">
						<?php echo htmlspecialchars( $article->title )?>
					</a>
				</h1>
				<p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>

				<span class="pubDate"><?php echo date('j F Y', $article->publicationDate)?></span>
				<?php if ($article->tags){ ?>
				- <span class="tags"><?php echo htmlspecialchars($article->tags)?></span>
			<?php } ?>
			</div>
			<?php
		}
	}
	
	?><!-- <p><?= $results['totalRows']?> article<?= ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p> --><?php
}

function viewArticle(){
	if (!isset($_GET["articleId"]) || !($_GET["articleId"])){
		header('location:index.php;');
	}
	
	global $results;
	$results = array();
	$results['article'] = Article::getById( (int)$_GET['articleId'] );
}

function homepage(){
  global $results;
  $results = array();
  $data = article::getList(6);
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Page Title";
  
  //Apresentação
  foreach ( $results['articles'] as $article ) { ?>
	<div class="article">
		<a href="viewArticle.php?action=viewArticle&amp;articleId=<?php echo $article->id?>">
			<h1 class="articleTitle">
				<?= htmlspecialchars( $article->title )?>
			</h1>
		</a>
		<p class="summary"><?= htmlspecialchars( $article->summary )?></p>
	</div>
<?php }
}

function newArticle(){
	$results = array();
	
	if ( isset( $_POST['saveChanges'] ) ) {
		$article = new Article;
		$article->storeFormValues($_POST);
		$article->insert();
		header( "Location: newArticle.php?status=saved" );
		exit();
	}
}

function editArticle(){
	$results = array();

	if ( isset( $_POST['saveChanges'] ) ) {
		if ( !$article = Article::getById( (int)$_GET['articleId'] ) ) {
			header( "Location: admin.php?error=articleNotFound" );
			return;
		}

		$article->storeFormValues($_POST);
		$article->update();
		header("Location: editArticle.php?status=changesSaved");
	}
}

function deleteArticle(){
  if ( !$article = Article::getById( (int)$_GET['articleId'] ) ) {
    header( "Location: admin.php?error=articleNotFound" );
    return;
  }
  $article->delete();
  header( "Location: admin.php?status=articleDeleted" );
}

function listArticles(){
	$results = array();
	$data = Article::getList();
	$results['articles'] = $data['results'];
	$results['totalRows'] = $data['totalRows'];

	echo '<table style="width:100%; text-align:center; table-layout:fixed; overflow:hidden; white-space:nowrap;">';
	foreach ( $results['articles'] as $article ) { ?>
	<tr>
		<td style="width:15%;">
			<button>Edit</button>
			<button>Delete</button>
		</td>
			<td style="width:12%; font-size:10pt; background:rgba(150,150,150,0.1); overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">	
				<a href="viewArticle.php?action=viewArticle&amp;articleId=<?php echo $article->id?>">
					<?= htmlspecialchars( $article->title )?>
				</a>
			</td>
			
			<td style="width:12%; font-size:8pt; background:rgba(150,150,150,0.1); overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
				<?= htmlspecialchars( $article->summary )?>
			</td>
			
			<td style="width:10%; font-size:10pt; background:rgba(150,150,150,0.1); overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
				<?= htmlspecialchars( date('j M y', $article->publicationDate))?>
			</td>
			
			<td style="width:50%; font-size:10pt; text-align:left; background:rgba(150,150,150,0.1); overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
				<?= htmlspecialchars($article->content) ?>
			</td>
	</tr>
	<?php }
	echo '</table>';

	if ( isset( $_GET['error'] ) ) {
	if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
	}

	if ( isset( $_GET['status'] ) ) {
	if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
	if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
	}
	}

function newComment(){
	global $userData;
	$content = mysql_real_escape_string($_POST['comment']);
	$query = 'INSERT INTO `comments` (`id`, `articleId`, `userId`, `content`, `timestamp`) VALUES (NULL, ' . (int)$_GET['articleId'] . ', ' . $userData['id'] . ', \'' . $content . '\', NULL)';
	mysql_query($query);
}
	
function showComments(){
	$query = mysql_query('SELECT *, UNIX_TIMESTAMP(timestamp) AS timestamp FROM comments WHERE articleId = ' . $_GET['articleId'] . ' ORDER BY timestamp DESC');
	while ($comment = mysql_fetch_assoc($query)){ ?>
		<div style="border-radius:2px; padding:4px 5px; margin:2px; background:rgba(255,255,255,0.05); box-shadow:0px 1px 1px rgba(0,0,0,0.35), inset 0px -1px 0px rgba(255,255,255,0.1);">
			<?php
				
			?>
			<div style="background-image:url('<?= userImage($comment['userId']) ?>'); background-size:cover; background-position:center; float:left; height:40px; width:40px; border-radius:3px; margin:4px 8px 0px 2px; box-shadow:0px 1px 5px rgba(0,0,0,0.5);">
			</div>
			<span style="font-weight:bold;">
			<?php
				echo usernameFromId($comment['userId']);
				if (loggedIn()){
				global $userData;
				if ($comment['userId'] == $userData['id'] || $userData['level'] <= 3){ ?>
					<form method="POST" style="float:right;">
						<span id="deleteComment">
							&times;
							<button name="deleteComment" value="<?= $comment['id'] ?>">Delete comment</button>
						</span>
					</form>
			<?php }}
			?>
			</span>
			<br />
			<span style="opacity:0.8;"><?= $comment['content'] ?></span>
			<br />
			<span style="font-size:8pt; opacity:0.4;"><?= date('j F Y', date($comment['timestamp']))?></span>
		</div>
	<?php }
}

function deleteComment(){
	if (loggedIn()){
		global $userData;
		$commentUserId = mysql_query('SELECT userId FROM comments WHERE id = ' . $_POST['deleteComment']);
		if ($commentUserId == $userData['id'] || $userData['level'] <= 3){ 
			mysql_query('DELETE FROM comments WHERE id = ' . $_POST['deleteComment']);
		}
	}
}
?>