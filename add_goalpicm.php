<?php
ob_start();
// We will include connection file first
include('configPDO.php');



if(isset($_POST["gpic"])=="Upload"){

$goalid = $_POST['gid'];


// Example of accessing data for a newly uploaded file
$fileName = $_FILES["uploaded"]["name"]; 
$fileTmpLoc = $_FILES["uploaded"]["tmp_name"];
// Path and file name
$pathAndName = "images/users/goalpics/".$goalid."-".$fileName;
// Run the move_uploaded_file() function here
$moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
// Evaluate the value returned from the function if needed
if ($moveResult == true) {
    echo "File has been moved from " . $fileTmpLoc . " to" . $pathAndName;
	
} else {
     echo "ERROR: File not moved correctly";
	exit;
}
  
  $docname = $pathAndName;

  
 
	$STM = $dbh->prepare("Update tbl_goal SET gimage='$docname' WHERE goal_id='$goalid'");

	$STM->execute();
	
header("location:mgoals.php"); 
 ob_end_flush(); 
}


if(isset($_POST["chngpass"])=="Save"){

$uid=$_GET['uidpass']; 

  $password =$_POST['password'];
  $uid1=$_POST['puid'];
  
 
	$STM = $dbh->prepare("Update tbl_users SET password='$password' WHERE id='$uid'");

	$STM->execute();
	
header( "location:tw_sysadmin.php"); 
 ob_end_flush(); 
}

?>