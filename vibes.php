<?php
//session_start();

include('init.php');
include('configPDO.php');

("SET NAMES 'UTF8'");

require_once 'device/Mobile_Detect.php';

$detect = new Mobile_Detect;

$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
	

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

date_default_timezone_set($tz);


$today1 = date("Y-m-d H:i");
$today2 = date("Y-m-d");
$time1 = date("H:i:s");
$today1 = date("Y-m-d");
$today2 = date("Y-m-d");

$gdate1 = date("Y-m-d");
$gtime1 = date("H:i a");

	function first_sentence($content) {
	$pos = strpos($content, '.');
	if($pos == false) {
	return $content;
	}
	else {
	return substr($content, 0, $pos+1);
	}   
	}

	function getFirstSentence($string)
{
    $string = str_replace(" .",".",$string);
    $string = str_replace(" ?","?",$string);
    $string = str_replace(" !","!",$string);
    preg_match('/^.*[^\s](\.|\?|\!)/U', $string, $match);
    return $match[0];
}


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
     

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel='stylesheet' href='assets/css/bootstrap.css'> 

<link rel='stylesheet' href='assets/css/tableresp.css'>

<link rel='stylesheet' href='assets/css/<?php echo $bckgrnd;?>'>
<link rel='stylesheet' href='assets/css/imggallery.css'>    

<link rel="apple-touch-icon" sizes="180x180" href="assets/images/mindfullogo2.png">
<link rel="icon" type="image/png" href="assets/images/mindfullogo2.png">
<link rel="icon" type="image/png" href="assets/images/mindfullogo2.png">
<link rel="shortcut icon" href="assets/images/mindfullogo2.png" type="image/png">

<style>
.datepicker {
z-index: 99999 !important;
}


p.small {
    line-height: 60%;
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


<div id="header">

  
		<div class="page-full-width cf">

  <title>Aayus Vibes</title>
    
</head>

<body>

<?php include('nav_side.php');?>


<?php  if ($detect->isMobile()) { ?>

<div class="main-content" style="padding-top: 0px;">

<?php } else {?>

<div class="main-content" style="padding-top: 90px;">
	<div class="col-md-2">

  </div>
<?php } ?>


		<div class="col-xs-12 col-md-10 text-center center-block txtcolor1" align="center">
		
		<div class="col-lg-2 text-center block-center ">
		<h5>General</h5>
		<div class="js-gauge js-gauge--5 gauge"></div>
		</div>
		
		<div class="col-lg-2 text-center block-center ">
		
		<h5>Financial</h5>
		
		
		<div class="js-gauge js-gauge--6 gauge"></div>
		
		</div>
		
		<div class="col-lg-2 text-center block-center ">
		
		<h5>Relationship</h5>
		
		<div class="js-gauge js-gauge--7 gauge"></div>
		
		</div>
		
		<div class="col-lg-2 text-center block-center ">
		
		<h5>Heath</h5>
		
		<div class="js-gauge js-gauge--8 gauge"></div>
		</div>
		
	</div> 
	
		<?php  if ($detect->isMobile()) { } else { ?>
		<div class="col-md-3" align="center"></div>
		<?php } ?>
		
		
          
		  
		  
		<br><br>
			 
			 
			 			
				
				<?php

					$STMv1 = $dbh->prepare("SELECT * FROM tbl_vibes WHERE usrid='$userida' LIMIT 1");

					$STMv1->execute();

					$STMvibe1 = $STMv1->fetchAll();
					foreach($STMvibe1 as $vibe1)
					if (isset($vibe1))
					{	
					
					?>
			<div class="row"></div>
			<div class="col-md-2"></div>
			<div class="col-xs-12 col-md-10 text-center center-block txtcolor1" >

				<br><br><h2>Vibe History</h2><br><br>
			<table class="table table-striped" style="border-radius: 5px; width: 60%; float: none">
				
										
					<tr>
					
					<th><strong>Date</strong></th>
					<th><strong>Time</strong></th>
					<th><strong>General</strong></th>
					<th><strong>Financial</strong></th>
					<th><strong>Relationship</strong></th>
					<th><strong>Health</strong></th>
					<th><strong>Overall Vibe Rate</strong></th>
					
					</tr>
					
					<?php
					
					

					$STMv = $dbh->prepare("SELECT * FROM tbl_vibes WHERE usrid='$userida' ORDER BY vdate DESC, vtime DESC");

					$STMv->execute();

					$STMvibe = $STMv->fetchAll();
					foreach($STMvibe as $vibe)
					{
					
					?>
					<tr>
				
					<td><?php $vdate1 = strtotime($vibe['vdate']); echo date("M - d", $vdate1);?></td>
					<td><?php $vtime1 = strtotime($vibe['vtime']); echo date("g:i a", $vtime1);?></td>
					<td><?php echo $vibe['Overall'];?></td>
					<td><?php echo $vibe['Financial'];?></td>
					<td><?php echo $vibe['Relationship'];?></td>
					<td><?php echo $vibe['Health'];?></td>
					<td><?php echo number_format((($vibe['Health']+$vibe['Relationship']+$vibe['Financial']+$vibe['Overall'])/4),2);?></td>
					
					</tr>
					<?php } ?>
										
				</table>
					<?php } ?>
				
		</div>
		
				
		<div class="row"></div>
		<div class="col-md-2"></div>
		<div class="col-xs-12 col-md-10 text-center center-block txtcolor1" align="center">		
		
		<br><br>
		<h3>Collective Averages By Category</h3>
		<br>
				
				
		<div class="col-lg-2">
		<div style="text-align:center">
		<h5>General</h5>
		</div>
		<div style="align: center">
		<div class="js-gauge js-gauge--1 gauge"></div>
		</div>
		</div>
		<div class="col-lg-2">
		<div style="text-align:center">
		<h5>Financial</h5>
		</div>
		<div style="align: center">
		<div class="js-gauge js-gauge--2 gauge"></div>
		</div>
		</div>
		
		<div class="col-lg-2">
		<div style="text-align:center">
		<h5>Relationship</h5>
		</div>
		<div style="align: center">
		<div class="js-gauge js-gauge--3 gauge"></div>
		</div>
		</div>
		
		<div class="col-lg-2">
		<div style="text-align:center">
		<h5>Heath</h5>
		</div>
		<div style="align: center">
		<div class="js-gauge js-gauge--4 gauge"></div>
		</div>
		</div>
				
		</div>
					<?php
					$STMvtot = $dbh->prepare("SELECT SUM(Overall) as totoverall, SUM(Financial) as totfinancial, SUM(Relationship) as totrelationship, SUM(Health) as tothealth, COUNT(Overall) as cntoverall, COUNT(Financial) as cntfinancial, COUNT(Relationship) as cntrelationship, COUNT(Health) as cnthealth, usrid FROM tbl_vibes WHERE usrid='$userida'");

					$STMvtot->execute();

					$STMvibetot = $STMvtot->fetchAll();
					foreach($STMvibetot as $vibetot)
					
					$vcnt=($vibetot['cntoverall']+$vibetot['cntfinancial']+$vibetot['cntrelationship']+$vibetot['cnthealth']);
					$vtot=($vibetot['totoverall']+$vibetot['totfinancial']+$vibetot['totrelationship']+$vibetot['tothealth']);
					$viberate=number_format(($vtot/$vcnt),2);
					
					$vibefin=number_format(($vibetot['totfinancial']/$vibetot['cntfinancial']),2);
					$viberel=number_format(($vibetot['totrelationship']/$vibetot['cntrelationship']),2);
					$vibehel=number_format(($vibetot['tothealth']/$vibetot['cnthealth']),2);
					
					//echo "Vibe Count = ".$vcnt;?> <br>
					<?php //echo "Vibe Total = ".$vtot;?> <br>
					<?php //echo "Vibe Average = ".$viberate;?>

					<?php
					
					$STMlvdate = $dbh->prepare("SELECT MAX(vdate) as lstdate, usrid FROM tbl_vibes WHERE usrid='$userida'");
					$STMlvdate->execute();
					$STMlvdate1 = $STMlvdate->fetchAll();
					foreach($STMlvdate1 as $lvdate1)
				
					$lstdate=$lvdate1['lstdate'];
					//$lsttime=$lvdate1['lsttime'];
					
					
					$STMvlst = $dbh->prepare("SELECT * FROM tbl_vibes WHERE vdate = '$lstdate' AND usrid = '$userida'");

					$STMvlst->execute();

					$STMvibelst = $STMvlst->fetchAll();
					foreach($STMvibelst as $vibelst)
					
					$lstgeneral = $vibelst['Overall'];
					$lstfinancial=$vibelst['Financial'];
					$lstrelationship=$vibelst['Relationship'];
					$lsthealth=$vibelst['Health'];
					
					?>
					
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

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>

<script type="text/javascript" src="guage/g2/js/kuma-gauge.jquery.js"></script>

<!-- value : "",-->
<script>
		$('.js-gauge--1').kumaGauge({
		value : "<?php echo $viberate;?>",
		fill : '#F34A53',
		gaugeBackground : '#1E4147',
		gaugeWidth : 10,
		showNeedle : false,
		min : 0,
        max : 8,
		width : 40,
        height : 40,
        centerX : 50,
        centerY : 50,
		radius : 75,
        paddingX : 5,
        paddingY : 5,
		label : {
        display : true,
		left : 'low',
		center : 'General',
        right : 'high',
       fontFamily : 'Helvetica',
       fontColor : '#1E4147',
       fontSize : '10',
       fontWeight : 'bold'
		        }
			});
			
		$('.js-gauge--2').kumaGauge({
		value : "<?php echo $vibefin;?>",
		fill : 'blue',
		gaugeBackground : 'grey',
		gaugeWidth : 12,
		showNeedle : false,
		min : 0,
        max : 10,
        width : 50,
        height : 50,
        centerX : 0,
        centerY : 0,
		radius : 75,
        paddingX : 10,
        paddingY : 10,
		label : {
        display : true,
		left : 'low',
        right : 'high',
       fontFamily : 'Helvetica',
       fontColor : '#1E4147',
       fontSize : '10',
       fontWeight : 'bold'
		        }
			});
			
		$('.js-gauge--3').kumaGauge({
		value : "<?php echo $viberel;?>",
		fill : 'green',
		gaugeBackground : 'red',
		gaugeWidth : 12,
		showNeedle : false,
		min : 0,
        max : 10,
		width : 50,
        height : 50,
        centerX : 0,
        centerY : 0,
		radius : 75,
        paddingX : 10,
        paddingY : 10,
		label : {
        display : true,
		left : 'low',
        right : 'high',
       fontFamily : 'Helvetica',
       fontColor : '#1E4147',
       fontSize : '10',
       fontWeight : 'bold'
		        }
			});
			
		$('.js-gauge--4').kumaGauge({
		value : "<?php echo $vibehel;?>",
		fill : 'purple',
		gaugeBackground : 'grey',
		gaugeWidth : 12,
		showNeedle : false,
		min : 0,
        max : 10,
       	width : 50,
        height : 50,
        centerX : 0,
        centerY : 0,
		radius : 75,
        paddingX : 10,
        paddingY : 10,
		label : {
        display : true,
		left : 'low',
        right : 'high',
       fontFamily : 'Helvetica',
       fontColor : '#1E4147',
       fontSize : '10',
       fontWeight : 'bold'
		        }
			});
			
		$('.js-gauge--5').kumaGauge({
		value : "<?php echo $lstgeneral;?>",
		fill : '#F34A53',
		gaugeBackground : '#1E4147',
		gaugeWidth : 12,
		showNeedle : false,
		min : 0,
        max : 10,
       	width : 50,
        height : 50,
        centerX : 0,
        centerY : 0,
		radius : 75,
        paddingX : 10,
        paddingY : 10,
		label : {
        display : true,
		left : 'low',
        right : 'high',
       fontFamily : 'Helvetica',
       fontColor : '#1E4147',
       fontSize : '10',
       fontWeight : 'bold'
		        }
			});
			
		$('.js-gauge--6').kumaGauge({
		value : "<?php echo $lstfinancial;?>",
		fill : 'blue',
		gaugeBackground : 'grey',
		gaugeWidth : 12,
		showNeedle : false,
		min : 0,
        max : 10,
       	width : 50,
        height : 50,
        centerX : 0,
        centerY : 0,
		radius : 75,
        paddingX : 10,
        paddingY : 10,
		label : {
        display : true,
		left : 'low',
        right : 'high',
       fontFamily : 'Helvetica',
       fontColor : '#1E4147',
       fontSize : '10',
       fontWeight : 'bold'
		        }
			});
			
		$('.js-gauge--7').kumaGauge({
		value : "<?php echo $lstrelationship;?>",
		fill : 'green',
		gaugeBackground : 'red',
		gaugeWidth : 12,
		showNeedle : false,
		min : 0,
        max : 10,
       	width : 50,
        height : 50,
        centerX : 0,
        centerY : 0,
		radius : 75,
        paddingX : 10,
        paddingY : 10,
		label : {
        display : true,
		left : 'low',
        right : 'high',
       fontFamily : 'Helvetica',
       fontColor : '#1E4147',
       fontSize : '10',
       fontWeight : 'bold'
		        }
			});
			
		$('.js-gauge--8').kumaGauge({
		value : "<?php echo $lsthealth;?>",
		fill : 'purple',
		gaugeBackground : 'grey',
		gaugeWidth : 12,
		showNeedle : false,
		min : 0,
        max : 10,
       	width : 50,
        height : 50,
        centerX : 0,
        centerY : 0,
		radius : 75,
        paddingX : 10,
        paddingY : 10,
		label : {
        display : true,
		left : 'low',
        right : 'high',
       fontFamily : 'Helvetica',
       fontColor : '#1E4147',
       fontSize : '10',
       fontWeight : 'bold'
		        }
			});
			
</script>


<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "40%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
</body>
</html>