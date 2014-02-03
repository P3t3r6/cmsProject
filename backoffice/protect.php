<?php
include '../core/init.php';
include '../templates/getTop.php';
?>

<center>
<h4 style="color:rgb(200,50,50); margin:0px;">Please login to continue</h4>
<?php include "../templates/" . $activeTemplate['name'] . "/includes/widgets/login.php"; ?>
</center>

<?php include "../templates/" . $activeTemplate['name'] . "/includes/overall/footer.php"; ?>