<?php


// mysql hostname
$hostname = 'localhost';
// mysql username
$username = 'gitcil_fausr';
// mysql password
$password = '2ksGC89df$';
// Database Connection using PDO
try {
$dbh = new PDO("mysql:host=$hostname;dbname=gitcil_fadb;charset=utf8", $username, $password);


    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
//If we will not use catch statement, then in case of error zend engine terminate the script and display a back trace. This back trace will likely reveal the full database connection details, including the username and password.  
?>