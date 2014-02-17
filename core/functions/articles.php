<?php

function archive() {
  global $results;
  $results = array();
  $data = article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Article Archive | Page Title";
  
	foreach ( $results['articles'] as $article ) {
		?>
		<h1 class="articleTitle">
			<a href="viewArticle.php?action=viewArticle&amp;articleId=<?php echo $article->id?>">
				<?php echo htmlspecialchars( $article->title )?>
			</a>
		</h1>
		<p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>

		<span class="pubDate"><?php echo date('j F Y', $article->publicationDate)?></span>
		<?php if ($article->tags){ ?>
		- <span class="tags"><?php echo htmlspecialchars($article->tags)?></span>
		<?php }
	}
	
	?><p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p><?php
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
			<h1 class="articleTitle">
				<a href="viewArticle.php?action=viewArticle&amp;articleId=<?php echo $article->id?>">
					<?php echo htmlspecialchars( $article->title )?>
				</a>
			</h1>
			<p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>

			<span class="pubDate"><?php echo date('j F Y', $article->publicationDate)?></span>
			<?php if ($article->tags){ ?>
			- <span class="tags"><?php echo htmlspecialchars($article->tags)?></span>
			<?php }
		}
	}
	
	?><!-- <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p> --><?php
}

function viewArticle() {
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
	homepage();
    return;
  }

  global $results;
  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] );
  $results['pageTitle'] = $results['article']->title . " | Page Title";
}

function homepage() {
  global $results;
  $results = array();
  $data = article::getList(5);
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Page Title";
  
  //Apresentação
  foreach ( $results['articles'] as $article ) { ?>
		<a href="viewArticle.php?action=viewArticle&amp;articleId=<?php echo $article->id?>">
			<h1 class="articleTitle">
				<?php echo htmlspecialchars( $article->title )?>
			</h1>
		</a>
		
		<p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>

<?php }
}

function newArticle() {

  $results = array();
  $results['pageTitle'] = "New Article";
  $results['formAction'] = "newArticle";

  if ( isset( $_GET['saveChanges'] ) ) {

    // User has posted the article edit form: save the new article
    $article = new Article;
    $article->storeFormValues($_GET);
    $article->insert();
    header( "Location: newArticle.php?status=changesSaved" );
	
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

  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
  }

  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  }

  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}

?>