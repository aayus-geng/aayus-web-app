<?php
include('configPDO.php');

if(isset($_POST["edit"])=="Update"){
	
  $gid= $_POST['gid'];
  $gentry= $_POST['gentry'];
  $gbewho= $_POST['gbewho'];
  $ghavewhat= $_POST['ghavewhat'];
  $gvibe= $_POST['gvibe'];
  $gduedate= $_POST['gduedate'];
  $gblock= $_POST['gblock'];
 
	
	$STM = $dbh->prepare('Update tbl_goal SET gentry="'.$gentry.'", gbewho="'.$gbewho.'", ghavewhat="'.$ghavewhat.'", gvibe="'.$gvibe.'",  gduedate="'.$gduedate.'" ,  gblock="'.$gblock.'" WHERE goal_id="'.$gid.'"');

	$STM->execute();

	
header("location:goalview.php?goalid=$gid"); 

}


?>