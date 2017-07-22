<?php
session_start();
include('configPDO.php');

	
	$uid1 = $_SESSION['userid'];
	$file = "images/users/".$_SESSION['propic'];
	$doc= $_GET['img'];
	

	
	$STM = $dbh->prepare("Update tbl_users SET img='$file' WHERE `id`='$uid1'");

	$STM->execute();
	
	unset($_SESSION['propic']); 
	
header("location:dashboard.php");
exit();




?>