<?php
include('configPDO.php');


if(isset($_POST["edit"])){
	
  $gid=$_POST['goalid'];
  $gsdate= $_POST['gsdate'];
  $gsvibe= $_POST['gsvibe'];
  $gsstartdate= $_POST['gsstartdate'];
  $gsduedate= $_POST['gsduedate'];
  $gspercent= $_POST['gspercent'];
  $gsstatus= $_POST['gsstatus'];
  $gscomment= $_POST['gscomment'];
  $gsentry= $_POST['gsentry'];
  $gsid= $_POST['gsid'];
	
	$STM = $dbh->prepare('Update tbl_goalstep SET gsdate="'.$gsdate.'", gsvibe="'.$gsvibe.'", gsstartdate="'.$gsstartdate.'", gsduedate="'.$gsduedate.'", gspercent="'.$gspercent.'",  gsstatus="'.$gsstatus.'", gscomment="'.$gscomment.'",  gsentry="'.$gsentry.'" WHERE gstep_id="'.$gsid.'"');
	

	$STM->execute();

	
header("location:mygoal.php?goalid=$gid"); 

}

?>