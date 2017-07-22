<?php
//session_start();

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
<!--<link rel='stylesheet' href='assets/css/imggallery.css'>-->
  
  <div id="header">
		
		<div class="page-full-width cf">

  <title>Aayus Buster</title>
    
</head>

<body>


<?php require("top_bar.php"); ?>


  <div class="side">
  <div class="sidebar-wrapper">
  <?php 

  
  if ($ugrp=="admin"){ include_once("menuadm.php");}   if ($ugrp=="goal") { include_once("menugoal.php");  }
  
  ?>
	</div>
<div class="main-content">

<div class="col-md-2">
    <div class="widget widget-orange">
         
     </div>
  </div>
<br>


<div class="row">


  <div class="widget widget-orange">
      

      <div class="widget-content">
		
            <div class="col-md-7" align="center">

			  <div style="text-align: center;">
			  <h2>X-Buster</h2><br>
			  <h4>Enter values for either Text or Image</h4>
			  </div>
			  <form enctype="multipart/form-data" action="db_buster.php" method="post" name="formaddgpic" class="style1" id="formaddgpic">
				
				<div class="form-group">
				
                    
					<input type="text" class="form-control" id="bstrname" name="bstrname" value="" placeholder="Buster Name"/>
					
				
				</div>

				 <div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="comment" name="comment" placeholder="The issue or cause of stress or negative vibe you want to bust"></textarea>
				
				</div>
				
				<br>
				<div class="form-group">
                   
					<input type="file" class="form-control" name="upload1" id="upload1" value=""/>
					
				</div>
				<br>
				
				<div class="col-md-2"></div><br><br><br>			
				<div class="form-group">
				
				<input type="hidden" name="usrid" id="usrid" value="<?php echo $userida;?>"/>
				<input type="submit" name="bstr" id="bstr" class="btn btn-info" value="Add">
				<button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		 </div>
			 
			 			<div class="col-md-3" align="center">
				
					<?php
					$STMbstr1 = $dbh->prepare("SELECT bstr_id FROM tbl_buster WHERE usrid='$userida' LIMIT 1");

					$STMbstr1->execute();

					$STMbster1 = $STMbstr1->fetchAll();
					foreach($STMbster1 as $bster1)
					
					{
					?>
					

				<h4>Busted</h4><br>
					
					
				
				<table class="table" border="1">
										
					<tr>
					<td align="left" width="50%"><strong>Name</strong></td>
					<td align="left" width="20%"><strong>Bust-IT</strong></td>
					
									
					</tr>
					
					<?php
					
					

					$STMbstr = $dbh->prepare("SELECT * FROM tbl_buster WHERE usrid='$userida'");

					$STMbstr->execute();

					$STMbstr1 = $STMbstr->fetchAll();
					foreach($STMbstr1 as $bstr)
					{
					?>
					<tr>
				
					<td><?php echo $bstr['bstr_name'];?></td>
				
					<td><a href="bstrdeatil.php?bstrid=<?php echo $bstr['bstr_id'];?>">Edit</a></td>
					
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



<!-- @include _footer