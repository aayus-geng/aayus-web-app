<?php

include('init.php');
include('configPDO.php');

("SET NAMES 'UTF8'");


$STMtimediff = $dbh->prepare("SELECT * FROM sys_variables WHERE varname_en='timediff'"); 
$today1 = date("Y-m-d",time() + ($hourdiff * 3600));


			$STMT= $dbh->prepare("SELECT * FROM tbl_trans WHERE alert='alert1'");
			$STMT->execute();
			$row_trans = $STMT->fetch();
			$totalRows_trans = $STMT->rowCount();
					
			if($totalRows_trans>0) {
			?>
			
			
<a href="#" class="btn btntopup3" data-toggle="modal" data-target="#alert1" data-placement="right" title="" data-original-title="" onclick="opener.change('dashboard.php')">ALERT</a>			


			<?php } ?>

