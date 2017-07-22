<?php
include('configPDO.php');

$trnid=$_GET['trnid'];

$STM = $dbh->prepare("Update tbl_trans SET alert='cleared' WHERE tran_id='$trnid'");

	$STM->execute();
	
	
header("location:dashboard.php"); 




?>