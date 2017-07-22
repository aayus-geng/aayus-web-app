<?php
ob_start();

$prevpg=$_SERVER['HTTP_REFERER'];

include('configPDO.php');


if(isset($_POST["tgrtext"])){	

  $tgrname= $_POST["tgrname"];
  $tgrtext= $_POST['tgrtext'];
  $usrid= $_POST['usrid'];
 

 
	$STM = $dbh->prepare("INSERT INTO tbl_trigger(tgr_name, tgr_text, usrid) VALUES (:tgr_name, :tgr_text, :usrid)");	
	
	$STM->bindParam(':tgr_name', $tgrname);
	$STM->bindParam(':tgr_text', $tgrtext);
	$STM->bindParam(':usrid', $usrid);
	
	$STM->execute();
	
	$STMtgrs = $dbh->prepare("SELECT trggr_id, usrid FROM tbl_trigger WHERE usrid='$usrid' ORDER BY trggr_id DESC LIMIT 1");

	$STMtgrs->execute();
	$STMtrgs1 = $STMtgrs->fetchAll();
	foreach($STMtrgs1 as $tgrs)
	$tid=$tgrs['trggr_id'];
	
	/*
	
	$STM4 = $dbh->prepare("INSERT INTO tbl_triggrtimes(trgr_id, trgr_time) VALUES (:trgr_id, :trgr_time)");	
	
	$STM4->bindParam(':trgr_id', $tid);
	$STM4->bindParam(':trgr_time', $trgrtime4);
	$STM4->execute();
	
	*/

	
	
header("location:triggertimes.php?trgid=$tid"); 
  
}	
	
if(isset($_POST['upload1'])){
	
$usrid= $_POST['usrid'];
	
$fileName = $_FILES["upload1"]["name"]; 
$fileTmpLoc = $_FILES["upload1"]["tmp_name"];

$pathAndName = "images/users/triggerpics/".$usrid."-".$fileName;

$moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);

if ($moveResult == true) {
    echo "File has been moved from " . $fileTmpLoc . " to" . $pathAndName;
	
	} else {
     echo "ERROR: File not moved correctly";
	exit;
}

  $tgrname= $_POST["tgrname"];
  $tgr_img= $pathAndName;
  
  //$usrid= $_POST['usrid'];
 

 
	$STM = $dbh->prepare("INSERT INTO tbl_trigger(tgr_name, tgr_img, usrid) VALUES (:tgr_name, :tgr_img, :usrid)");	
	
	$STM->bindParam(':tgr_name', $tgrname);
	$STM->bindParam(':tgr_img', $tgr_img);
	$STM->bindParam(':usrid', $usrid);
	
	$STM->execute();
	
	$STMtgrs = $dbh->prepare("SELECT trggr_id, usrid FROM tbl_trigger WHERE usrid='$usrid' ORDER BY trggr_id DESC LIMIT 1");

	$STMtgrs->execute();
	$STMtrgs1 = $STMtgrs->fetchAll();
	foreach($STMtrgs1 as $tgrs)
	$tid=$tgrs['trggr_id'];
	
	
	
header("location:triggertimes.php?trgid=$tid");
	
}	

	
	
?>