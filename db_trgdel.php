<?php
include('configPDO.php');


	
	$tgrid1=$_GET['tgrid'];
	
	
	$STM = $dbh->prepare("DELETE FROM tbl_trigger WHERE trggr_id = '$tgrid1'");
	$STM->execute();

	
header("location:triggersa.php")
 

  
?>