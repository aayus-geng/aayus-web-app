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
	if($pos === false) {
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

.img-circle {
    border-radius: 50%;
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


<link href="assets/modal/css/bootstrap-modal.css" rel="stylesheet" />


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

<link rel='stylesheet' href='assets/css/timepicki.css'>
  
  <div id="header">
		
		<div class="page-full-width cf">

  <title>Aayus Triggers</title>
    
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
		
            <div class="col-xs-12 col-md-6 text-center block-center txtcolor1">

			  <div style="text-align: center;">
			  
			  <?php 
			  
				$triggerid = $_GET['tgrid'];
				
				$STMtgrs = $dbh->prepare("SELECT * FROM tbl_trigger WHERE trggr_id='$triggerid'");

				$STMtgrs->execute();
				$STMtrgs1 = $STMtgrs->fetchAll();
				foreach($STMtrgs1 as $tgrs)
			  
			  ?>
			  
			  
			  <h2><?php echo $tgrs['tgr_name']; ?></h2>
			  <h4><?php echo $tgrs['tgr_text']; ?></h4>
			  <img src="<?php echo $tgrs['tgr_img']; ?>" width="80%" height="auto"/>
			  </div>
			  <form action="db_triggertime.php" method="post" name="formaddgpic" class="style1" id="formaddgpic">
				
				<div class="form-group">
				
                    
					<p>Enter Trigger Time</p>
					<input id="timepicker1" name="trgrtime" type="text" placeholder="Enter Trigger Time"/>
				
				</div>
				
				
					
					<p>Select Trigger Type</p>
					<input id="trgrtype" name="trg" type="text" placeholder="Select Trigger Type"/> <!--  daily, weekly, specific date -->
				
				
				<div class="form-group">
					<p>Enter Trigger Date (optional)</p>
					<input id="trgrdate" name="trgrdate" type="date" placeholder="Trigger Date"/>
					
				</div>
				<div class="col-md-2"></div><br><br><br>			
				<div class="form-group">
				
				<input type="hidden" name="tgrid" id="tgrid" value="<?php echo $triggerid;?>"/>
				<input type="submit" name="tgr" id="tgr" class="btntopup btn-round" value="Add">
				<button type="reset" class="btntopup btn-round" data-dismiss="modal">Cancel</button>
				</div>
			</form>
			  
			  <button type="button" onclick="location.href='triggersa.php';" class="btntopup btn-round" style="display: block; width: 50%;"><i class="fa fa-flag-o"></i><br>Add New Trigger<br></button>
			  
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

<script src="assets/js/timepicki.js"></script>
    
	<script>
	$('#timepicker1').timepicki();
    </script>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "40%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>