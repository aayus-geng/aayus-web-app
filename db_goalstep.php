<?php
ob_start();

$prevpg=$_SERVER['HTTP_REFERER'];

include('configPDO.php');

if(isset($_POST["gstep"])=="Add"){	

  $goalid= $_POST["goalid"];
  $gsdate= $_POST['gsdate'];
  $gsvibe= $_POST['gsvibe'];
  $gsstartdate= $_POST['gsstartdate'];
  $gsduedate= $_POST['gsduedate'];
  $gspercent= $_POST['gspercent'];
  $gsstatus= $_POST['gsstatus'];
  $gscomment= $_POST['gscomment'];
  $gsentry= $_POST['gsentry'];

 
	$STM = $dbh->prepare("INSERT INTO tbl_goalstep(goal_id, gsdate, gsvibe, gsstartdate, gsduedate, gspercent, gsstatus, gscomment, gsentry) VALUES (:goalid, :gsdate, :gsvibe, :gsstartdate, :gsduedate, :gspercent, :gsstatus, :gscomment, :gsentry)");	
	
	$STM->bindParam(':goalid', $goalid);
	$STM->bindParam(':gsdate', $gsdate);
	$STM->bindParam(':gsvibe', $gsvibe);
	$STM->bindParam(':gsstartdate', $gsstartdate);
	$STM->bindParam(':gsduedate', $gsduedate);
	$STM->bindParam(':gspercent', $gspercent);
	$STM->bindParam(':gsstatus', $gsstatus);
	$STM->bindParam(':gscomment', $gscomment);
	$STM->bindParam(':gsentry', $gsentry);

$STM->execute();
	
header("location:$prevpg"); 
  
}




 /*   

  echo $goalid."  |goalid|  ";
  echo $gsdate."  |gsdate|  ";
  echo $gsvibe."  |gsvibe|  ";
  echo $gsduedate."  |gsduedate|  ";
  echo $gsstatus."  |gsstatus|  ";
  echo $gsentry."  |gsentry|  ";
  
*/

?>