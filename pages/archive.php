<?php include '../core/init.php';
	  include '../templates/getTop.php';?>

      <h1 class="pageTitle">Article Archive</h1>

<?php
archive();
foreach ( $results['articles'] as $article ) { ?>

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
} ?>
	<p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
<?php include '../templates/getBot.php'; ?>