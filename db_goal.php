<?php
include('configPDO.php');

if(isset($_POST['noimg'])){	

$usrid1= $_POST['usrid'];
$gentry= $_POST['gentry'];
$gbewho= $_POST['gbewho'];
$ghavewhat= $_POST['ghavewhat'];
$gvibe= $_POST['gvibe'];
$gduedate= $_POST['gduedate'];
$gdate= $_POST['gdate'];
$gtype= $_POST['gtype'];
$gblock= $_POST['gblock'];
$gstatus="New";


$STM = $dbh->prepare("INSERT INTO tbl_goal(gentry, gbewho, ghavewhat, gvibe, gduedate, gdate, gtype, gblock, gstatus, usrid) VALUES (:gentry, :gbewho, :ghavewhat, :gvibe, :gduedate, :gdate, :gtype, :gblock, :gstatus, :usrid)");	
	
	$STM->bindParam(':gentry', $gentry);
	$STM->bindParam(':gbewho', $gbewho);
	$STM->bindParam(':ghavewhat', $ghavewhat);
	$STM->bindParam(':gvibe', $gvibe);
	$STM->bindParam(':gduedate', $gduedate);
	$STM->bindParam(':gdate', $gdate);
	$STM->bindParam(':gtype', $gtype);
	$STM->bindParam(':gblock', $gblock);
	$STM->bindParam(':gstatus', $gstatus);
	$STM->bindParam(':usrid', $usrid1);
	
$STM->execute();

$LastId = $dbh->lastInsertId();	

header("location:addgpic3.php?goalid=$LastId"); 

}


if(isset($_POST["goalimg"])){	

$usrid1= $_POST["usrid"];

  $gentry= $_POST['gentry'];
  $gbewho= $_POST['gbewho'];
  $ghavewhat= $_POST['ghavewhat'];
  //$fileName= $_POST['gimage'];
  $gvibe= $_POST['gvibe'];
  $gduedate= $_POST['gduedate'];
  $gdate= $_POST['gdate'];
  $gtype= $_POST['gtype'];
  $gblock= $_POST['gblock'];
  $gimage = $_POST['goalimg'];
  $gstatus="New";
  
 
 
	$STM = $dbh->prepare("INSERT INTO tbl_goal(gentry, gbewho, ghavewhat, gimage, gvibe, gduedate, gdate, gtype, gblock, gstatus, usrid) VALUES (:gentry, :gbewho, :ghavewhat, :gimage, :gvibe, :gduedate, :gdate, :gtype, :gblock, :gstatus, :usrid)");	
	
	$STM->bindParam(':gentry', $gentry);
	$STM->bindParam(':gbewho', $gbewho);
	$STM->bindParam(':ghavewhat', $ghavewhat);
	$STM->bindParam(':gimage', $gimage);
	$STM->bindParam(':gvibe', $gvibe);
	$STM->bindParam(':gduedate', $gduedate);
	$STM->bindParam(':gdate', $gdate);
	$STM->bindParam(':gtype', $gtype);
	$STM->bindParam(':gblock', $gblock);
	$STM->bindParam(':gstatus', $gstatus);
	$STM->bindParam(':usrid', $usrid1);
	
$STM->execute();
	

header("location:goals.php"); 
 
}

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

	
header("location:mygoal.php?goalid=$gid"); 

}

if(isset($_POST["del"])=="Delete"){
	
	$gid=$_POST['goalid'];


	$STM = $dbh->prepare("DELETE FROM tbl_goal WHERE goal_id = '$gid'");
	$STM->execute();
	
	$STM = $dbh->prepare("DELETE FROM tbl_goalstep WHERE goal_id = '$gid'");
	$STM->execute();

	
header("location:goals.php"); 
 
}



?>