<?php

include('configPDO.php');

("SET NAMES 'UTF8'");

if(isset($_GET["del"])=="del"){
	
	$jid= $_POST['jid'];


	$STM = $dbh->prepare("DELETE FROM tbl_meditate WHERE journ_id = '$jid'");
	$STM->execute();

	
header("location:meditation.php"); 
 

}

if(isset($_POST["add"])=="Add"){
	

  $med_name= $_POST['med_name'];
  $meddate= $_POST['meddate'];
  $vibe= $_POST['mvibe'];
  $usrid= $_POST['usrid'];

  
   /*
 echo $med_name."  |med_name|  ";
  echo $meddate."  |meddate|  ";
  echo $vibe."  |vibe|  ";
  echo $usrid."  |usrid|  ";
  
   */ 
  
 

	$STM = $dbh->prepare("INSERT INTO tbl_meditate(med_name, meddate, vibe, usrid) VALUES (:med_name, :meddate, :vibe, :usrid)");	
	
	$STM->bindParam(':med_name', $med_name);
	$STM->bindParam(':meddate', $meddate);
	$STM->bindParam(':vibe', $vibe);
	$STM->bindParam(':usrid', $usrid);
	
$STM->execute();
	

header("location:meditation.php"); 
 

}


if(isset($_POST["edit"])=="Update"){
	
  $med_id= $_POST['med_id'];
  $med_name= $_POST['med_name'];
  $meddate= $_POST['meddate'];
  $vibe= $_POST['vibe'];
  $usrid= $_POST['usrid'];
	
/*  
  echo $jid."  |jid|  ";
  echo $jentry."  |jentry|  ";
  echo $jvibe."  |jvibe|  ";
  echo $jdate."  |jdate|  ";
  echo $jtime."  |jtime|  ";
  echo $jtype."  |jtype|  ";
  echo $usrid."  |usrid|  ";
  
  
  med_id
  med_name
  meddate
  vibe
  usrid
  
*/	
	
	$STM = $dbh->prepare('Update tbl_meditate SET jentry="'.$jentry.'", jvibe="'.$jvibe.'",  jdate="'.$jdate.'",  jtime="'.$jtime.'",  jtype="'.$jtype.'",  usrid="'.$usrid.'" WHERE med_id="'.$med_id.'"');

	$STM->execute();

	
header("location:meditation.php"); 


}


?>