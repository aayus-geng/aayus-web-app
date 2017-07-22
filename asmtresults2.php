<?php
session_start();

include('init.php');
include('configPDO.php');

("SET NAMES 'UTF8'");

$user=($_SESSION['username']);

$STMu= $dbh->prepare("SELECT * FROM tbl_users WHERE username = '$user'");
    $STMu->execute();
    $row_user = $STMu->fetch();
	$totalRows_user = $row_user;

$uimg = $row_user['img'];	
$userida = $row_user['id'];
$ugrp = $row_user['ugroup'];
$fname = $row_user['fname'];
$lname = $row_user['lname'];
$bckgrnd = $row_user['appbckgrnd'];
$tz = $row_user['tzone'];
$_SESSION['usrid']=$userida;
date_default_timezone_set($tz);



$today1 = date("Y-m-d H:i");
$today2 = date("Y-m-d");
$time1 = date("H:i:s");
$today1 = date("Y-m-d");
$today2 = date("Y-m-d");

$gdate1 = date("Y-m-d");
$gtime1 = date("H:i a");

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta https-equiv="X-UA-Compatible" content="IE=edge">

  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://js.pusher.com/3.0/pusher.min.js"></script>

<script src="https://code.jquery.com/jquery-latest.js"></script> 
     
<link rel="apple-touch-icon" sizes="180x180" href="assets/images/mindfullogo2.png">
<link rel="icon" type="image/png" href="assets/images/mindfullogo2.png">
<link rel="icon" type="image/png" href="assets/images/mindfullogo2.png">
<link rel="shortcut icon" href="assets/images/mindfullogo2.png" type="image/png">
     

<style>
.datepicker {
z-index: 99999 !important;
}
.btntopup {
	background-color: #e0e0e0;
	border-radius: 6px;
	width: 140px;
	color: purple;
	padding: 5px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;	
} 

.btntopup:hover {
    background-color: #999999;
    color: white;
}

p.small {
    line-height: 60%;
}

.maindiv{ 
text-align:left; 
FONT-SIZE: 18px;
font-family: Verdana;
position: relative; 
right: -100px; 
top: 100px; 
background-color: #5406A0; 
width: 700px; 
padding: 10px; 
}

.lb{ 
 text-align:left; 
FONT-SIZE: 14px;
font-weight: normal; color: white;
font-family: Verdana;
position: relative; 
right: -20px; 

}

</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<link href="assets/modal/css/bootstrap-modal.css" rel="stylesheet" />


<link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

 Optional theme 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
-->
<!-- Latest compiled and minified JavaScript 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
-->
<link rel='stylesheet' href='assets/css/bootstrap.css'> 

<link rel='stylesheet' href='assets/css/plugins/fullcalendar.css'>
<link rel='stylesheet' href='assets/css/plugins/datatables/datatables.css'>
<link rel='stylesheet' href='assets/css/plugins/datatables/bootstrap.datatables.css'>
<link rel='stylesheet' href='assets/css/plugins/chosen.css'>
<link rel='stylesheet' href='assets/css/plugins/jquery.timepicker.css'>
<link rel='stylesheet' href='assets/css/plugins/daterangepicker-bs3.css'>
<link rel='stylesheet' href='assets/css/plugins/colpick.css'>
<link rel='stylesheet' href='assets/css/plugins/dropzone.css'>
<link rel='stylesheet' href='assets/css/plugins/jquery.handsontable.full.css'>
<link rel='stylesheet' href='assets/css/plugins/jscrollpane.css'>
<link rel='stylesheet' href='assets/css/plugins/jquery.pnotify.default.css'>
<link rel='stylesheet' href='assets/css/plugins/jquery.pnotify.default.icons.css'>
<link rel='stylesheet' href='assets/css/<?php echo $bckgrnd;?>'>
<link rel="stylesheet" href="survey/style.css" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  
  <script src="js/lib/jquery.min.js" type="text/javascript"></script>
	<script src="js/lib/jquery.validate.min.js" type="text/javascript"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
  
  <div id="header">
		
		<div class="page-full-width cf">

  <title>Aayus Assessment</title>
  
  
        
</head>

<body>


<?php require("top_bar.php"); ?>


  <div class="side">
  <div class="sidebar-wrapper">
  <?php 
  
  if ($ugrp=="admin"){ include_once("menuadm.php");}   if ($ugrp=="user") { 	include_once("menuuser.php");  }
  
  ?>
	</div>
<div class="main-content">


<br>


<div class="row">


  <div class="widget widget-orange">
      

      <div class="widget-content">
				<div class="col-md-10" align="center">

<?Php

			$STMadate2 = $dbh->prepare("SELECT MAX(adate) as lstdate2, usrid FROM poll_answer2 WHERE usrid='$userida'");
			$STMadate2->execute();
			$STMadate22 = $STMadate2->fetchAll();
			foreach($STMadate22 as $adate2)
			
			$lstdate2=$adate2['lstdate2'];
				
			$STMasmtres = $dbh->prepare("SELECT SUM(opt) as ansrtot, COUNT(ans_id) as totans, qst_id, usrid FROM poll_answer2 WHERE poll_answer2.usrid='$userida' AND adate='$lstdate2'");
			$STMasmtres->execute();
			$STMasmtresults = $STMasmtres->fetchAll();
			foreach($STMasmtresults as $asmtresults)
			
			$STMasmtres1 = $dbh->prepare("SELECT COUNT(opt) as ansyes1, COUNT(ans_id) as totans1, qst_id, usrid FROM poll_answer WHERE poll_answer.usrid='$userida' AND opt='yes' AND adate='$lstdate2'");
			$STMasmtres1->execute();
			$STMasmtresults1 = $STMasmtres1->fetchAll();
			foreach($STMasmtresults1 as $asmtresults1)
							  
			 			 
			 $STMasmt1 = $dbh->prepare("SELECT assess_id, qst_id, opt, usrid, atopic FROM poll_answer2 left join lut_assessment2 ON lut_assessment2.assess_id = poll_answer2.qst_id WHERE poll_answer2.usrid = '$userida' AND poll_answer2.adate='$lstdate2'");
			$STMasmt1->execute();
			$STMasmtr1 = $STMasmt1->fetchAll();
			?>
			
			<h3>Results Assessment 2</h3>
			<br><br>
			<table width="400" align="center">
			<tr>
			<td align="centered"><strong><?php echo "Total = ".$asmtresults['ansrtot'];?><?php echo " out of 100";?></strong></td>
			<td align="centered"><strong><?php echo " Percentage = ".($asmtresults['ansrtot']/100*100)." % ";?></strong></td>
			
			</tr>
			</table>
			
			<br><br><br>
			<table width="400" align="center">
			<tr>
			<th>Question</th>
			<th>Answer</th>
			<th>%</th>
			</tr>
			
			<?php foreach($STMasmtr1 as $asmtr1)
			{ ?>
			<tr>
			<td width="50%"><?php echo $asmtr1['atopic'];?></td>
			<td width="25%"><?php echo $asmtr1['opt'];?></td>
			<td width="25%"><?php echo ($asmtr1['opt']/100*100)."%";?></td>
			</tr>
			<?php }  ?>
			</table>
			
			
			
				
				
				</div>
			</div>
        </div>
	  </div>
    </div>

</div>






<script src='assets/js/plugins/jquery.pnotify.js'></script>
<script src='assets/js/plugins/jquery.sparkline.min.js'></script>
<script src='assets/js/plugins/mwheelIntent.js'></script>
<script src='assets/js/plugins/mousewheel.js'></script>
<script src='assets/js/bootstrap/tab.js'></script>
<script src='assets/js/bootstrap/dropdown.js'></script>
<script src='assets/js/bootstrap/tooltip.js'></script>
<script src='assets/js/bootstrap/collapse.js'></script>
<script src='assets/js/bootstrap/scrollspy.js'></script>
<script src='assets/js/plugins/bootstrap-datepicker.js'></script>
<script src='assets/js/bootstrap/transition.js'></script>
<script src='assets/js/plugins/jquery.knob.js'></script>
<script src='assets/js/plugins/jquery.flot.min.js'></script>
<script src='assets/js/plugins/fullcalendar.js'></script>
<script src='assets/js/plugins/datatables/datatables.min.js'></script>
<script src='assets/js/plugins/chosen.jquery.min.js'></script>
<script src='assets/js/plugins/jquery.timepicker.min.js'></script>
<script src='assets/js/plugins/daterangepicker.js'></script>
<script src='assets/js/plugins/colpick.js'></script>
<script src='assets/js/plugins/moment.min.js'></script>
<script src='assets/js/plugins/datatables/bootstrap.datatables.js'></script>
<script src='assets/js/bootstrap/modal.js'></script>
<script src='assets/js/plugins/raphael-min.js'></script>
<script src='assets/js/plugins/morris-0.4.3.min.js'></script>
<script src='assets/js/plugins/justgage.1.0.1.min.js'></script>
<script src='assets/js/plugins/jquery.maskedinput.min.js'></script>
<script src='assets/js/plugins/jquery.maskmoney.js'></script>
<script src='assets/js/plugins/summernote.js'></script>
<script src='assets/js/plugins/dropzone-amd-module.js'></script>
<script src='assets/js/plugins/jquery.validate.min.js'></script>
<script src='assets/js/plugins/jquery.bootstrap.wizard.min.js'></script>
<script src='assets/js/plugins/jscrollpane.min.js'></script>
<script src='assets/js/application.js'></script>

<script src='assets/js/template_js/forms.js'></script>

<script src='assets/js/template_js/table.js'></script>

<script src='assets/js/template_js/dashboard.js'></script>

<script src='assets/js/template_js/calendar.js'></script>




<!-- @include _footer