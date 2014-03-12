<?php

function archive() {
  global $results;
  $results = array();
  $data = article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  //$results['pageTitle'] = "Article Archive | Page Title";
  
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
	
	?><br /><p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p><?php
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

function viewArticle() {
	if (!isset($_GET["articleId"]) || !($_GET["articleId"])){
		header('location:index.php;');
	}
	
	global $results;
	$results = array();
	$results['article'] = Article::getById( (int)$_GET["articleId"] );
	//964723030 a.
	//219612551 c.
	//968500210 p.
	//$results['pageTitle'] = $results['article']->title . " | Page Title";
}

function homepage() {
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

function newArticle() {

  $results = array();
  //$results['pageTitle'] = "New Article";
  //$results['formAction'] = "newArticle";

  if ( isset( $_POST['saveChanges'] ) ) {

    // User has posted the article edit form: save the new article
    $article = new Article;
    $article->storeFormValues($_POST);
    $article->insert();
    header( "Location: newArticle.php?status=saved" ); 
	
	echo implode($results);
  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {

    // User has not posted the article edit form yet: display the form
	
	echo implode($results);
    $results['article'] = new Article;
  }

}

function editArticle() {

  $results = array();
  $results['pageTitle'] = "Edit Article";
  $results['formAction'] = "editArticle";

  if ( isset( $_POST['saveChanges'] ) ) {

    // User has posted the article edit form: save the article changes

    if ( !$article = Article::getById( (int)$_POST['articleId'] ) ) {
      header( "Location: admin.php?error=articleNotFound" );
      return;
    }

    $article->storeFormValues( $_POST );
    $article->update();
    header( "Location: admin.php?status=changesSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {

    // User has not posted the article edit form yet: display the form
    $results['article'] = Article::getById( (int)$_GET['articleId'] );
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }
}

function deleteArticle() {

  if ( !$article = Article::getById( (int)$_GET['articleId'] ) ) {
    header( "Location: admin.php?error=articleNotFound" );
    return;
  }
  $article->delete();
  header( "Location: admin.php?status=articleDeleted" );
}

function listArticles() {
	$results = array();
	$data = Article::getList();
	$results['articles'] = $data['results'];
	$results['totalRows'] = $data['totalRows'];
	$results['pageTitle'] = "All Articles";

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

?>