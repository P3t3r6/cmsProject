<?php include '../core/init.php';
	  include '../templates/getTop.php';?>

<script>
	jQuery(window).load(function(){
		jQuery('#loading').fadeOut(2000);
	});
</script>
<div id="loading"></div>

<h1 class="pageTitle">Welcome to the <span style="font-family: 'Poiret One', cursive;">cmsProject</span></h1>

<?php homepage(); ?>

<?php include '../templates/getBot.php'; ?>