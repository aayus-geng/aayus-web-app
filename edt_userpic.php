<?php
// We will include connection file first
include('configPDO.php');

 if(isset($_POST["userpic"])=="Upload"){

$uid=$_GET['uid']; 

// Example of accessing data for a newly uploaded file
$fileName = $_FILES["uploaded"]["name"]; 
$fileTmpLoc = $_FILES["uploaded"]["tmp_name"];
// Path and file name
$pathAndName = "images/users/".$fileName;
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
  $uid1=$_POST['puid'];
  
 
	$STM = $dbh->prepare("Update tbl_users SET img='$docname' WHERE id='$uid'");

	$STM->execute();
	
header( "location:tw_userview.php?userid=$uid"); 

}

if(isset($_POST["usersign"])=="Upload"){

$uid=$_GET['uida']; 

// Example of accessing data for a newly uploaded file
$fileName = $_FILES["uploaded"]["name"]; 
$fileTmpLoc = $_FILES["uploaded"]["tmp_name"];
// Path and file name
$pathAndName = "images/ssign/".$fileName;
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
  $uid1=$_POST['puid'];
  
 
	$STM = $dbh->prepare("Update tbl_users SET sign='$docname' WHERE id='$uid'");

	$STM->execute();
	
header( "location:tw_userview.php?userid=$uid"); 

}

if(isset($_POST["chngpass"])=="Save"){

$uid=$_GET['uidpass']; 

  $password =$_POST['password'];
  $uid1=$_POST['puid'];
  
 
	$STM = $dbh->prepare("Update tbl_users SET password='$password' WHERE id='$uid'");

	$STM->execute();
	
header( "location:tw_userview.php?userid=$uid"); 

}

?>