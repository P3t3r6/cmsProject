<?php include '../core/init.php';
include '../templates/getTop.php'; ?>

<h1 class="pageTitle">Downloads</h1>
Downloads page.

<?php
archive();
foreach ( $results['articles'] as $article ) { 
	if ($article->tags == 'downloads'){
?>

<h1 class="articleTitle">
	<a href="viewArticle.php?action=viewArticle&amp;articleId=<?php echo $article->id?>">
		<?php echo htmlspecialchars( $article->title )?>
	</a>
</h1>
<p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>

<span class="pubDate"><?php echo date('j F Y', $article->publicationDate)?></span>
 - <span class="tags"><?php echo htmlspecialchars($article->tags)?></span>
<?php }
} ?>

<?php include '../templates/getBot.php'; ?>