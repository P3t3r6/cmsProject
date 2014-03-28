	<center>
		<span style="font-size:15pt;"><?= $userData['username'] ?></span>
		<br />
		<span style="font-size:10pt;">
			<?php
				echo ($userData['level'] == 1 ? 'God <br />' : '');
				echo ($userData['level'] == 2 ? 'Admin <br />' : '');
				echo ($userData['level'] == 3 ? 'Mod <br />' : '');
			?>
		</span>
		<br />
		<img src="<?= userImage(); ?>" style="width:100%; border-radius:3px; box-shadow:0px 5px 20px rgba(0,0,0,0.5);" />
	</center>
<?php
if ($userData['level'] <= 2){
	echo '<br /><a href="../backoffice"><button style="width:100%;">Backoffice</button></a>';
}
echo '<br /><a href="../pages/profile.php"><button style="width:100%;">Profile</button></a>';
echo '<br /><a href="?logout=logout"><button style="width:100%;">Logout</button></a>';
?>