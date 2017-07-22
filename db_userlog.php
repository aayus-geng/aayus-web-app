<?php

include('configPDO.php');


	$user=($_GET['usr']);
	
	$action="login";
	
	
	$STMtimediff = $dbh->prepare("SELECT * FROM sys_variables WHERE varname_en='timediff'");
    $STMtimediff->execute();
    $row_timediff = $STMtimediff->fetch();
	$totalRows_timediff = $row_timediff;
	
	$tdiff = $row_timediff['varoption'];
	
	
		$hourdiff = $tdiff; 
		$logtime = date("H:i",time() + ($hourdiff * 3600));
		$logdate = date("Y-m-d",time() + ($hourdiff * 3600));
			

		
			
		
		$STM = $dbh->prepare("INSERT INTO tbl_userlog(action, user, logdate, logtime) VALUES (:action,:user,:logdate,:logtime)");
    
		
    $STM->bindParam(':action', $action);
	$STM->bindParam(':user', $user);
	$STM->bindParam(':logdate', $logdate);
	$STM->bindParam(':logtime', $logtime);


	
$STM->execute();
	
	//$lastId = $dbh->lastInsertId();
	
//header("location:dashboard.php"); 


/*	
	echo $user." - user ||";
	echo $action." - action ||";
	echo $logdate." - logdate ||";
	echo $logtime." - logtime ||";	

	echo $timein." - timein ||";	
	
	
 */	

?>