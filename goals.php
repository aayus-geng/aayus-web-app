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


$STMD= $dbh->prepare("SELECT * FROM tbl_company");
    $STMD->execute();
    $row_company = $STMD->fetch();
	$totalRows_company = $row_company;
	
	
$coname = $row_company['url_name'];
$coimg = $row_company['logo'];
$imgwidth=$row_company['imgwidth'];
$imgheight=$row_company['imgheight'];


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

.tlzoom
{
    zoom: 0.45;
    -moz-transform: scale(0.45);
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


<?php  if ($detect->isMobile()) { ?>

<link rel='stylesheet' href='assets/css/imggallery.css'>

<?php } else { ?>

<link rel='stylesheet' href='assets/css/imggallery.css'>

<?php } ?>
  
  <div id="header">

  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>
<!-- 
 <script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(["init", {
      appId: "6d01e6a1-bb1f-4214-9ad1-663ee5a23b9a",
      autoRegister: false, /* Set to true to automatically prompt visitors */
      subdomainName: 'https://mindfullmastery.onesignal.com',
      /*
      subdomainName: Use the value you entered in step 1.4: https://imgur.com/a/f6hqN
      */
      httpPermissionRequest: {
        enable: true
      },
      notifyButton: {
          enable: true /* Set to false to hide */
      }
    }]);
  </script>
-->
  
		<div class="page-full-width cf">

  <title>Aayus Goals</title>
    
</head>

<body>


<?php include('nav_side.php');?>


<?php  if ($detect->isMobile()) { ?>

<div class="main-content" style="padding-top: 0px">

<?php } else { ?>

	<div class="main-content" style="padding-top: 100px">
	<div class="col-md-2">
  </div>
<?php } ?>


            
			<?php  if ($detect->isMobile()) { ?>
			<div class="col-md-10">
			<?php } else { ?>
			
			<div class="col-md-6" align="center">
			<?php } ?>
			
			
			<a href="goalsa.php" class="btntopup btn-round" style="font-size: calc(100% + .1vw);">New Goal</a>
			
			<a href="addgpic.php" class="btntopup btn-round" style="font-size: calc(100% + .1vw);">+ Image</a>
			
			<!--
			<a href="goalbrdprnt.php?usrid=<?php echo $userida;?>" target="blank" class="btn btn-default"  style="font-size: calc(100% + .05vw);">Print</a>
			-->
			
			<br><br><br>
			
			<section id="photos"> 
			  <?php
			  $STMgimg1 = $dbh->prepare("SELECT goal_id, gimage, usrid FROM tbl_goal WHERE usrid='$userida'");
					$STMgimg1->execute();
					$STMgoalimg1 = $STMgimg1->fetchAll();
					foreach($STMgoalimg1 as $goalimg1)
				{
			  ?>
			  <a href="goalview.php?goalid=<?php echo $goalimg1['goal_id'];?>">
			  <img src="<?php echo $goalimg1['gimage'];?>" class="img-responsive"></a>
			  
			  <?php } ?>
			  
			  
			   <?php
			  $STMgimg1a = $dbh->prepare("SELECT goalboard_id, goal_img, usrid FROM tbl_goalbrd WHERE usrid='$userida'");
					$STMgimg1a->execute();
					$STMgoalimg1a = $STMgimg1a->fetchAll();
					foreach($STMgoalimg1a as $goalimg1a)
				{
			  ?>
			  
			  <a href="#goalimg" data-toggle="modal" data-target="#goalimg" data-placement="right"data-goalid="<?php echo $goal['goal_id'];?>" class="goalimg" title="goalimg" data-original-title=""><img src="<?php echo $goal['gimage'];?>" width="80" height="auto"/></a>
			  <a href="editgpic.php?gpid=<?php echo $goalimg1a['goalboard_id'];?>">
			  <img src="<?php echo $goalimg1a['goal_img'];?>"></a>
			  
			  <?php } ?>
			  
			  
			  <?php
			  
			   $STMgc1 = $dbh->prepare("SELECT count(gimage) as gimgcnt1, usrid FROM tbl_goal WHERE usrid='$userida' ");
				$STMgc1->execute();
				$STMgoalc1 = $STMgc1->fetchAll();
				foreach($STMgoalc1 as $goalc1)
					
				$gpiccnt1=$goalc1['gimgcnt1'];
				
				$STMgc2 = $dbh->prepare("SELECT count(goal_img) as gimgcnt2, usrid FROM tbl_goalbrd WHERE usrid='$userida' ");
				$STMgc2->execute();
				$STMgoalc2 = $STMgc2->fetchAll();
				foreach($STMgoalc2 as $goalc2)
					
				$gpiccnt2=$goalc2['gimgcnt2'];
				
				$gpiccnt=(20 - ($gpiccnt2+$gpiccnt1));
				
				$STMgimg2 = $dbh->prepare("SELECT * FROM lut_goalimg ORDER BY rand() LIMIT $gpiccnt");
				$STMgimg2->execute();
				$STMgoalimg2 = $STMgimg2->fetchAll();
				foreach($STMgoalimg2 as $goalimg2)
							  
			  {
			  ?>
			  
			  <a href="goalsb.php?gpid=<?php echo $goalimg2['goalimg_id'];?>">
			  <img src="img/goals/all/<?php echo $goalimg2['goalimg_file'];?>" alt="<?php echo $goalimg2['goalimg_name'];?>"></a>
			  
			  <?php } ?>
			  
			</section>
			
				<?php echo $gpiccnt;?>
			 </div>
			 
			 			<div class="col-xs-12 col-md-4" align="center">
				
				          
				
             <br><br>
			 <strong>Goals</strong><br><br>
				
				
				<?php

					$STMg1 = $dbh->prepare("SELECT * FROM tbl_goal WHERE usrid='$userida' LIMIT 1");

					$STMg1->execute();

					$STMgoal1 = $STMg1->fetchAll();
					foreach($STMgoal1 as $goal1)
					if (isset($goal1))
					{	
						
					?>
				
				<table class="table table-striped">
										
					<tr>
					
					<td align="left" width="30%"><strong>Goal Image</strong></td>
					<td align="left" width="50%"><strong>Goal (Click for Details)</strong></td>
					<td align="left" width="20%"><strong>Steps</strong></td>
					<!--
					<td align="left" width="10%"><strong>Type</strong></td>
					<td align="left" width="15%"><strong>Due Date</strong></td>
					<td align="left" width="10%"><strong>Status (View)</strong></td>
					<td align="left" width="10%"><strong>Steps</strong></td>
					-->
					</tr>
					
					<?php
					
					

					$STMg = $dbh->prepare("SELECT * FROM tbl_goal WHERE usrid='$userida' ");

					$STMg->execute();

					$STMgoal = $STMg->fetchAll();
					foreach($STMgoal as $goal)
					{
					?>
					<tr>
				
					<td align="centered">
					<?php
					$goalimg=$goal['gimage'];
					
					if($goalimg != ""){
						
					?>
					
					<a href="#goalimg" data-toggle="modal" data-target="#goalimg" data-placement="right"data-goalid="<?php echo $goal['goal_id'];?>" class="goalimg" title="goalimg" data-original-title=""><img src="<?php echo $goal['gimage'];?>" width="80" height="auto"/></a>
					
					
					<?php } else { ?>
					
					
					
					<a href="#goalimg" data-toggle="modal" data-target="#goalimg" data-placement="right"data-goalid="<?php echo $goal['goal_id'];?>" class="goalimg" title="goalimg" data-original-title=""><img src="images/addgoalpic.png" width="40" height="auto"/></a>
					
					<?php } ?>
					</td>
				
					<td align="left">
										
					<a href="goalview.php?goalid=<?php echo $goal['goal_id'];?>" class="goal" title="goal" data-original-title=""><strong><?php echo first_sentence($goal['gentry']);?></strong></a>
					
					</td>
					
					<td align="left">
										
					<a href="mygoal.php?goalid=<?php echo $goal['goal_id'];?>" class="goal" title="goal" data-original-title=""><i class="fa fa-edit fa-2x"></i></a>
					
					</td>

					</tr>
					<?php } ?>
										
				</table>
					<?php } ?>
				
				<a href="" data-toggle="modal" data-target="#goaldesc" data-placement="right" title="" data-original-title="" class="btntopup btn-round">?</a>
				
				
				
				<br><br>

			 </div>
			</div>
		</div>	
	</div>	
 </div>	       
 </div>




<div id="gstep" class="modal fade" style="font-weight: normal;" data-focus-on="input:first">
  <div class="modal-dialog" style="width:80%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>

<script>
    $('.gstep').click(function(){
        var goalid = $(this).attr('data-goalid');
        $.ajax({url:"gstep.php?goalid="+goalid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>

<div id="goalimg" class="modal fade" style="font-weight: normal;" data-focus-on="input:first">
  <div class="modal-dialog">
  
  <div class="modal-content">
  

</div>
 </div>
</div>

<script>
    $('.goalimg').click(function(){
        var goalid = $(this).attr('data-goalid');
        $.ajax({url:"goalimg.php?goalid="+goalid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>



<div id="goal1" class="modal fade" style="font-weight: normal;" data-focus-on="input:first">
  <div class="modal-dialog" style="width:80%!important;">
  
  <div class="modal-content">
  

</div>
 </div>
</div>




<script>
    $('.goal').click(function(){
        var goal1 = $(this).attr('data-goal1');
        $.ajax({url:"goal1.php?goal1="+goal1,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>

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
							<p><strong>Before putting your goals into the goal tracker, take a few minutes to relax or meditate to get yourself in the most positive state of mind.  This is best done while you have about 30 minutes of uninterrupted time.  
							<br><br>
							After setting your goals, we advise using our 10 day link to the universe meditation.  </strong> </p>
				<br><br>
								
								
				<p><strong>Financial Goals</strong> - Financial, Work or Business related goals.  Enter the Big Picture goal and track steps and progress</p>
				<br><br>
				<p><strong>Relationship Goals</strong> - Romantic, Family or Friends</p>
				<br><br>
				<p><strong>Health Goals</strong> - Exercise, General Health or Medical</p>
				<br><br>
				<p><strong>Charity Goals</strong> - Goals dedicated to helping others.  These goals can be monitary, emotional, or volunteering.  </p>
				
				<p></p>
				</div>
		
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="fgoal" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Financial Goal - Entry Date <?php echo $gdate1;?></h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
				<form enctype="multipart/form-data" action="db_goal.php" method="post" name="formaddgpic" class="style1" id="formaddgpic">
				
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gentry" name="gentry" placeholder="Describe your goal"></textarea>
				
				</div>
				
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gbewho" name="gbewho" placeholder="Describe who you will be when you reach your goal"></textarea>
				
				</div>
				
					<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="ghavewhat" name="ghavewhat" placeholder="Describe what you will have when you reach your goal"></textarea>
				
				</div>
				<br>
					<div class="form-group">
                    Select an image that reflects this goal or something you will have when you reach it.
					<input name="uploaded" class="form-control" type="file" />
				
				</div>
				<br>
				<div class="form-group">
				Goal Completed On or Before...
                    
					<input type="date" class="form-control" value="<?php print date("Y-m-d",time() + (14 * 3600));?>" id="gduedate" name="gduedate" placeholder="Goal Date"/>
				
				</div>
				
					<br><br>		
				
				<p>Take a minute to reflect on your goal.  Think about how you will feel and how your life will be different when you reach your goal.  Then rate your feelings</p><br>
				
				<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe1" value="-1" autocomplete="off"> Low
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe2" value="0" autocomplete="off"> Neutral
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe3" value="1" autocomplete="off"> High
			  </label>
				</div>
				<br><br>
				<div class="form-group">
				Are there any negative feelings (fear, doubt, lack of knowledge or experience?)
                    
					<input type="text" class="form-control" id="gblock" name="gblock" value="" placeholder="Enter any possible blocking feeling"/>
					
				
				</div>				
				
				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="gdate" name="gdate" value="<?php echo $gdate1;?>"/>
					
				
				</div>
				
				<div class="form-group">
				
				<input type="hidden" name="gtype" id="gtype" value="financial"/>
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

<!-- end fgoal start rgoal -->

<div class="modal fade" id="rgoal" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Relationship Goal - Entry Date <?php echo $gdate1;?></h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
				<form enctype="multipart/form-data" action="db_goal.php" method="post" name="formaddgpic" class="style1" id="formaddgpic">
				
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gentry" name="gentry" placeholder="Describe your goal"></textarea>
				
				</div>
				
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gbewho" name="gbewho" placeholder="Describe who you will be when you reach your goal"></textarea>
				
				</div>
				
					<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="ghavewhat" name="ghavewhat" placeholder="Describe what you will have when you reach your goal"></textarea>
				
				</div>
				<br>
					<div class="form-group">
                    Select an image that reflects this goal or something you will have when you reach it.
					<input name="uploaded" class="form-control" type="file" />
				
				</div>
				<br>
				<div class="form-group">
				Goal Completed On or Before...
                    
					<input type="date" class="form-control" value="<?php print date("Y-m-d",time() + (14 * 3600));?>" id="gduedate" name="gduedate" placeholder="Goal Date"/>
				
				</div>
				
					<br><br>		
				
				<p>Take a minute to reflect on your goal.  Think about how you will feel and how your life will be different when you reach your goal.  Then rate your feelings</p><br>
				
				<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe1" value="-1" autocomplete="off"> Low
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe2" value="0" autocomplete="off"> Neutral
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe3" value="1" autocomplete="off"> High
			  </label>
				</div>
				<br><br>
				<div class="form-group">
				Are there any negative feelings (fear, doubt, lack of knowledge or experience?)
                    
					<input type="text" class="form-control" id="gblock" name="gblock" value="" placeholder="Enter any possible blocking feeling"/>
					
				
				</div>				
				
				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="gdate" name="gdate" value="<?php echo $gdate1;?>"/>
					
				
				</div>
				
				<div class="form-group">
				
				<input type="hidden" name="gtype" id="gtype" value="relationship"/>
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

<!-- end rgoal start hgoal -->

<div class="modal fade" id="hgoal" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Health Goal - Entry Date <?php echo $gdate1;?></h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
				<form enctype="multipart/form-data" action="db_goal.php" method="post" name="formaddgpic" class="style1" id="formaddgpic">
				
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gentry" name="gentry" placeholder="Describe your goal"></textarea>
				
				</div>
				
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gbewho" name="gbewho" placeholder="Describe who you will be when you reach your goal"></textarea>
				
				</div>
				
					<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="ghavewhat" name="ghavewhat" placeholder="Describe what you will have when you reach your goal"></textarea>
				
				</div>
				<br>
					<div class="form-group">
                    Select an image that reflects this goal or something you will have when you reach it.
					<input name="uploaded" class="form-control" type="file" />
				
				</div>
				<br>
				<div class="form-group">
				Goal Completed On or Before...
                    
					<input type="date" class="form-control" value="<?php print date("Y-m-d",time() + (14 * 3600));?>" id="gduedate" name="gduedate" placeholder="Goal Date"/>
				
				</div>
				
					<br><br>		
				
				<p>Take a minute to reflect on your goal.  Think about how you will feel and how your life will be different when you reach your goal.  Then rate your feelings</p><br>
				
				<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe1" value="-1" autocomplete="off"> Low
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe2" value="0" autocomplete="off"> Neutral
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe3" value="1" autocomplete="off"> High
			  </label>
				</div>
				<br><br>
				<div class="form-group">
				Are there any negative feelings (fear, doubt, lack of knowledge or experience?)
                    
					<input type="text" class="form-control" id="gblock" name="gblock" value="" placeholder="Enter any possible blocking feeling"/>
					
				
				</div>				
				
				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="gdate" name="gdate" value="<?php echo $gdate1;?>"/>
					
				
				</div>
				
				<div class="form-group">
				
				<input type="hidden" name="gtype" id="gtype" value="health"/>
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

<!-- end hgoal start cgoal -->

<div class="modal fade" id="cgoal" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Charity Goal - Entry Date <?php echo $gdate1;?></h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
				<form enctype="multipart/form-data" action="db_goal.php" method="post" name="formaddgpic" class="style1" id="formaddgpic">
				
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gentry" name="gentry" placeholder="Describe your goal"></textarea>
				
				</div>
				
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gbewho" name="gbewho" placeholder="Describe who you will be when you reach your goal"></textarea>
				
				</div>
				
					<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="ghavewhat" name="ghavewhat" placeholder="Describe what you will have when you reach your goal"></textarea>
				
				</div>
				<br>
					<div class="form-group">
                    Select an image that reflects this goal or something you will have when you reach it.
					<input name="uploaded" class="form-control" type="file" />
				
				</div>
				<br>
				<div class="form-group">
				Goal Completed On or Before...
                    
					<input type="date" class="form-control" value="<?php print date("Y-m-d",time() + (14 * 3600));?>" id="gduedate" name="gduedate" placeholder="Goal Date"/>
				
				</div>
				
					<br><br>		
				
				<p>Take a minute to reflect on your goal.  Think about how you will feel and how your life will be different when you reach your goal.  Then rate your feelings</p><br>
				
				<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe1" value="-1" autocomplete="off"> Low
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe2" value="0" autocomplete="off"> Neutral
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gvibe" id="gvibe3" value="1" autocomplete="off"> High
			  </label>
				</div>
				<br><br>
				<div class="form-group">
				Are there any negative feelings (fear, doubt, lack of knowledge or experience?)
                    
					<input type="text" class="form-control" id="gblock" name="gblock" value="" placeholder="Enter any possible blocking feeling"/>
					
				
				</div>				
				
				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="gdate" name="gdate" value="<?php echo $gdate1;?>"/>
					
				
				</div>
				
				<div class="form-group">
				
				<input type="hidden" name="gtype" id="gtype" value="charity"/>
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

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "40%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>

<!-- @include _footer