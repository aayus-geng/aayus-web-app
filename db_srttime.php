<?php

include('configPDO.php');

$today = date("Y-m-d");
$STMtimediff = $dbh->prepare("SELECT * FROM sys_variables WHERE varname_en='timediff'"); 
$today1 = date("Y-m-d H:i",time() + ($hourdiff * 3600));
$today2 = date("Y-m-d",time() + ($hourdiff * 3600));

	$cardid=$_GET['cardid'];
	$cuid=$_GET['cuid'];
	$sdate=date("Y-m-d",time() + ($hourdiff * 3600));
	$stime=date("H:i",time() + ($hourdiff * 3600));
	
	$STM = $dbh->prepare("INSERT INTO tbl_timemgmt(custid, tdate, start) VALUES (:custid,:tdate,:start)");
	
	$STM->bindParam(':custid', $cuid);
	$STM->bindParam(':tdate', $sdate);
	$STM->bindParam(':start', $stime);

	$STM->execute();
	
	
header("location:dashboard.php?uid=$cardid"); 


?>