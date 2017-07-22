<?php

$STMtimediff = $dbh->prepare("SELECT * FROM sys_variables WHERE varname_en='timediff'"); 
$today1 = date("Y-m-d",time() + ($hourdiff * 3600));
$today2 = date("d-M-Y H:i",time() + ($hourdiff * 3600));


echo $today2;

?>