<?php
function archive() {
  global $results;
  $results = array();
  $data = article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Article Archive | Page Title";
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
?>