<?php
session_start();
$errmsg_arr = array();
$errflag = false;
// configuration]

include('configPDO.php');
 
$user = $_POST['uname'];
$password = $_POST['pword'];
 
if($user == '') {
	$errmsg_arr[] = 'You must enter your Username';
	$errflag = true;
}
if($password == '') {
	$errmsg_arr[] = 'You must enter your Password';
	$errflag = true;
}

// query
$result = $dbh->prepare("SELECT * FROM tbl_users WHERE username= :hjhjhjh AND password= :asas");
$result->bindParam(':hjhjhjh', $user);
$result->bindParam(':asas', $password);
$result->execute();
$results = $result->fetch(PDO::FETCH_ASSOC);

if($results > 0) {
$_SESSION['username'] = $results['username'];
header("location: dashboard.php");
}
else{
	$errmsg_arr[] = 'Username and Password are incorrect or not found';
	$errflag = true;
}
if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: index.php");
	exit();
}

?>