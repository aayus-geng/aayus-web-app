<?php
ob_start();

include('configPDO.php');

if(isset($_POST["add"])=="Add"){	

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
	//exit;
}


  $gentry= $_POST['gentry'];
  $gbewho= $_POST['gbewho'];
  $ghavewhat= $_POST['ghavewhat'];
  //$fileName= $_POST['gimage'];
  $gvibe= $_POST['gvibe'];
  $gduedate= $_POST['gduedate'];
  $gdate= $_POST['gdate'];
  $gtype= $_POST['gtype'];
  $gblock= $_POST['gblock'];
  $gimage = $pathAndName;
  $gstatus="New";
  
/* 
  echo $gentry."  |gentry|  ";
  echo $gbewho."  |gbewho|  ";
  echo $ghavewhat."  |ghavewhat|  ";
  echo $gvibe."  |gvibe|  ";
  echo $gduedate."  |gduedate|  ";
  echo $gdate."  |gdate|  ";
  echo $gtype."  |gtype|  ";
  echo $gblock."  |gblock|  ";
  echo $gstatus."  |gstatus|  ";
  echo $usrid."  |usrid|  ";

echo $gimage."  |gimage|  ";
*/ 
 
 
	$STM = $dbh->prepare("INSERT INTO tbl_goal(gentry, gbewho, ghavewhat, gimage, gvibe, gduedate, gdate, gtype, gblock, gstatus, usrid) VALUES (:gentry, :gbewho, :ghavewhat, :gimage, :gvibe, :gduedate, :gdate, :gtype, :gblock, :gstatus, :usrid)");	
	
	$STM->bindParam(':gentry', $gentry);
	$STM->bindParam(':gbewho', $gbewho);
	$STM->bindParam(':ghavewhat', $ghavewhat);
	$STM->bindParam(':gimage', $gimage);
	$STM->bindParam(':gvibe', $gvibe);
	$STM->bindParam(':gduedate', $gduedate);
	$STM->bindParam(':gdate', $gdate);
	$STM->bindParam(':gtype', $gtype);
	$STM->bindParam(':gblock', $gblock);
	$STM->bindParam(':gstatus', $gstatus);
	$STM->bindParam(':usrid', $usrid1);
	
$STM->execute();
	

header("location:mgoals.php"); 
 
}



("SET NAMES 'UTF8'");

if(isset($_POST["delgoal"])=="Delete"){
	
	$gid=$_POST['gid'];


	$STM = $dbh->prepare("DELETE FROM tbl_goal WHERE goal_id = '$gid'");
	$STM->execute();

	
header("location:mgoals.php"); 
 

}


if(isset($_POST["edit"])=="Update"){
	
  $gid= $_POST['gid'];
  $gentry= $_POST['gentry'];
  $gbewho= $_POST['gbewho'];
  $ghavewhat= $_POST['ghavewhat'];
  $gimage= $_POST['gimage'];
  $gvibe= $_POST['gvibe'];
  $gduedate= $_POST['gduedate'];
  $gtype= $_POST['gtype'];
  $usrid= $_POST['usrid'];
  $gstatus=$_POST['gstatus'];


  

  
/*  
  echo $jid."  |jid|  ";
  echo $jentry."  |jentry|  ";
  echo $jvibe."  |jvibe|  ";
  echo $jdate."  |jdate|  ";
  echo $jtime."  |jtime|  ";
  echo $jtype."  |jtype|  ";
  echo $usrid."  |usrid|  ";
	
*/	
	
	$STM = $dbh->prepare('Update tbl_goal SET gentry="'.$gentry.'", gbewho="'.$gbewho.'", ghavewhat="'.$ghavewhat.'", gimage="'.$gimage.'", gvibe="'.$gvibe.'",  gduedate="'.$gduedate.'",  gstatus="'.$gstatus.'",  gtype="'.$gtype.'",  usrid="'.$usrid.'" WHERE goal_id="'.$gid.'"');

	$STM->execute();

	
header("location:mgoals.php"); 

}

if(isset($_POST["gstep"])=="Add"){
	

  $gsentry= $_POST['gsentry'];
  $gsvibe= $_POST['gsvibe'];
  $gsduedate= $_POST['gsduedate'];
  $gsdate= $_POST['gsdate'];
  $goalid= $_POST['goalid'];
  $gsstatus= $_POST['gsstatus'];
  

  
 /*  
  echo $gentry."  |gentry|  ";
  echo $gvibe."  |gvibe|  ";
  echo $gduedate."  |gduedate|  ";
  echo $gdate."  |gdate|  ";
  echo $gtype."  |gtype|  ";
  echo $usrid."  |usrid|  ";
*/ 
 
	$STM = $dbh->prepare("INSERT INTO tbl_goal(gentry, gvibe, gduedate, gdate, gtype, gstatus, usrid) VALUES (:gentry, :gvibe, :gduedate, :gdate, :gtype, :gstatus, :usrid)");	
	
	$STM->bindParam(':gentry', $gentry);
	$STM->bindParam(':gvibe', $gvibe);
	$STM->bindParam(':gduedate', $gduedate);
	$STM->bindParam(':gdate', $gdate);
	$STM->bindParam(':gtype', $gtype);
	$STM->bindParam(':gstatus', $gstatus);
	$STM->bindParam(':usrid', $usrid);
	
$STM->execute();
	

header("location:mgoals.php"); 
  

}

if(isset($_POST["gstep"])=="Add"){	

  $goalid= $_POST["goalid"];
  $gsdate= $_POST['gsdate'];
  $gsvibe= $_POST['gsvibe'];
  $gsduedate= $_POST['gsduedate'];
  $gsstatus= $_POST['gsstatus'];
  $gsentry= $_POST['gsentry'];

  

  echo $goalid."  |goalid|  ";
  echo $gsdate."  |gsdate|  ";
  echo $gsvibe."  |gsvibe|  ";
  echo $gsduedate."  |gsduedate|  ";
  echo $gsstatus."  |gsstatus|  ";
  echo $gsentry."  |gsentry|  ";
  

 /* 
 
	$STM = $dbh->prepare("INSERT INTO tbl_goalstep(goalid, gsdate, gsvibe, gsduedate, gsstatus, gsentry) VALUES (:goalid, :gsdate, :gsvibe, :gsduedate, :gsstatus, :gsentry)");	
	
	$STM->bindParam(':goalid', $goalid);
	$STM->bindParam(':gsdate', $gsdate);
	$STM->bindParam(':gsvibe', $gsvibe);
	$STM->bindParam(':gsduedate', $gsduedate);
	$STM->bindParam(':gsstatus', $gsstatus);
	$STM->bindParam(':gsentry', $gsentry);

	
$STM->execute();
	

header("location:goals.php"); 
 
*/ 
}



?>