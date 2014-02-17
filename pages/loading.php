<?php include '../core/init.php';
include '../templates/getTop.php'; ?>

<script>
	jQuery(window).load(function(){
		jQuery('#loading').fadeOut(2000);
	});
</script>

<div id="loading"></div>

<h1 class="pageTitle">Sleepyhead</h1>

<?php tagPage('Sleepyhead'); ?>

<?php include '../templates/getBot.php'; ?>