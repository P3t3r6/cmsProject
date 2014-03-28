<?php include '../core/init.php';
protectPage();
restrictionLevel(2);

if ((!isset($_GET['toEdit']) || $_GET['toEdit'] == '') && !isset($_GET['status'])){
	header('location:index.php');
	exit;
} else if ((isset($_GET['toEdit']) && $_GET['toEdit'] != '')){
	$toEdit = $_GET['toEdit'];
	$fileToEdit = $templatePath . 'includes/' . $toEdit . '.php';
}

if (isset($_POST['save'])){
	$fileName = $fileToEdit;
	$handle = fopen($fileName, 'w') or die('Cannot open file:  '.$my_file);
	$data = $_POST['content'];
	fwrite($handle, $data);
	fclose($handle);
	header('location:?status=saved');
	exit;
}

include '../templates/getTop.php';

if (isset($_GET['status']) && $_GET['status'] == 'saved'){
	?>
		<center>
			<br />
			<p style='color:#3b4; font-size:18pt;'> Saved!</p>
			<a href="index.php"><button>Go to home</button></a>
		</center>
	<?php
} else {
?>

<br />
<script src="../plugins/ckeditor/ckeditor.js"></script>

<form method="POST">
	<textarea name="content" id="content" required>
		<?php echo file_get_contents($fileToEdit); ?>
	</textarea>
	
	<br />
	<center>
		<button name="save">Save Changes</button>
	</center>
</form>


<script type="text/javascript">
CKEDITOR.replace('content');
</script>

<?php
}
include '../templates/getBot.php'; ?>