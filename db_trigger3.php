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
  $tgrtext= $_POST['tgrtext'];
  $tgrid= $_POST['tgrid1'];
 

 $STM = $dbh->prepare('Update tbl_trigger SET gentry="'.$gentry.'", gbewho="'.$gbewho.'", ghavewhat="'.$ghavewhat.'", gvibe="'.$gvibe.'",  gduedate="'.$gduedate.'" ,  gblock="'.$gblock.'" WHERE trggr_id="'.$tgrid.'"');

	$STM->execute();
 
	$STM = $dbh->prepare("INSERT INTO tbl_trigger(tgr_name, tgr_img, usrid) VALUES (:tgr_name, :tgr_img, :usrid)");	
	
	$STM->bindParam(':tgr_name', $tgrname);
	$STM->bindParam(':tgr_img', $tgr_img);
	$STM->bindParam(':usrid', $usrid);
	
	$STM->execute();
	

	
	
header("location:triggersa.php");
		
?>