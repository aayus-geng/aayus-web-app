<?php

include('configPDO.php');

("SET NAMES 'UTF8'");

if(isset($_GET["del"])=="del"){
	
	$jid= $_POST['jid'];


	$STM = $dbh->prepare("DELETE FROM tbl_journal WHERE journ_id = '$jid'");
	$STM->execute();

	
header("location:journals.php"); 
 

}

if(isset($_POST["add"])=="Add"){
	

  $jentry= $_POST['jentry'];
  $jvibe= $_POST['jvibe'];
  $jdate= $_POST['jdate'];
  $jtime= $_POST['jtime'];
  $jtype= $_POST['jtype'];
  $usrid= $_POST['usrid'];

  
  /*  
  echo $jentry."  |jentry|  ";
  echo $jvibe."  |jvibe|  ";
  echo $jdate."  |jdate|  ";
  echo $jtime."  |jtime|  ";
  echo $jtype."  |jtype|  ";
  echo $usrid."  |usrid|  ";
 */ 

	$STM = $dbh->prepare("INSERT INTO tbl_journal(jentry, jvibe, jdate, jtime, jtype, usrid) VALUES (:jentry, :jvibe, :jdate, :jtime, :jtype, :usrid)");	
	
	$STM->bindParam(':jentry', $jentry);
	$STM->bindParam(':jvibe', $jvibe);
	$STM->bindParam(':jdate', $jdate);
	$STM->bindParam(':jtime', $jtime);
	$STM->bindParam(':jtype', $jtype);
	$STM->bindParam(':usrid', $usrid);
	
$STM->execute();
	

header("location:journals.php"); 
 

}


if(isset($_POST["edit"])=="Update"){
	
  $jid= $_POST['jid'];
  $jentry= $_POST['jentry'];
  $jvibe= $_POST['jvibe'];
  $jdate= $_POST['jdate'];
  $jtime= $_POST['jtime'];
  $jtype= $_POST['jtype'];
  $usrid= $_POST['usrid'];
	
/*  
  echo $jid."  |jid|  ";
  echo $jentry."  |jentry|  ";
  echo $jvibe."  |jvibe|  ";
  echo $jdate."  |jdate|  ";
  echo $jtime."  |jtime|  ";
  echo $jtype."  |jtype|  ";
  echo $usrid."  |usrid|  ";
	
*/	
	
	$STM = $dbh->prepare('Update tbl_journal SET jentry="'.$jentry.'", jvibe="'.$jvibe.'",  jdate="'.$jdate.'",  jtime="'.$jtime.'",  jtype="'.$jtype.'",  usrid="'.$usrid.'" WHERE journ_id="'.$jid.'"');

	$STM->execute();

	
header("location:journals.php"); 


}


?>