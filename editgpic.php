<?php
//session_start();

include('init.php');
include('configPDO.php');

include('dt.php');

require_once 'device/Mobile_Detect.php';

$detect = new Mobile_Detect;

$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();

("SET NAMES 'UTF8'");
$goalid=$_GET['goalid'];
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
	width: 100px;
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
.main-content {
    overflow:auto;
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
<link href="assets/css/bootstrap-slider.css" rel="stylesheet"> 
  <script>
  $('#goalstep').on('hidden.bs.modal', function () {
 location.reload();
})
  </script>
  <div id="header">
		
		<div class="page-full-width cf">

  <title>Aayus Goals</title>
    
</head>

<body>

<?php include('nav_side.php');?>


<?php  if ($detect->isMobile()) { ?>

<div class="main-content" style="padding-top: 0px">

<?php } else { ?>

	<div class="main-content" style="padding-top: 90px">
	<div class="col-md-2">
    <div class="widget widget-orange">
         
     </div>
  </div>
<?php } ?>

  <div class="widget">
      

      <div class="widget-content">
		
            <div class="col-md-6" align="center">
			
			<?php
			
			
			  $STMg1 = $dbh->prepare("SELECT * FROM tbl_goal WHERE goal_id='$goalid'");

					$STMg1->execute();

					$STMgoal1 = $STMg1->fetchAll();
					foreach($STMgoal1 as $goal1)
							  
			  ?>
			  
			  <img src="<?php echo $goal1['gimage'];?>" alt="<?php echo $goal1['gimage'];?>" class="img-thumbnail">
			  <br><br>
			  <?php
							  
			  ?>
			  <a href="goalview.php?goalid=<?php echo $goal1['goal_id'];?>">View Timeline</a>
			  
			  
			  
			  <form action="db_goal2.php" method="post" name="formaddgpic" class="style1" id="formaddgpic">
				
          
				<div class="form-group">
                    
					<h4>GOAL</h4>
					<textarea class="form-control" rows="3" cols="50" id="gentry" name="gentry" placeholder="Describe your goal"><?php echo $goal1['gentry'];?></textarea>
				
				</div>
				
				<div class="form-group">
                    <h4>I will be</h4>
					<textarea class="form-control" rows="3" cols="50" id="gbewho" name="gbewho" placeholder="Describe who you will be when you reach your goal"><?php echo $goal1['gbewho'];?></textarea>
				
				</div>
				
					<div class="form-group">
                    <h4>I will have</h4>
					<textarea class="form-control" rows="3" cols="50" id="ghavewhat" name="ghavewhat" placeholder="Describe what you will have when you reach your goal"><?php echo $goal1['ghavewhat'];?></textarea>
				
				</div>
				<br>
					<div class="form-group">
                    
					<?php 
					if (isset($goal1['gimage'])){
			
					?>
					<input type="hidden" name="goalimg" id="goalimg" value="<?php echo $goal1['gimage'];?>"/>
					
					<?php } else { ?>
					Select an image that represents this goal for you.
					<input name="uploaded" class="form-control" type="file" />
					<?php } ?>
				</div>
				<br>
				<div class="form-group">
				Goal Completed On or Before...
                    
					<input type="date" class="form-control" value="<?php echo $goal1['gduedate'];?>" id="gduedate" name="gduedate" placeholder="Goal Date"/>
				
				</div>
				
					<br><br>		
				
				<p>Take a minute to reflect on your goal.  Think about how you will feel and how your life will be different when you reach your goal.  Then rate your feelings</p><br>
				<?php $vibe=$goal1['gvibe']; echo " Last Vibe - ".$vibe;?>
				
				
				
				<div class="form-group">
				
				<input id="vibe1" name="gvibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="<?php echo $vibe;?>"/>
				
				</div>
				<br><br>
				<div class="form-group">
				Are there any negative feelings (fear, doubt, lack of knowledge or experience?)
                    
					<input type="text" class="form-control" id="gblock" name="gblock" value="<?php echo $goal1['gblock'];?>" placeholder="Enter any possible blocking feeling" />
					
				
				</div>				
				
				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="gdate" name="gdate" value="<?php echo $gdate1;?>"/>
					
				
				</div>
				
				<div class="form-group">
				<input type="hidden" name="gid" id="gid" value="<?php echo $goalid;?>" />
				
				<input type="hidden" name="gtype" id="gtype" value="<?php echo $goalimg1['goalimg_cat'];?>"/>
				<input type="hidden" name="usrid" id="usrid" value="<?php echo $userida;?>"/>
				<input type="submit" name="edit" id="edit" class="btn btn-info" value="Update">
				
				</div>
			</form>	
			   <form action="db_goal.php" method="post" name="formaddgpic" class="style1" id="formaddgpic">
			   <input type="hidden" name="goalid" id="goalid" value="<?php echo $goalid;?>" />
			   <input type="submit" name="del" id="del" class="btn btn-info" value="Delete">
			   </form>
				
			 </div>
			 
			 			<div class="col-md-4" align="center">
					

								<?php

					$STMgs1 = $dbh->prepare("SELECT SUM(gspercent) as gstatcom, goal_id FROM tbl_goalstep WHERE goal_id='$goalid'");

					$STMgs1->execute();

					$STMgoalss1 = $STMgs1->fetchAll();
					foreach($STMgoalss1 as $goals1)
					if (isset($goals1['gstatcom']))
					{
					$comtot=$goals1['gstatcom'];
						
					?>
					

				<h4>Goal Steps</h4><br><br>
					
					
				
				<table class="table" border="2">
										
					<tr>
					<td align="left" width="50%"><strong>Goal Steps (click to edit)</strong></td>
					<td align="left" width="20%"><strong>Due Date</strong></td>
					<td align="centered" width="20%"><strong><?php echo $comtot;?>%</strong></td>
									
					</tr>
					
					<?php
					
					

					$STMgs = $dbh->prepare("SELECT * FROM tbl_goalstep WHERE goal_id='$goalid'");

					$STMgs->execute();

					$STMgoals = $STMgs->fetchAll();
					foreach($STMgoals as $goals)
					{
					?>
					<tr>
				
					<td align="left">								
					<?php 
					$gstepstat=$goals['gsstatus'];
					if($gstepstat=="complete"){
					?>
					
					<a href="#goalstep" data-toggle="modal" data-target="#goalstep" data-placement="right" data-gsid="<?php echo $goals['gstep_id'];?>" class="goalstep" title="goalstep" data-original-title=""><span style="color: green"><?php echo $goals['gsentry'];?></span></a>
					<?php } else { ?>

					<a href="#goalstep" data-toggle="modal" data-target="#goalstep" data-placement="right" data-gsid="<?php echo $goals['gstep_id'];?>" class="goalstep" title="goalstep" data-original-title=""><span style="color: blue"><?php echo $goals['gsentry'];?></span></a>
					
					<?php } ?>
					
					</td>
				<?php //$gddate1=strtotime($goal['gduedate']); echo date("M d", $gddate1);?>
					<td align="centered"><?php $gsdate1=strtotime($goals['gsduedate']); echo date("M-d",$gsdate1);?></td>
					<td align="centered"><?php echo $goals['gspercent'];?></td>
					
					</tr>
					<?php } ?>
										
				</table>
				
				 
					<?php } ?>
					Status - <span style="color: green; padding: 20px;">complete</span>
					<span style="color: blue">pending</span><br><br>
					
					<a href="#addgs" data-toggle="modal" data-placement="right"  class="btn btn-default" title="addgs">+ Goal Step</a>
				
			 </div>
			
			 
			
        </div>
	  </div>
    </div>

</div>


<div id="goalstep" class="modal fade" style="font-weight: normal;">
  <div class="modal-dialog" style="width:50%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>








<div id="goalimg" class="modal fade" style="font-weight: normal;">
  <div class="modal-dialog" style="width:50%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>



<div id="goal1" class="modal fade" style="font-weight: normal;" >
  <div class="modal-dialog" style="width:50%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>


<div class="modal fade" id="addgs" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
<?php
$goalid = $_GET['goalid'];

$STMegsall = $dbh->prepare("SELECT SUM(gspercent) as gstotal, goal_id, gstep_id FROM tbl_goalstep WHERE goal_id='$goalid'");

$STMegsall->execute();

$STMgoalstepall = $STMegsall->fetchAll();
foreach($STMgoalstepall as $goalstpall);

$gsstattotal=$goalstpall['gstotal'];


$STMegs = $dbh->prepare("SELECT * FROM tbl_goal WHERE goal_id='$goalid'");

$STMegs->execute();

$STMgoals = $STMegs->fetchAll();
foreach($STMgoals as $goalstp);

$hourdiff = "14"; 
$today1 = date("Y-m-d",time() + ($hourdiff * 3600));
$today2 = date("Y-m-d",time() + ($hourdiff * 3600));

$gdate1 = date("Y-m-d",time() + ($hourdiff * 3600));
$gtime1 = date("H:i a",time() + ($hourdiff * 3600));
?>

          <h3><i class="fa fa-table"></i>Add Goal Step</h3>
        </div>
        <div class="widget-content">
                  <div class="modal-body">
			<div align="center">
			
			<h5>Enter steps towards your goal (Completed or Pending)</h5>
		
				<form action="db_goalstep.php" class="form" method="post" name="reg1" role="form"  id="reg">
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gsentry" name="gsentry" ></textarea>
				
				</div>
				<div class="form-group">
				
				 % total goal = <?php if($gsstattotal ==""){ echo "0%"; } else { echo $gsstattotal."%";
				}?><br>
                    
					<input type="number" class="form-control" id="gspercent" name="gspercent" placeholder="Percentage this step completed towards the goal"/>
				
				</div>
				<br><br>
				<div class="form-group">
                  							<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="gsstatus" id="gsstatus1" value="complete" autocomplete="off"> Complete
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gsstatus" id="gsstatus2" value="pending" autocomplete="off"> Pending
			  </label>  
					
								</div>

				</div>
				
				<div class="form-group">
                  <br><br>  
					<input type="date" class="form-control" id="gsduedate" name="gsduedate" placeholder="Goal Step Date" value="<?php print date("Y-m-d",time() + (14 * 3600));?>"/>
				
				</div>
				
					<br><br>		
				
				Rate your vibration
				
				<div class="form-group">
				<input id="gsvibe1" name="gsvibe" data-slider-id='ex1Slider2' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="5"/>
				</div>
				
				<div class="form-group">
                   <br><br> 
					<input type="text" class="form-control" id="gscomment" name="gscomment" value="" placeholder="Comments"/>
					
				
				</div>

				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="gsdate" name="gsdate" value="<?php echo $gdate1;?>"/>
					
				
				</div>
				
				<div class="form-group">
				
				<input type="hidden" name="goalid" id="goalid" value="<?php echo $goalid;?>"/>
				<input type="submit" name="gstep" id="gstep" class="btn btn-info" value="Add">
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

<div class="modal fade" id="goaldesc" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Goal Descriptions</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
								<div style="align: left;">
							<p><strong>Before putting your goals into the goal system, take a few minutes to relax or meditate to get yourself in the most positive state of mind.  Think about the highest point you want to reach in this category and that is what you want to type in.    
							<br><br>
							When you are finished with this page, you will have an opportunity to add steps either before or after they are completed so that you can track your progress.  
							<br><br>
							After setting your goals, we advise using our 10 day link to the universe meditation.  </strong> </p>
				<br><br>
								
								
				
				</div>
		
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

		<?php 
			
			$STMgs = $dbh->prepare("SELECT * FROM tbl_goalstep WHERE goal_id='$goalid'");
			$STMgs->execute();
			$STMgoals = $STMgs->fetchAll();
			foreach($STMgoals as $goals)
			{
			?>




		<?php } ?>


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
    $('.goalstep').click(function(){
        var gsid = $(this).attr('data-gsid');
        $.ajax({url:"goalstep.php?gsid="+gsid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>	
<script>
    $('.addgs').click(function(){
        var goalid = $(this).attr('data-goalid');
        $.ajax({url:"gstep.php?goalid="+goalid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>
<script>
    $('.goalimg').click(function(){
        var goalid = $(this).attr('data-g');
        $.ajax({url:"goalimg.php?goalid="+goalid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>

<script>
    $('.goal').click(function(){
        var goal1 = $(this).attr('data-goal1');
        $.ajax({url:"goal1.php?goal1="+goal1,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>



<script>
$('#vibe1').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});

$('#gsvibe1').slider({
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