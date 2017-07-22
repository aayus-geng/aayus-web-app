<?php
include('configPDO.php');


	
	$gsid=$_POST['gsid'];
	$gid=$_POST['goalid'];
	
	$STM = $dbh->prepare("DELETE FROM tbl_goalstep WHERE gstep_id = '$gsid'");
	$STM->execute();

	
header("location:mygoal.php?goalid=$gid")
 

  
?>