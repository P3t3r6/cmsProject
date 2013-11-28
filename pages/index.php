<?php include '../core/init.php';
include '../templates/getTop.php'; ?>

<script>
	jQuery(window).load(function(){
		jQuery('#loading').fadeOut(2000);
	});
</script>

<div id="loading"></div>

<h1 class="title">Welcome to the <span style="font-family: 'Poiret One', cursive;">cmsProject</span></h1>
Under construction.

<?php
$directory = "posts";
$filenames = array();
$iterator = new DirectoryIterator($directory);
foreach ($iterator as $fileinfo) {
    if ($fileinfo->isFile()) {
        $filenames[] = (int)$fileinfo->getBasename('.php');
    }
}
rsort($filenames);
foreach ($filenames as $filename)
{
    include ($directory . '/' . $filename . '.php');
}
?>
</img style="width:100%; display:none;" src="http://www.hdwallsweb.com/wp-content/uploads/2013/07/17/western-tibet-highway_satellitenbild_grossplus.jpg"/>
<?php include '../templates/getBot.php'; ?>