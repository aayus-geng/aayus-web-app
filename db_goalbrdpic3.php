<?php
ob_start();

include('configPDO.php');

$usrid1= $_POST["usrid"];

// Example of accessing data for a newly uploaded file
$fileName = $_FILES["uploaded"]["name"]; 
$fileTmpLoc = $_FILES["uploaded"]["tmp_name"];
// Path and file name
$pathAndName = "images/users/goalpics/".$usrid1."-".$fileName;
// Run the move_uploaded_file() function here
$moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
// Evaluate the value returned from the function if needed
if ($moveResult == true) {
    echo "File has been moved from " . $fileTmpLoc . " to" . $pathAndName;
	
} else {
     echo "ERROR: File not moved correctly";
	exit;
}
  $goalid= $_POST["goalid"];
  $gimage = $pathAndName;
  
  $STM = $dbh->prepare('Update tbl_goal SET gimage="'.$gimage.'" WHERE goal_id="'.$goalid.'"');

	$STM->execute();

	
header("location:mygoal.php?goalid=$goalid"); 


?>