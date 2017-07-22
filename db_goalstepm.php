<?php
ob_start();

include('configPDO.php');


if(isset($_POST["gstep"])=="Add"){	

  $goalid= $_POST["goalid"];
  $gsdate= $_POST['gsdate'];
  $gsvibe= $_POST['gsvibe'];
  $gsduedate= $_POST['gsduedate'];
  $gsstatus= $_POST['gsstatus'];
  $gsentry= $_POST['gsentry'];

 /*   

  echo $goalid."  |goalid|  ";
  echo $gsdate."  |gsdate|  ";
  echo $gsvibe."  |gsvibe|  ";
  echo $gsduedate."  |gsduedate|  ";
  echo $gsstatus."  |gsstatus|  ";
  echo $gsentry."  |gsentry|  ";
  
*/

 
	$STM = $dbh->prepare("INSERT INTO tbl_goalstep(goal_id, gsdate, gsvibe, gsduedate, gsstatus, gsentry) VALUES (:goalid, :gsdate, :gsvibe, :gsduedate, :gsstatus, :gsentry)");	
	
	$STM->bindParam(':goalid', $goalid);
	$STM->bindParam(':gsdate', $gsdate);
	$STM->bindParam(':gsvibe', $gsvibe);
	$STM->bindParam(':gsduedate', $gsduedate);
	$STM->bindParam(':gsstatus', $gsstatus);
	$STM->bindParam(':gsentry', $gsentry);

	
$STM->execute();
	

header("location:mgoals.php"); 
 
 
}



?>