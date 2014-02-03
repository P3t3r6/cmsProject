<?php include '../core/init.php';
	  include '../templates/getTop.php';
	  viewArticle();
	  ?>

      <h1 class="title"><?php echo htmlspecialchars( $results['article']->title )?></h1>
      <div><?php echo $results['article']->content?></div>
      <p class="pubDate">Published on <?php echo date('j F Y', $results['article']->publicationDate)?></p>
	  
<?php include '../templates/getBot.php'; ?>