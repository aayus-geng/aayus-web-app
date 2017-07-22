<?php
session_start();
include('configPDO.php');

$filename = date('YmdHis') . '.jpg';

$_SESSION['propic']=$filename;

$result = file_put_contents( 'images/users/'.$filename, file_get_contents('php://input') );

if (!$result) {
	print "ERROR: Failed to write data to $filename, check permissions\n";
	exit();

	} 
	
$url = 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/images/users/' . $filename;


print "$url\n";

?>
