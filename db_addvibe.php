<?php
include('configPDO.php');


if(isset($_POST["addvibe"])=="Save"){	

$usrid = $_POST["usrid"];
$vdate = $_POST["vdate"];
$vtime = $_POST["vtime"];

$Overall = $_POST["ovibe"];
$Financial = $_POST["fvibe"];
$Relationship = $_POST["rvibe"];
$Health = $_POST["hvibe"];


/*
  echo $usrid."  |usrid|  ";
  echo $vdate."  |vdate|  ";
  echo $Overall."  |Overall|  ";
  echo $Financial."  |Financial|  ";
  echo $Relationship."  |Relationship|  ";
  echo $Health."  |Health|  ";
*/

	$STM = $dbh->prepare("INSERT INTO tbl_vibes(usrid, vdate, vtime, Overall, Financial, Relationship, Health) VALUES (:usrid, :vdate, :vtime, :Overall, :Financial, :Relationship, :Health)");	
	
	$STM->bindParam(':usrid', $usrid);
	$STM->bindParam(':vdate', $vdate);
	$STM->bindParam(':vtime', $vtime);
	$STM->bindParam(':Overall', $Overall);
	$STM->bindParam(':Financial', $Financial);
	$STM->bindParam(':Relationship', $Relationship);
	$STM->bindParam(':Health', $Health);

$STM->execute();
	

header("location:dashboard.php"); 
 

}

/* 
  echo $gentry."  |gentry|  ";
  echo $gbewho."  |gbewho|  ";
  echo $ghavewhat."  |ghavewhat|  ";
  echo $gvibe."  |gvibe|  ";
  echo $gduedate."  |gduedate|  ";
Overall
Financial
Relationship
Health
 
*/ 

?>