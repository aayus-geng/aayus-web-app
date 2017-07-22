<?php

include('configPDO.php');

$today = date("Y-m-d");
$STMtimediff = $dbh->prepare("SELECT * FROM sys_variables WHERE varname_en='timediff'"); 
$today1 = date("Y-m-d H:i",time() + ($hourdiff * 3600));
$today2 = date("Y-m-d",time() + ($hourdiff * 3600));

	$cardid=$_POST['cardid'];
	
			$STMD= $dbh->prepare("SELECT * FROM tbl_customer WHERE cardid='$cardid'");
			$STMD->execute();
			$row_cust = $STMD->fetch();
			$totalRows_cust = $row_cust;
	
	
	$custid=$row_cust['cust_ID'];
	$sdate=date("Y-m-d",time() + ($hourdiff * 3600));
	$stime=date("H:i",time() + ($hourdiff * 3600));
	
				// has checked in but not out...

				$STMD= $dbh->prepare("SELECT * FROM tbl_timemgmt WHERE custid='$custid' AND tdate='$today2' AND `end` IS NULL");
				$STMD->execute();
				$row_time = $STMD->fetch();
				$totalRows_time = $row_time;
				
				$timeid=$row_time['timeid'];
				$strttime=$row_time['start'];
				$endtime=$row_time['end'];
				
				if(isset($timeid))  {

				header("location:balance.php?cardid=$cardid&timeid=$timeid"); 			
				 exit();
				}
		
				// Less than x minutes can not check in
			
			$STMT= $dbh->prepare("SELECT sum(trntime_in) as timein, sum(trntime_out) as timeout, custid FROM tbl_trans WHERE custid='$custid'");
			$STMT->execute();
			$row_trans = $STMT->fetch();
			$totalRows_trans = $row_trans;
			
			$totalin=$row_trans['timein'];
			$totalout=$row_trans['timeout'];
				
			$remainmin = ($totalin-$totalout);
			
			if($remainmin < 5) {
			
			header("location:notime.php?cardid=$cardid"); 			
				exit();
			}
		
	
	$STM = $dbh->prepare("INSERT INTO tbl_timemgmt(custid, tdate, start) VALUES (:custid,:tdate,:start)");
	
	$STM->bindParam(':custid', $custid);
	$STM->bindParam(':tdate', $sdate);
	$STM->bindParam(':start', $stime);

	$STM->execute();
	
	
header("location:timein2.php?cardid=$cardid"); 


?>