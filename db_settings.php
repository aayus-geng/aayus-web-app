<?php


include('configPDO.php');


if(isset($_POST["tzone"])=="Save"){



  $tzone =$_POST['timezone'];
  $uid=$_POST['uid'];
  
 
	$STM = $dbh->prepare("Update tbl_users SET tzone='$tzone' WHERE id='$uid'");

	$STM->execute();
	
header( "location:settings.php"); 


}


if(isset($_POST["bckgrnd"])=="Continue"){



  $bckgrnd = $_POST['bckgrnd'];
  $uid=$_POST['uid'];
  
 
	$STM = $dbh->prepare("Update tbl_users SET appbckgrnd='$bckgrnd' WHERE id='$uid'");

	$STM->execute();
	
header( "location:settings.php"); 


}



if(isset($_POST["intervl"])=="Save"){



  $alrt =$_POST['alrt'];
  $uid=$_POST['uid'];
  
 
	$STM = $dbh->prepare("Update tbl_users SET alrtinterval='$alrt' WHERE id='$uid'");

	$STM->execute();
	
header( "location:settings.php"); 

}

if(isset($_POST["passupdate"])=="Save"){



  $upass =$_POST['upass'];
  $uid=$_POST['uid'];
  
 
	$STM = $dbh->prepare("Update tbl_users SET password='$upass' WHERE id='$uid'");

	$STM->execute();
	
header( "location:settings.php"); 

}


if(isset($_POST["pdata"])=="Save"){

  $fname =$_POST['fname'];
  $lname =$_POST['lname'];
  $country =$_POST['country'];
  $city =$_POST['city'];
  $email =$_POST['email'];
  $bday =$_POST['bday'];
  $gender =$_POST['gender'];
  
  $uid=$_POST['uid'];


  
 
	$STM = $dbh->prepare("Update tbl_users SET fname='$fname', lname='$lname', email='$email', country='$country', city='$city', sex='$gender', bday='$bday' WHERE id='$uid'");

	$STM->execute();
	
header( "location:settings.php"); 

}

if(isset($_POST["social"])=="Save"){
	
	$uid = $_POST['uid'];
	$fbuser = $_POST['fbuser'];
	$fbpass = $_POST['fbpass'];
	$instauser = $_POST['instauser'];
	$instapass = $_POST['instapass'];
	$twitruser = $_POST['twitruser'];
	$twitrpass = $_POST['twitrpass'];
	$gplususer = $_POST['gplususer'];
	$gpluspass = $_POST['gpluspass'];
	
$STM = $dbh->prepare("Update tbl_users SET fbuser='$fbuser', fbpass='$fbpass', instauser='$instauser', instapass='$instapass', twitruser='$twitruser', twitrpass='$twitrpass', gplususer='$gplususer', gpluspass='$gpluspass' WHERE id='$uid'");

	$STM->execute();
	

header("location:settings.php"); 
 
 
}
ob_start();

if(isset($_POST["ppic"])=="Upload"){

$uid = $_POST['uid'];


// Example of accessing data for a newly uploaded file
$fileName = $_FILES["uploaded"]["name"]; 
$fileTmpLoc = $_FILES["uploaded"]["tmp_name"];
// Path and file name
$pathAndName = "images/users/".$uid."-".$fileName;
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

  
 
	$STM = $dbh->prepare("Update tbl_users SET img='$docname' WHERE id='$uid'");

	$STM->execute();
	
header("location:settings.php"); 
 ob_end_flush(); 
}


?>