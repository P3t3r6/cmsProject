<?php

$files = scandir('.');
foreach ($files as $file){
	if ($file == '0'){
		header('location:dbConfig.php');
		exit();
	} else if ($file == '1'){
		header('location: pages/index.php');
		exit();
	}
}

//0781fabfce3f

//header('location: pages/index.php'); ?>