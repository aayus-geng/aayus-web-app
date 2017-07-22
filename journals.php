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
	$string = str_replace(" :",":",$string);
	$string = str_replace(" ;",";",$string);
    preg_match('/^.*[^\s](\.|\?|\!\:\;)/U', $string, $match);
    return $match[0];
}
	
	
?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
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


<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />

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

  <title>Aayus Journals</title>
  
  
        
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


		
            <div class="col-xs-12 col-md-6 text-center block-center txtcolor1">
				<br>
				
          
				<br>
				<strong><big>Add New Journal</big></strong>
				<br><br>
				<a href="#" data-toggle="modal" data-target="#mjournal" data-placement="right" title="" data-original-title="" style="width: 250;" class="btntopup btn-round">Morning</a>
				
				<a href="#" data-toggle="modal" data-target="#gjournal" data-placement="right" title="" data-original-title="" style="width: 250;" class="btntopup btn-round">Gratitude</a>
				
				<a href="#" data-toggle="modal" data-target="#fjournal" data-placement="right" title="" data-original-title="" style="width: 250;" class="btntopup btn-round">Forgiveness</a>
				
				<a href="#" data-toggle="modal" data-target="#rjournal" data-placement="right" title="" data-original-title="" style="width: 250;" class="btntopup btn-round">Resolution</a>

             <br><br>
			 <strong>Journal Entries</strong>
			 
			 				<?php

					$STMj1 = $dbh->prepare("SELECT * FROM tbl_journal WHERE usrid='$userida' LIMIT 1");

					$STMj1->execute();

					$STMjourn1 = $STMj1->fetchAll();
					foreach($STMjourn1 as $journ1)
					if (isset($journ1))
					{	
						
					?>
			 
			 
				<table class="table table-hover table-striped datatable">
								
					
					<tr>
					<td align="left" width="15%"><strong>Date</strong></td>
					<td align="left" width="55%"><strong>Entry (click to edit)</strong></td>
					<td align="left" width="15%"><strong>Type</strong></td>
					
					</tr>
					
					<?php

					$STMj = $dbh->prepare("SELECT * FROM tbl_journal WHERE usrid='$userida' ORDER BY journ_id DESC LIMIT 10");

					$STMj->execute();

					$STMjourn = $STMj->fetchAll();
					foreach($STMjourn as $journal)
					{ 
					?>
					<tr>
				
					
					<td align="left"><?php $jdate1=strtotime($journal['jdate']); echo date("M d", $jdate1);?></td>
					
					<td align="left">
					
					<a href="#journ1" data-toggle="modal" data-target="#journ1" data-placement="right" data-jid1="<?php echo $journal['journ_id'];?>" class="journal" title="journal" data-original-title=""><?php echo first_sentence($journal['jentry']);?></a>
					
					</td>
					<td align="left"><?php echo $journal['jtype'];?></td>
					
					</tr>
					<?php } ?>
					
					
				</table>
					<?php } ?>
					
					<?php

					$STMjc1 = $dbh->prepare("SELECT COUNT(journ_id) as jcnt, usrid FROM tbl_journal WHERE usrid='$userida'");
					$STMjc1->execute();
					$STMjournc1 = $STMjc1->fetchAll();
					foreach($STMjournc1 as $journc1)
					$journcnt=$journc1['jcnt'];
					if($journcnt >= 10)
					{
					?>
					
					<div style="text-align: center;">
					<p><a href="viewallj.php">-- view more --</a></p>
					</div>
					<?php } ?>
					</div>
			 
			 	<div class="col-xs-12 col-md-4 text-center block-center txtcolor1">
				<br>
				
          
				<br>
				<strong><big>Journals</big></strong>
				<br><br>
				<p>Morning Journal - Before starting the day, take a few minutes to get clear about what actions and results you plan for yourself</p>
				<br><br>
				<p>Gratitude Journal - At some point during the day take some time to write down what you are grateful for.</p>
				<br><br>
				<p>Forgiveness Journal - One of the major things that can hold us back from having the life we want, is holding on to the past.  One of the first steps to moving forward is forgiving yourself and others for things that happened in the past.  When using the forgiveness journal, take a minute after writing and actually feel the burdon lift from your body and the weight is removed from your pressence, freeing you to take the steps to move forward.  </p>
				<br><br>
				<p>Resolution Journal - When challenges arise take a few minutes to record the problem and work through the actions / resolutions.  <br>
				<p></p>
				


			 </div>

        </div>
	  </div>
    </div>

</div>


<div id="journ1" class="modal fade" style="font-weight: normal;" data-focus-on="input:first">
  <div class="modal-dialog" style="width:80%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>




<script>
    $('.journal').click(function(){
        var jid1 = $(this).attr('data-jid1');
        $.ajax({url:"journ1.php?jid1="+jid1,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>



<div class="modal fade" id="mjournal" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Morning Journal - <?php echo $_SESSION['dtnow'];?></h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="db_journal.php" class="form" method="post" name="reg1" role="form"  id="reg">
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="10" cols="50" id="jentry" name="jentry" ></textarea>
				
				</div>
				
					<br><br>		
				
				Rate your vibration
				<div class="form-group">
				
				<input id="jvibe1" name="jvibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="<?php echo $vibe;?>"/>
				
				</div>
				<br><br>
				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="jdate" name="jdate" value="<?php echo$_SESSION['dnow'];?>"/>
					<input type="hidden" class="form-control" id="jtime" name="jtime" value="<?php echo $_SESSION['tnow'];?>"/>
				
				</div>
				
				<div class="form-group">
				
				<input type="hidden" name="jtype" id="jtype" value="morning"/>
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


<div class="modal fade" id="fjournal" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Forgiveness Journal - <?php echo $_SESSION['dtnow'];?></h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="db_journal.php" class="form" method="post" name="reg1" role="form"  id="reg">
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="10" cols="50" id="jentry" name="jentry" ></textarea>
				
				</div>
				
					<br><br>		
				
				Rate your vibration
				<div class="form-group">
				
				<input id="fvibe1" name="jvibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="<?php echo $vibe;?>"/>
				
				</div>
				<br><br>
				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="jdate" name="jdate" value="<?php echo$_SESSION['dnow'];?>"/>
					<input type="hidden" class="form-control" id="jtime" name="jtime" value="<?php echo $_SESSION['tnow'];?>"/>
				<p>By Clicking the "Add" button, you have chosen to forgive the person listed above.   Feel this burdon that you have carried with you being lifted away freeing you up to move forward in your life.</p>
				</div>
				
				<div class="form-group">
				
				<input type="hidden" name="jtype" id="jtype" value="forgiveness"/>
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

<!-- END Registration -->

<div class="modal fade" id="gjournal" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Gratitude Journal - <?php echo $_SESSION['dtnow'];?></h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="db_journal.php" class="form" method="post" name="reg1" role="form"  id="reg">
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="10" cols="50" id="jentry" name="jentry" ></textarea>
				
				</div>
				
					<br><br>		
				
				Rate your vibration
						<div class="form-group">
				
				<input id="gvibe1" name="jvibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="<?php echo $vibe;?>"/>
				
				</div>
				<br><br>
				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="jdate" name="jdate" value="<?php echo$_SESSION['dnow'];?>"/>
					<input type="hidden" class="form-control" id="jtime" name="jtime" value="<?php echo $_SESSION['tnow'];?>"/>
					
				</div>
				<div class="form-group">
				<input type="hidden" name="jtype" id="jtype" value="gratitude"/>
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


<div class="modal fade" id="rjournal" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Resolution Journal -<?php echo $_SESSION['dtnow'];?></h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="db_resjournal2.php" class="form" method="post" name="reg1" role="form"  id="reg">
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="jentry" name="jentry" placeholder="Explain the issue"></textarea>
				
				</div>
				<div class="form-group">
                    
					<input class="form-control" id="rtrigger" name="rtrigger" placeholder="Who or What triggered this issue"/>
				
				</div>
				<div class="form-group">
                    
					<input class="form-control" id="rfeeling" name="rfeeling" placeholder="Current Feeling / Emotion"/>
				
				</div>
				
				<div class="form-group">
                    
					<input class="form-control" id="rreact1" name="rreact1" placeholder="What is your typical reaction"/>
				
				</div>
				<div class="form-group">
                    
					<input class="form-control" id="rreslt1" name="rreslt1" placeholder="What is the typical result"/>
				
				</div>
				<div class="form-group">
                    
					<input class="form-control" id="rreactb" name="rreactb" placeholder="What is the best reaction"/>
				
				</div>
								<div class="form-group">
                    
					<input class="form-control" id="rreslteb" name="rreslteb" placeholder="What is the expected result"/>
				
				</div>
				
							<div class="form-group">
                    
					<input class="form-control" id="rreslta" name="rreslta" placeholder="What is the actual result"/>
				
				</div>
				
					<br><br>		
				
				Rate your vibration
				<div class="form-group">
				
				<input id="rvibe1" name="jvibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="<?php echo $vibe;?>"/>
				
				</div>
				<br><br>
				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="jdate" name="jdate" value="<?php echo$_SESSION['dnow'];?>"/>
					<input type="hidden" class="form-control" id="jtime" name="jtime" value="<?php echo $_SESSION['tnow'];?>"/>
				
				</div>
				
				<div class="form-group">
				<input type="hidden" name="jtype" id="jtype" value="resolution"/>
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
$('#jvibe1').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});

$('#gvibe1').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});

$('#fvibe1').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});

$('#rvibe1').slider({
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

