<?php
session_start();

include('init.php');
include('configPDO.php');

include('dt.php');

("SET NAMES 'UTF8'");

require_once 'device/Mobile_Detect.php';

$detect = new Mobile_Detect;

$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();


$goalid=$_GET['goalid'];

$_SESSION['goalid']=$goalid;

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



<link rel='stylesheet' href='assets/css/bootstrap.css'> 
<link rel='stylesheet' href='assets/css/<?php echo $bckgrnd;?>'>
  <link rel="stylesheet" href="vtline/css/style.css">
  
<link href="assets/css/bootstrap-slider.css" rel="stylesheet"> 
  <script src="vtline/js/libs/modernizr-2.5.3.min.js"></script> 
     
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

.tlzoom
{
    zoom: 0.45;
    -moz-transform: scale(0.45);
}
</style>


 
		
<div id="header"> 

<div class="page-full-width cf" >

  <title>Aayus Goals</title>
    
</head>

<body>

<?php include('nav_side.php');?>


<?php  if ($detect->isMobile()) { ?>

<div class="main-content" style="padding-top: 0px">

<?php } else { ?>

	<div class="main-content" style="padding-top: 90px">
	<div class="col-md-2">

  </div>
<?php } ?>


		
            <div class="col-xs-12 col-md-4" align="center">
			
			<?php
			
			
			  $STMg1 = $dbh->prepare("SELECT * FROM tbl_goal WHERE goal_id='$goalid'");

					$STMg1->execute();

					$STMgoal1 = $STMg1->fetchAll();
					foreach($STMgoal1 as $goal1)
							  
			  ?>
			  
			  <img src="<?php echo $goal1['gimage'];?>" alt="<?php echo $goal1['gimage'];?>" width="auto" height="150" >
			  <br><br>
			  <p>
			  <a href="#page">View Step Timeline</a>
			  </p>
			  <?php
							  
			  ?>
			 
            <h3>GOAL</h3>     
			<h4><?php echo $goal1['gentry'];?></h4><br>
			
			<h4>Target Completion Date - <?php echo $goal1['gduedate'];?></h4><br>
			<h4><?php echo "I will be ".$goal1['gbewho'];?></h4><br>
			<h4><?php echo "I will have ".$goal1['ghavewhat'];?></h4><br>
			<h4><?php echo "My Vibe = ".$goal1['gvibe'];?></h4><br>
			
			
			
			<a href="goaledit1.php?goalid=<?php echo $goal1['goal_id'];?>" class="btntopup btn-round" style="font-size: calc(100% + .2vw">Edit Goal</a>
			
			<a href="steps.php?goalid=<?php echo $goal1['goal_id'];?>" class="btntopup btn-round" style="font-size: calc(100% + .2vw">+ / Edit Steps</a>
</div>


		
	
<?php  if ($detect->isMobile()) { ?>

<br><br><br>

<div class="col-xs-12 tlzoom" align="center">

<?php } else { ?>

<div class="col-md-6" align="center">
<?php } ?>


<?php
$STMgs = $dbh->prepare("SELECT * FROM tbl_goalstep WHERE goal_id='$goalid'");
$STMgs->execute();
$STMgoals = $STMgs->fetchAll();
foreach($STMgoals as $goals)
					
$goalstp=$goals['gsentry'];
if(!isset($goalstp)){
	
?>

<a href="#addgs" data-toggle="modal" data-placement="right"  class="btntopup btn-round" title="addgs">Add Goal Step</a>

<?php } else { ?>

<div id="page">
	<div role="main" class="clearfix">

      <div id="buttons">
        <div id="expand-collapse-buttons">
          <a class="expand-all active" href="#"><span>EXPAND ALL</span></a>
          <a class="collapse-all" href="#"><span>COLLAPSE ALL</span></a>
        </div>
        <div id="sort-buttons">
          <a class="sort-oldest active" href="#"><span>OLDEST FIRST</span></a>
		  <a class="sort-newest" href="#"><span>NEWEST FIRST</span></a>
        </div>
      </div>

      <div id="timeline">

        <div id="line-container">
          <div id="line"></div>
        </div>

      </div>

    </div>
	</div>
	
	</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="vtline/js/libs/jquery-1.7.1.min.js"><\/script>')</script>


  <script src="vtline/js/handlebars.js"></script>
  <script src="vtline/js/tabletop.js"></script>
  <script src="vtline/js/plugins.js"></script>
  <script src="vtline/js/script.js"></script>

  <script id="year-marker-template" type="text/x-handlebars-template">
    <div class="item year-marker">
      <div class="inner">
        <div class="inner2">
          <div class="timestamp">{{timestamp}}</div>
          <div class="year">{{year}}</div>
        </div>
      </div>
    </div>
  </script>

  <script id="post-template" type="text/x-handlebars-template">
    <div class="item post">
      <div class="inner">
        <div class="timestamp">{{display_date}}</div>
        
		<div class="title"><h3>{{title}}</h3></div>
        <div class="date">{{display_date}}</div>
        <div class="body">
          {{#if gsstartdate}}
            <div class="caption"><strong>Start Date - </strong> ({{gsstartdate}})</div>
          {{/if}}
			{{#if gduedate}}
            <div class="caption"><strong>Due Date - </strong> ({{gduedate}})</div>
          {{/if}}
          {{#if caption}}
            <div class="caption"><strong>Status - </strong>({{caption}})</div>
          {{/if}}
          {{#if body}}
            <div class="text">{{body}}</div>
			
          {{/if}}
		  
          <div class="clearfix">
            {{#if gstpid}}
             <!--<< <a href="mygoal.php?goalid=<?php echo $goalid;?>" class="btn btn-default" data-gsid="">edit</a>
			  div class="share">
                a href="#" class="share-trigger"></a>
                <div class="share-popup">
                  <a href="https://twitter.com/share" class="twitter-share-button" data-url="{{read_more_url}}" data-text="{{title}}" data-count="none">Tweet</a>
                  <a class="facebook-share-button" name="fb_share" type="button" share_url="{{read_more_url}}">Share</a>
                </div>
              </div>-->
            {{/if}}
          </div>
        </div>
      </div>
    </div>
  </script>
<?php } ?>		  
				
			 </div>
			 
			 			

			 </div>

        </div>
	  </div>
</div>

<div id="goalstep" class="modal fade" style="font-weight: normal;">
  <div class="modal-dialog" style="width:80%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>

<script>
    $('.goalstep').click(function(){
        var gsid = $(this).attr('data-gsid');
        $.ajax({url:"goalstep.php?gsid="+gsid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>


<div id="editgoal" class="modal fade" style="font-weight: normal;">
  <div class="modal-dialog" style="width:80%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>

<script>
    $('.editgoal').click(function(){
        var gid = $(this).attr('data-gid');
        $.ajax({url:"editgoal.php?gid="+gid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>	
<div class="modal fade" id="addgs" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  

  
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
                  <br>
					Step Start Date<br>
					<input type="date" class="form-control" id="gsstartdate" name="gsstartdate" placeholder="Step Start Date" value="<?php print date("Y-m-d",time() + (14 * 3600));?>"/>
					Step Due Date<br>
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

<div class="modal fade" id="viewsteps" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
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


?>

          <h3><i class="fa fa-table"></i>Goal Steps</h3>
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


<!---->
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