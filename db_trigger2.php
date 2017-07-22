<?php
ob_start();

$prevpg=$_SERVER['HTTP_REFERER'];

include('configPDO.php');

	
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
  $trgrtime1= $_POST['trgrtime1'];
  $trgrtime2= $_POST['trgrtime2'];
  $trgrtime3= $_POST['trgrtime3'];
  $trgrtime4= $_POST['trgrtime4'];
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
	
	$STM1 = $dbh->prepare("INSERT INTO tbl_triggrtimes(trgr_id, trgr_time) VALUES (:trgr_id, :trgr_time)");	
	
	$STM1->bindParam(':trgr_id', $tid);
	$STM1->bindParam(':trgr_time', $trgrtime1);
	$STM1->execute();
	
	$STM2 = $dbh->prepare("INSERT INTO tbl_triggrtimes(trgr_id, trgr_time) VALUES (:trgr_id, :trgr_time)");	
	
	$STM2->bindParam(':trgr_id', $tid);
	$STM2->bindParam(':trgr_time', $trgrtime2);
	$STM2->execute();
	
	$STM3 = $dbh->prepare("INSERT INTO tbl_triggrtimes(trgr_id, trgr_time) VALUES (:trgr_id, :trgr_time)");	
	
	$STM3->bindParam(':trgr_id', $tid);
	$STM3->bindParam(':trgr_time', $trgrtime3);
	$STM3->execute();
	
	$STM4 = $dbh->prepare("INSERT INTO tbl_triggrtimes(trgr_id, trgr_time) VALUES (:trgr_id, :trgr_time)");	
	
	$STM4->bindParam(':trgr_id', $tid);
	$STM4->bindParam(':trgr_time', $trgrtime4);
	$STM4->execute();
	
	
header("location:triggersa.php"); 
		
?>