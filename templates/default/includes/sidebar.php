<td style="width:255px; vertical-align:top;"><div style="height:100%; width:100%; padding:0px; margin:0px;">

<?php
if (loggedIn() == true) {
	include '../templates/original/includes/widgets/loggedIn.php';
	} else {
	include '../templates/original/includes/widgets/login.php';}
	
	include '../templates/original/includes/widgets/userCount.php';
?>
</div></td>