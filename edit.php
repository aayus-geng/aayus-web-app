<?php
//session_start();

include('init.php');
include('configPDO.php');

("SET NAMES 'UTF8'");

$user=($_SESSION['username']);


$STM = $dbh->prepare("SELECT * FROM tbl_users WHERE username = '$user'");

    $STM->execute();

    $STMrecordsu = $STM->fetchAll();
    foreach($STMrecordsu as $u1)

$uimg = $u1['img'];	
$userida = $u1['id'];
$ugrp = $u1['ugroup'];

$STMD= $dbh->prepare("SELECT * FROM tbl_company");
    $STMD->execute();
    $row_company = $STMD->fetch();
	$totalRows_company = $row_company;
	
	
$coname = $row_company['url_name'];
$coimg = $row_company['logo'];
$imgwidth=$row_company['imgwidth'];
$imgheight=$row_company['imgheight'];

$cust=$_GET['uid'];

$STMD= $dbh->prepare("SELECT * FROM tbl_customer WHERE cardid='$cust'");
    $STMD->execute();
    $row_customer = $STMD->fetch();
	$totalRows_customer = $row_customer;
	
	$custid=$row_customer['cust_ID'];

		
	$STMdash = $dbh->prepare("SELECT * FROM tbl_dashboard WHERE userid='$userida'");
    $STMdash->execute();
    $row_dash = $STMdash->fetch();
	$totalRows_dash = $row_dash;
		
	
	$STMtimediff = $dbh->prepare("SELECT * FROM sys_variables WHERE varname_en='timediff'");
    $STMtimediff->execute();
    $row_timediff = $STMtimediff->fetch();
	$totalRows_timediff = $row_timediff;
	
	$tdiff = $row_timediff['varoption'];
	
	
$hourdiff = $tdiff; 

$today1 = date("Y-m-d",time() + ($hourdiff * 3600));


?>

<!DOCTYPE html>
<html>

<head>

   <meta https-equiv="Content-Language" content="th" />
  <meta https-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta https-equiv="X-UA-Compatible" content="IE=edge">

  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="//js.pusher.com/3.0/pusher.min.js"></script>
     
<link rel="apple-touch-icon" sizes="180x180" href="img/snaplogo.png">
<link rel="icon" type="image/png" href="img/snaplogo.png">
<link rel="icon" type="image/png" href="img/snaplogo.png">
<link rel="shortcut icon" href="img/snaplogo.png" type="image/png">


<style>
.datepicker {
z-index: 99999 !important;
}

.btntopup {
	background-color: #e0e0e0;
	border-radius: 0px;
	width: 80 px;
	color: black;
    padding: 0px 0px;
	text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 22px;	
} 

.btntopup:hover {
    background-color: #999999;
    color: white;
}

.btncir {
	background-color: transparent;
	border-radius: 0px;
	width: 10px;
	color: #777777;
	padding: -10px -10px;
    text-align: center;
    text-decoration: none;
    
    font-size: 45px;	
} 



p.small {
    line-height: 60%;
}

</style>
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

  <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,700|Roboto+Condensed:300,400,700' rel='stylesheet' type='text/css'>
  
 <link href=' https://fonts.googleapis.com/css?family=Roboto:100,300,400,700|Roboto+Condensed:300,400,700' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    @javascript html5shiv respond.min
  <![endif]-->

  <title>SNAP TM</title>
  
   <script type="text/javascript">
		function MM_openBrWindow(theURL,winName,features) {
		window.open(theURL,winName,features);
		}
		 </script>

		 <script type="text/javascript">
		jQuery.noConflict();
		jQuery( document ).ready(function() {
		$('.all-wrapper').toggleClass('hide-side-menu');
		});
        </script>
        
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

<div class="col-md-4">
    <div class="widget widget-orange">
         
     </div>
  </div>
<br>


<div class="row">


  <div class="widget widget-orange">
      

      <div class="widget-content">
		
            <div class="col-md-6" align="left">
				<br>
				<form action="db_register.php" method="post" name="reg1" role="form"class="style1" id="reg">
          
				<div class="form-group">
						first name
					<input class="form-control" type="text" id="fname" name="fname" value="<?php echo $row_customer['fname'];?>">
				
				</div>
				
				<div class="form-group">
					last name
					<input class="form-control" type="text" id="lname" name="lname" value="<?php echo $row_customer['lname'];?>">
								
                </div>
				
				<div class="form-group">
                     The 1Card
					<input class="form-control" type="number" id="onecrd" name="onecrd" value="<?php echo $row_customer['cardnoone'];?>" size="55" placeholder=" The 1 Card ">
					
								
                </div>
				
				<div class="form-group">
						Identification
					<input class="form-control" type="number" id="ident" name="ident" value="<?php echo $row_customer['identification'];?>">
								
                </div>
				
								
				<div class="form-group">
						age
					<input class="form-control" type="number" id="age" name="age" value="<?php echo $row_customer['age'];?>">
								
                </div>
				
				<div class="form-group">
						mobile
					<input class="form-control" type="number" id="mobile" name="mobile" value="<?php echo $row_customer['mobile'];?>">
					
					
								
                </div>
				
				<div class="form-group">
						 Location
					<input class="form-control" type="text" id="loc" name="loc" value="<?php echo $row_customer['loc'];?>">
								
                </div>
				
							
				<div class="form-group">
					<select class="form-control" name="lifestyle" id="lifestyle">
            	  <option value="0">Lifestyle</option>
						<?php

							$STM = $dbh->prepare("SELECT * FROM  ltl_lifestyle");
							$STM->execute();
							$STMrecords1 = $STM->fetchAll();
								foreach($STMrecords1 as $row1)
						{ ?>
							<option value="<?php echo $row1['life_en']." ".$row1['life_th'];?>"><?php echo $row1['life_en']." ".$row1['life_th'];?> </option>
							
						<?php  } ?>  
                  </select> 
				</div>
				
								
				<div class="form-group">
					 
					<label class = "radio-inline">
					<input type="radio" name = "gender" id = "radio1" value="male" <?php if ($row_customer['sex'] == 'male') echo 'checked="checked"'; ?> > male </label>
   				
					<label class = "radio-inline">
					<input type="radio" name = "gender" id = "radio2" value="female" <?php if ($row_customer['sex'] == 'female') echo 'checked="checked"'; ?> > female </label>
					
					
				</div>
		
				
				<div class="form-group">
				<input type="hidden" id="custid" name="custid" value="<?php echo $custid;?>">
				<input type="submit" name="update" id="update" class="btn btntopup" value="Update">
				<a href="dashboard.php?uid=<?php echo $cust;?>" class="btn btntopup">Cancel</a>
				</div>
			</form>	
				
              </div>
		  	  
        </div>
	  </div>
    </div>
 </div>


  <div class="page-footer">
 © 2014 BENT Software Labs
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


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
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

<script src='assets/js/template_js/dashboardcal.js'></script> -->

<!-- @include _footer