<td style="width:255px; vertical-align:top;"><div style="height:100%; width:100%; padding:0px; margin:0px;">

<?php
if (loggedIn() == true) {
	include "../templates/" . $activeTemplate['name'] . "/includes/widgets/loggedIn.php";
	} else {
	include "../templates/" . $activeTemplate['name'] . "/includes/widgets/login.php";}
	
	include "../templates/" . $activeTemplate['name'] . "/includes/widgets/userCount.php";
?>
</div></td>