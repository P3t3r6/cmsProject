<?php include '../core/init.php';
	  include '../templates/getTop.php';
	  viewArticle();
	  ?>
	  
	<div class="article" style="width:100%;">
		<h1 class="articleTitle"><?php echo htmlspecialchars( $results['article']->title )?></h1>
		<div style="background:rgba(255,255,255,0.03); padding:1px 15px;"><?php echo $results['article']->content?></div>
		<p class="pubDate">Published on <?php echo date('j F Y', $results['article']->publicationDate)?></p>
	</div>
	
<?php include '../templates/getBot.php'; ?>