<?php include '../core/init.php';
protectPage();
restrictionLevel(1);
include '../templates/getTop.php';

if (isset($_GET['id']) && isset($_GET['changeLevel'])){
	mysql_query('UPDATE users SET level = ' . $_GET['changeLevel'] . ' WHERE id = ' . $_GET['id']);
}

$sql = mysql_query('SELECT * FROM users WHERE level <= 3 ORDER BY level');

?>
<script type="text/javascript">
function changeLevel($id){
	do {
		var newLevel = parseInt(prompt('Change user level', 'Please insert the new level'));
	} while (isNaN(newLevel))
	window.location = location.pathname + '?id=' + $id + '&changeLevel=' + newLevel;
}
</script>
	<table cellpadding="5px" style="width:780px; margin:20px auto; text-align:center;">
		<tr>
			<td colspan="4" style="background:rgba(150,150,150,0.2);">User levels</td>
		</tr>
		<tr>
			<td style="background:rgba(150,150,150,0.2);">Superuser</td>
			<td style="background:rgba(150,150,150,0.2);">Administrator</td>
			<td style="background:rgba(150,150,150,0.2);">Moderator</td>
			<td style="background:rgba(150,150,150,0.2);">Regular user</td>
		</tr>
		<tr>
			<td style="background:rgba(150,150,150,0.1);">1</td>
			<td style="background:rgba(150,150,150,0.1);">2</td>
			<td style="background:rgba(150,150,150,0.1);">3</td>
			<td style="background:rgba(150,150,150,0.1);">4</td>
		</tr>
	</table>
	<form method="POST">
	<table cellpadding="5px" style="width:780px; margin:0px auto; text-align:center; table-layout:fixed; overflow:hidden; white-space:nowrap;">
		<tr>
			<td style="width:16%; background:rgba(150,150,150,0.2);">Username</td>
			<td style="width:16%; background:rgba(150,150,150,0.2);">First Name</td>
			<td style="width:16%; background:rgba(150,150,150,0.2);">Last Name</td>
			<td style="width:25%; background:rgba(150,150,150,0.2);">Email</td>
			<td style="width:5%; background:rgba(150,150,150,0.2);">Level</td>
		</tr>
		<?php
		while ($user = mysql_fetch_assoc($sql)){
			if ($user['username'] != 'System'){
				?>
				<tr>
					<td style="width:16%; background:rgba(150,150,150,0.1);"><?= $user['username'] ?></td>
					<td style="width:16%; background:rgba(150,150,150,0.1);"><?= $user['firstName'] ?></td>
					<td style="width:16%; background:rgba(150,150,150,0.1);"><?= $user['lastName'] ?></td>
					<td style="width:25%; background:rgba(150,150,150,0.1);"><?= $user['email'] ?></td>
					<td style="width:5%; background:rgba(150,150,150,0.1);"><a href="#" onClick="changeLevel(<?= $user['id'] ?>)"><?= $user['level'] ?></a></td>
				</tr>
		<?php }} ?>
	</table>
	</form>
	
<?php include '../templates/getBot.php'; ?>