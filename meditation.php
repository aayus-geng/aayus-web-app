<?php
//session_start();

include('init.php');
include('configPDO.php');
include('dt.php');

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
     
<link href="assets/css/bootstrap-slider.css" rel="stylesheet">
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
  
  <div id="header">
		
		<div class="page-full-width cf">

  <title>Aayus Meditation Log</title>
  
  
        
</head>

<body>

<?php include('nav_side.php');?>


<?php  if ($detect->isMobile()) { ?>

<div class="main-content" style="padding-top: 0px">

<?php } else {?>

<div class="main-content" style="padding-top: 90px">
	<div class="col-md-2">

  </div>
<?php } ?>

            <div class="col-md-6 txtcolor1 text-center block-center">
				<br>
				
          
				<br>
				<strong><big>Add New Meditation Entry</big></strong>
				<br><br>
				<a href="#" data-toggle="modal" data-target="#mmeditat" data-placement="right" title="" data-original-title="" class="btntopup btn-round">Add</a>
				
				

             <br><br>
			 <strong>Meditation Log</strong>
			 
			 				<?php

					$STMm1 = $dbh->prepare("SELECT * FROM tbl_meditate WHERE usrid='$userida' LIMIT 1");

					$STMm1->execute();

					$STMmedi1 = $STMm1->fetchAll();
					foreach($STMmedi1 as $medi1)
					if (isset($medi1))
					{	
						
					?>
			 
			 
				<table class="table table-striped table-hover datatable bordered">
								
					
					<tr>
					<td align="left" width="15%"><strong>Date</strong></td>
					<td align="left" width="55%"><strong>Meditation (click to edit)</strong></td>
					<td align="left" width="15%"><strong>Vibe</strong></td>
					
					</tr>
					
					<?php

					$STMm = $dbh->prepare("SELECT * FROM tbl_meditate WHERE usrid='$userida' ORDER BY med_id DESC LIMIT 10");

					$STMm->execute();

					$STMmed = $STMm->fetchAll();
					foreach($STMmed as $med)
					{ 
					?>
					<tr>
				
					
					<td align="left"><?php $mdate1=strtotime($med['meddate']); echo date("M d", $mdate1);?></td>
					
					<td align="left">
					
					<a href="#meditat" data-toggle="modal" data-target="#meditat" data-placement="right" data-med1="<?php echo $med['med_id'];?>" class="meditat" title="meditat" data-original-title=""><?php echo $med['med_name'];?></a>
					
									
					</td>
					<td align="left"><?php echo $med['vibe'];?></td>
					
					</tr>
					<?php } ?>
					
					
				</table>
					<?php } ?>
					
					<?php

					$STMjc1 = $dbh->prepare("SELECT COUNT(med_id) as mcnt, usrid FROM tbl_meditate WHERE usrid='$userida'");
					$STMjc1->execute();
					$STMjournc1 = $STMjc1->fetchAll();
					foreach($STMjournc1 as $journc1)
					$journcnt=$journc1['jcnt'];
					if($journcnt >= 10)
					{
					?>
					
					<div style="text-align: center;">
					<p><a href="viewallm.php">-- view more --</a></p>
					</div>
					<?php } ?>
					</div>
			 
			 			<div class="col-md-4" align="center">
				<br>
				
          
				<br>
				<strong><big>Meditations</big></strong>
				<br><br>
				<p>Self Meditation</p>
				<br><br>
				<p>Guided Meditation</p>
				<br><br>
				
			 </div>

        </div>
	  </div>
    </div>

</div>


<div id="meditat" class="modal fade" style="font-weight: normal;" data-focus-on="input:first">
  <div class="modal-dialog" style="width:50%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>




<script>
    $('.meditat').click(function(){
        var med1 = $(this).attr('data-med1');
        $.ajax({url:"meditat.php?med1="+med1,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>








<div class="modal fade" id="mmeditat" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Meditation - <?php echo $_SESSION['dtnow'];?></h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="db_meditate.php" class="form" method="post" name="reg1" role="form"  id="reg">
          
				<div class="form-group">
                    
					<input type="text" class="form-control" id="med_name" name="med_name" ></textarea>
				
				</div>
				
					<br><br>		
				
				Rate your vibration
				<div class="form-group">
				
				<input id="mvibe1" name="mvibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="<?php echo $vibe;?>"/>
				
				</div>
				<br><br>
				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="meddate" name="meddate" value="<?php echo$_SESSION['dnow'];?>"/>
								
				</div>
				
				<div class="form-group">
				
				
				<input type="hidden" name="usrid" id="usrid" value="<?php echo $userida;?>"/>
				<input type="submit" name="add" id="add" class="btn btn-info" value="Add">
				<button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</form>	
		
            </div>
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

<script src="assets/js/bootstrap-slider.js"></script>

<script>
$('#mvibe1').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
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

