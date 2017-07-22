<?php
ob_start();

$prevpg=$_SERVER['HTTP_REFERER'];

include('configPDO.php');

	
$usrid1 = $_POST['usrid'];
	
$fileName = $_FILES["upload1"]["name"]; 
$fileTmpLoc = $_FILES["upload1"]["tmp_name"];

$pathAndName = "images/users/busterpics/".$usrid1."-".$fileName;

$moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);

if ($moveResult == true) {
    echo "File has been moved from " . $fileTmpLoc . " to" . $pathAndName;
	
	} else {
     echo "ERROR: File not moved correctly";
	exit;
}

  $bstr_name= $_POST["bstrname"];
  
  $bstr_img= $pathAndName;
  $bsted="pending";
  $bcomment= $_POST["comment"];
  
  

 
	$STM = $dbh->prepare("INSERT INTO tbl_buster(bstr_name, bstr_img, bsted, bcomment, usrid) VALUES (:bstr_name, :bstr_img, :bsted, :bcomment, :usrid)");	
	
	$STM->bindParam(':bstr_name', $bstr_name);
	$STM->bindParam(':bstr_img', $bstr_img);
	$STM->bindParam(':bsted', $bsted);
	$STM->bindParam(':bcomment', $bcomment);
	$STM->bindParam(':usrid', $usrid1);
	
	$STM->execute();
	

	
header("location:$prevpg"); 

/* 
  echo $usrid."  |usrid|  ";
  echo $bstr_name."  |bstr_name|  ";
  echo $bstr_img."  |bstr_img|  ";
  echo $bsted."  |bsted|  ";
  echo $bcomment."  |bcomment|  ";
  
 */ 
		
?>