<?php
//session_start();

include('init.php');
include('configPDO.php');

("SET NAMES 'UTF8'");

$user=($_SESSION['username']);

require_once 'device/Mobile_Detect.php';

$detect = new Mobile_Detect;

$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();

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

/* The side navigation menu */
.sidenav {
    height: 100%; /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 1; /* Stay on top */
    top: 0;
    left: 0;
    background-color: #5406A0; /* purple*/
    overflow-x: hidden; /* Disable horizontal scroll */
    padding-top: 40px; /* Place content 60px from the top */
    transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
    padding: 4px 4px 4px 18px;
    text-decoration: none;
    font-size: 14px;
    color: #818181;
    display: block;
    transition: 0.3s
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
    transition: margin-left .5s;
    padding: 10px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 10px;}
    .sidenav a {font-size: 6px;}
}
</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<!--  <link href="assets/modal/css/bootstrap-modal.css" rel="stylesheet" />-->


<link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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


  
  <script src="js/lib/jquery.min.js" type="text/javascript"></script>
	<script src="js/lib/jquery.validate.min.js" type="text/javascript"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
  
  <div id="header">
		
		<div class="page-full-width cf">

  <title>Aayus Assessment</title>
  
  
        
</head>

<body>


<?php include('nav_side.php');?>


<?php  if ($detect->isMobile()) { ?>

<div class="main-content" style="padding-top: 0px">

<?php } else { ?>

	<div class="main-content" style="padding-top: 110px">
	<div class="col-md-2">

  </div>
<?php } ?>

					
				<div class="txtcolor1 col-xs-12 col-md-5 text-center">
						
				
				<button type="button" onclick="location.href='assessment1.php';" class="btntopup btn-round" style="width: <?php echo $butwidth;?>; font-size: calc(100% + .5vw)"><i class="fa fa-stethoscope"></i><br>Take Assessment</button>
				<br><br>
				
				
				
				<?php 
				
				$STMadate = $dbh->prepare("SELECT MAX(adate) as lstdate, usrid FROM poll_answer WHERE usrid='$userida'");
				$STMadate->execute();
				$STMadate1 = $STMadate->fetchAll();
				foreach($STMadate1 as $adate1)
				
				$lstdate=$adate1['lstdate'];

				$STMa3 = $dbh->prepare("SELECT MAX(assmnt_num) as assmnt_maxnum, assmnt_num, usrid FROM poll_answer WHERE usrid='$userida' AND adate='$lstdate'");
				$STMa3->execute();
				$STMassmnt3 = $STMa3->fetchAll();
				foreach($STMassmnt3 as $assmnt3)

				$assmnt_number3=$assmnt3['assmnt_maxnum'];

				
				$STMasmtres = $dbh->prepare("SELECT COUNT(opt) as ansyes, COUNT(ans_id) as totans, qst_id, usrid FROM poll_answer WHERE poll_answer.usrid='$userida' AND adate='$lstdate' AND assmnt_num='$assmnt_number3'");
				$STMasmtres->execute();
				$STMasmtresults = $STMasmtres->fetchAll();
				foreach($STMasmtresults as $asmtresults)
			
				$STMasmtres1 = $dbh->prepare("SELECT COUNT(opt) as ansyes1, COUNT(ans_id) as totans1, qst_id, usrid FROM poll_answer WHERE poll_answer.usrid='$userida' AND opt='yes' AND adate='$lstdate' AND assmnt_num='$assmnt_number3'");
				$STMasmtres1->execute();
				$STMasmtresults1 = $STMasmtres1->fetchAll();
				foreach($STMasmtresults1 as $asmtresults1)
			
				$asmt1=($asmtresults1['ansyes1']/$asmtresults['totans']*100);

			
			if(isset($asmt1)){
				?>
				
				<br><br>
			<span style="text-align: center"><h2>Assessment Result = <?php echo number_format(($asmt1),2)."%";?></h2>	
				
				
			<h4>Last Assessment = <?php echo $lstdate;?></h4>
			
			
			
			<br>
			
			<!--
			<table width="80%" align="center">
			<tr>
			<td style="text-align: center;"><strong><?php //echo "Answered Yes = ".$asmtresults1['ansyes1'];?><?php //echo " out of ". $asmtresults['totans'];?></strong></td>
			<td style="text-align: center;"><strong><?php //echo " Percentage = ".number_format(($asmtresults1['ansyes1']/$asmtresults['totans']*100),2)." % ";?></strong></td>
			
			</tr>
			</table>
			-->
			<?php } ?>
			
			
			<h3>Areas that require attention</h3>
			<br>
			
			
			<?php
			 $STMasmt1 = $dbh->prepare("SELECT assess_id, qst_id, usrid, atopic, atext, opt FROM poll_answer left join lut_assessment1 ON lut_assessment1.assess_id = poll_answer.qst_id WHERE poll_answer.usrid='$userida' AND adate='$lstdate' AND assmnt_num='$assmnt_number3' AND opt='no' OR poll_answer.usrid='$userida' AND adate='$lstdate' AND assmnt_num='$assmnt_number3' AND opt='neutral' ORDER BY opt DESC");
			$STMasmt1->execute();
			$STMasmtr1 = $STMasmt1->fetchAll();
			
			?>
			 
			
			
			<table width="100%" align="left" border="1">
			<tr>
			<td style="align: left">Topic</td>
			<td style="align: center">Question</td>
			<td style="align: center">Answer</td>
			</tr>
			
			<?php foreach($STMasmtr1 as $asmtr1)
			{ 
			?>
			<tr>
			
			<td align="left" style="padding:6px;"><?php echo $asmtr1['atopic'];?></td>
			<td align="left" style="padding:6px;"><?php echo $asmtr1['atext'];?></td>
			<td align="center" style="color:red; padding:6px;"><?php echo $asmtr1['opt'];?></td>
			
			
			</tr>
			<?php } ?>
			</table>
			</span>
				
	</div>  <!-- col-md -->
				
				<div class="col-xs-12 col-md-5" style="text-align:center">
				<br><br>
				
								
				<h2>Assessment History</h2>
				
				
					<?php

					$STMa1 = $dbh->prepare("SELECT * FROM poll_answer WHERE usrid='$userida' GROUP BY usrid LIMIT 1");

					$STMa1->execute();

					$STMassmnt1 = $STMa1->fetchAll();
					foreach($STMassmnt1 as $assmnt1)
					if (isset($assmnt1))
					{	
						
					?>
			 
			 
				<table class="table table-bordered" style="width: 60%" align="center">
								
					
					<tr>
					<td align="left" width="30%"><strong>Date</strong></td>
					<td align="center" width="70%"><strong>Answers (click to view)</strong></td>
					
					
					</tr>
					
					<?php

					$STMaa = $dbh->prepare("SELECT COUNT(ans_id) as totansa, qst_id, usrid, adate FROM poll_answer WHERE usrid='$userida'");
										
					$STMaa->execute();

					$STMassmnta = $STMaa->fetchAll();
					
					$STMa = $dbh->prepare("SELECT COUNT(opt) as ansyesa, COUNT(ans_id) as totansa, qst_id, usrid, adate, assmnt_num FROM poll_answer WHERE usrid='$userida' AND opt='yes' GROUP BY adate, assmnt_num ORDER BY adate DESC");
										
					$STMa->execute();

					$STMassmnt = $STMa->fetchAll();
					
					
					
					foreach($STMassmnt as $assmnt)
					{ 
					?>
					<tr>
				
					
					<td align="left" style="background-color: white;"><?php $adate1=strtotime($assmnt['adate']); echo date("M d", $adate1);?></td>
					
					<td align="center" style="background-color: white;">
					
					<a href="asmtdetail.php?adt=<?php echo $assmnt['adate'];?>&an=<?php echo $assmnt['assmnt_num'];?>"><strong><?php echo "Yes = ".$assmnt['ansyesa']." - test".$assmnt['assmnt_num'];?></strong></a>
					
					
					
					
					</td>
										
					</tr>
					<?php } ?>
					
					
				</table>
					<?php } ?>

				
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

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "40%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>


<!-- @include _footer