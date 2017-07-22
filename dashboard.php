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

if ( $detect->isMobile() ) {
$ecamlink='imgcamemppic.html';
//header("location:udash.php"); 
} elseif( $detect->isTablet() ){
$ecamlink='imgcamemppic.html';
//header("location:udash.php");   
} else {
$ecamlink='cam.php';
}

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


$STMD= $dbh->prepare("SELECT * FROM tbl_company");
    $STMD->execute();
    $row_company = $STMD->fetch();
	$totalRows_company = $row_company;
	
	
$coname = $row_company['url_name'];
$coimg = $row_company['logo'];
$imgwidth=$row_company['imgwidth'];
$imgheight=$row_company['imgheight'];

$today1 = date("Y-m-d H:i:s");
$today2 = date("Y-m-d");
$time1 = date("H:i:s");
$vdate = date("Y-m-d");
$vtime = date("H:i:s");

$STM = $dbh->prepare("Update tbl_users SET lastaccess='$today1' WHERE id='$userida'");

	$STM->execute();
	
	$STMvibcnt = $dbh->prepare("SELECT COUNT(usrid) as vibrcnt, usrid FROM tbl_vibes WHERE usrid='$userida'");

	$STMvibcnt->execute();

	$STMvibcnt1 = $STMvibcnt->fetchAll();
	foreach($STMvibcnt1 as $vibcnt1)
	
	$totvibes=$vibcnt1['vibrcnt'];
	
	

	$STMalrtcnt = $dbh->prepare("SELECT COUNT(alert_text) as alrtcnt, usrid FROM tbl_alerts WHERE usrid='$userida'");

	$STMalrtcnt->execute();

	$STMalrtcnt1 = $STMalrtcnt->fetchAll();
	foreach($STMalrtcnt1 as $alrtcnt1)
	
	$totalrt=$alrtcnt1['alrtcnt'];
	
	
	$STMgcnt = $dbh->prepare("SELECT COUNT(goal_id) as gcnt, usrid FROM tbl_goal WHERE usrid='$userida'");

	$STMgcnt->execute();

	$STMgcnt1 = $STMgcnt->fetchAll();
	foreach($STMgcnt1 as $gcnt1)
	
	$totgoal=$gcnt1['gcnt'];
	
	
	$STManncnt = $dbh->prepare("SELECT COUNT(announcement) as anncnt, status, exp_date FROM tbl_announcements WHERE status='active' AND exp_date>='$today1'");

	$STManncnt->execute();

	$STManncnt1 = $STManncnt->fetchAll();
	foreach($STManncnt1 as $anncnt1)

	$totann=$anncnt1['anncnt'];


	
	$STMtgrcnt = $dbh->prepare("SELECT COUNT(trggr_id) as tgrcnt, usrid FROM tbl_trigger WHERE usrid='$userida'");

	$STMtgrcnt->execute();

	$STMtgrcnt1 = $STMtgrcnt->fetchAll();
	foreach(STMtgrcnt1 as $tgrcnt1)

	$tottgr1=$tgrcnt1['tgrcnt'];

?>

<!DOCTYPE html>
<html>

<head>

  <meta https-equiv="Content-Language" content="en" />
  <meta https-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
  <meta https-equiv="X-UA-Compatible" content="IE=edge">
	

<script src="https://code.jquery.com/jquery-latest.js"></script> 
<link href="assets/css/bootstrap-slider.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  

<link href="assets/modal/css/bootstrap-modal.css" rel="stylesheet" />
<link rel='stylesheet' href='assets/css/bootstrap.css'> 

<link rel='stylesheet' href='assets/css/<?php echo $bckgrnd;?>'>
<!-- <link rel='stylesheet' href='css/slideside.css'>-->
<!--
pea A4D555
leaf 66AB8C

-->


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

#rcorners3 {
    border-radius: 25px;
    background: url(images/app/greatness.png);
    background-position: center middle;
    background-repeat: no-repeat;
    padding: 20px; 
    width: 200px;
    height: 150px; 
}

#bgimage { 
    background-image: url('bg1.jpg'); 
}
    @media only screen and (max-width: 320px) {
    #bgimage { 
    background-image: url('bg1.jpg'); 
    }
}

</style>

<link rel="apple-touch-icon" sizes="180x180" href="assets/images/mindfullogo2.png">
<link rel="icon" type="image/png" href="assets/images/mindfullogo2.png">
<link rel="icon" type="image/png" href="assets/images/mindfullogo2.png">
<link rel="shortcut icon" href="assets/images/mindfullogo2.png" type="image/png">
 


	

	
  <title>Aayus</title>
  

</head>

<body>
<div id="header">
		
<div class="page-full-width cf">

<?php include('nav_side.php');?>


<?php  if ($detect->isMobile()) { ?>
<div class="bgimage"></div>
<div class="main-content" style="padding-top: 0px;">

<?php } else {?>
<div class="bgimage"></div>
<div class="main-content" style="padding-top: 90px;">

	<div class="col-md-2">
    
  </div>
<?php } ?>


      <?php if(isset($user)){ ?>

      <div class="txtcolor1">
			
            <div class="col-xs-12 col-md-6 col-lg-6" align="center">
						

				<br><br>
				
				
				<?php  if ($detect->isMobile()) { $butwidth = '120%'; } else { $butwidth = '70%';}?>
				
				<div class="col-xs-6 col-md-6" align="center">
				
				
				<button type="button" onclick="location.href='goals.php';" class="btntopup btn-round" style="display: block; width: <?php echo $butwidth;?>; font-size: calc(100% + .5vw)"><i class="fa fa-tasks"></i><br><?php echo $totgoal;?><br>Goals</button>
				
				
				</div>
				<div class="col-xs-6 col-md-6" align="center">
				
				
				<button type="button" onclick="location.href='vibes.php';" class="btntopup btn-round" style="display: block; width: <?php echo $butwidth;?>; font-size: calc(100% + .5vw)"><i class="fa fa-check"></i><br><?php echo $totvibes;?><br>Vibes</button>
				
				</div>
				<div style="padding-top: 70px;"></div>
				<br><br><br>
				
				
				<div class="col-xs-6 col-md-6" align="center">
				
				
				<button type="button" onclick="location.href='triggersa.php';" class="btntopup btn-round" style="display: block; width: <?php echo $butwidth;?>; font-size: calc(100% + .5vw)"><i class="fa fa-flag-o"></i><br><?php echo $tottgr1;?><br>Triggers</button>
				
				</div>
				<div class="col-xs-6 col-md-6" align="center">
				
				
				<button type="button" onclick="location.href='#';" class="btntopup btn-round" style="display: block; width: <?php echo $butwidth;?>; font-size: calc(100% + .5vw)"><i class="fa fa-bolt"></i><br><br>Alerts</button>
				
				</div>
				
				<?php  if ($detect->isMobile()) { ?>
				
				<div style="padding-top: 70px;"></div>
				<br><br><br>
				<div class="col-xs-12 block-center" >
				
				
				<button type="button" onclick="location.href='#vibecheck';" class="btntopup btn-round" style="display: block; width: 110%; font-size: calc(100% + .5vw)">Vibe <br> Check</button>
				
				</div>
				<?php } ?>
				
				
				

        <!-- </div> -->
		<?php  if ($detect->isMobile()) {} else { ?>
		<br><br><br>	<br>
		<div class="row"></div>
		<div class="rcorners3">
		<img src="images/app/greatness.png" width="<?php echo $butwidth;?>" height="auto" style="box-shadow: 0px 0px 40px #6C648B;"></a>
		</div>
		<?php } ?>
	  </div>

            


				<div class="col-xs-12 col-md-4 text-center block-center" id="vibecheck">
				
				<?php  if ( $detect->isMobile() ) {?>
				
				<br><br><br><br><br><br>
				
				<?php } ?>
				
			
                <span class="vibetext"><strong><big>Quick Vibe Check</big>  <br> (1 = low | 10 = high)</strong>
				
				<br> <br>
				
				<form action="db_addvibe.php" method="post" name="vibe" role="form" id="uid">
				
				<div class="form-group">
				<h6><strong>General Vibe</strong></h6><br>
				
				<input id="vibe1" name="ovibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="5"/>
				</div>				
				
				
				<br>
				<div class="form-group">
				<h6><strong>Financial Vibe</strong></h6><br>
				
				<input id="vibe2" name="fvibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="5"/>
				</div>								
				
				
				<br>
				<div class="form-group">
				<h6><strong>Relationships Vibe</strong></h6><br>
				
				<input id="vibe3" name="rvibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="5"/>
				</div>								
				
				
				<br>
				<div class="form-group">
				<h6><strong>Health and Wellness Vibe</strong></h6><br>
				
				<input id="vibe4" name="hvibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="5"/>
				</div>							
				
				<br><br>
				<div class="form-group">
				<input type="hidden" name="vdate" id="vdate" value="<?php echo $vdate;?>"/>
				<input type="hidden" name="vtime" id="vtime" value="<?php echo $vtime;?>"/>
				<input type="hidden" name="usrid" id="usrid" value="<?php echo $userida;?>"/>
				<input type="submit" name="addvibe" id="addvibe" class="btnvchk btn-round" value="Save">
				<input type="reset" name="reset" id="reset" class="btnvchk btn-round" value="Reset">
				
				</div>
				
				</form>	
				</span>
				

            <div class="clearfix">
            </div>
        </div>
		</div>
		
		<?php } ?>
		
	</div>
</div>
</div>
</div>


<!-- modals -->

<div id="alrt" class="modal fade" style="font-weight: normal;" data-focus-on="input:first">
  <div class="modal-dialog" style="width:50%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>

<script>
    $('.alrt').click(function(){
        var uid = $(this).attr('data-uid');
        $.ajax({url:"alerts1.php?uid="+uid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>


<div id="annc" class="modal fade" style="font-weight: normal;" data-focus-on="input:first">
  <div class="modal-dialog" style="width:50%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>

<script>
    $('.annc').click(function(){
        var uid = $(this).attr('data-uid');
        $.ajax({url:"announc1.php?uid="+uid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>




<div class="modal fade" id="alert1" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-blue">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>ALERT - Customer Time</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
			<form method="post" action="upayhist.php" >  
		<div class="table-responsive">
        <table class="table table-bordered table-hover datatable">
          <thead>
            <tr>
			 <th>ID</th>
             <th>RFID</th>
             <th>Name</th>
             
			 <th>Actions</th>
             
            </tr>
          </thead>
          <tbody>
           
		   <?php
			
			
			$STMalert= $dbh->prepare("SELECT tbl_trans.custid, tbl_trans.tran_id, tbl_customer.cust_ID, tbl_customer.fname, tbl_customer.lname, tbl_customer.cardid FROM tbl_trans, tbl_customer WHERE tbl_trans.custid=tbl_customer.cust_ID AND tbl_trans.alert='alert1'");
			$STMalert->execute();
			
			$STMalert1 = $STMalert->fetchAll();
    
			foreach($STMalert1 as $alert)
			
        { 
					
		?>
		

			<tr>
			 
              <td><?php echo $alert['custid'];?></td>
			  <td><?php echo $alert['cardid'];?></td>
              <td><?php echo $alert['fname']." ".$alert['lname'];?></td>
			 
			  <td>
			  <a href="dashboard.php?uid=<?php echo $alert['cardid'];?>&trnid=<?php echo $alert['tran_id'];?>" class="btn btntopup2">Open</a>
			  
			
			  </td>
              
              
            </tr> 
        <?php } ?>
          </tbody>
        </table>
        
		
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script src="assets/js/bootstrap-slider.js"></script>
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

<!-- <script src='assets/js/template_js/dashboard.js'></script> -->

<script src='assets/js/template_js/calendar.js'></script>

  <script src="js/mob/skdslider.min.js"></script>
  <!-- Bootstrap js -->
  <script src="js/mob/bootstrap.min.js"></script>
  <!-- For smooth animatin -->
  <script src="js/mob/wow.min.js"></script> 

  <script src="assets/modal/js/bootstrap-modal.js"></script>
  <script src="assets/modal/js/bootstrap-modalmanager.js"></script>
<script>
$('#vibe1').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});

$('#vibe2').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});

$('#vibe3').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});

$('#vibe4').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});
$('#vibe5').slider({
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