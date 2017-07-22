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
<link rel='stylesheet' href='assets/css/imggallery.css'>
  
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
		
            <div class="col-md-8" align="center">
			<br><br><br>
			<?php
			$goalid=$_GET['goalid'];
			 $STMgimg1 = $dbh->prepare("SELECT goal_id, gimage, usrid FROM tbl_goal WHERE goal_id='$goalid'");
			$STMgimg1->execute();
			$STMgoalimg1 = $STMgimg1->fetchAll();
			foreach($STMgoalimg1 as $goalimg1)
			
			?>
			<h3><?php echo $goalimg1[''];?></h3>  
			  <form enctype="multipart/form-data" action="db_goalbrdpic3.php" method="post" name="formaddgpic2" class="style1" id="formaddgpic2">
				
          
				
				<br>
					<div class="form-group">
                    
					Select an image that represents your goal
					<input name="uploaded" class="form-control" type="file" />
					
				</div>
				
				<div class="form-group">
				
				<input type="hidden" name="usrid" id="usrid" value="<?php echo $userida;?>"/>
				<input type="hidden" name="goalid" id="goalid" value="<?php echo $goalid;?>"/>
				<input type="submit" name="add" id="add" class="btn btn-info" value="Add">
				<button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</form>	
			
				
			 </div>
			 
			 			<div class="col-md-2" align="center">
				
				          
				
								
				<a href="#" data-toggle="modal" data-target="#goaldesc" data-placement="right" title="" data-original-title="" class="btn btn-info">?</a>
				
				<br><br>



			 </div>

        </div>
	  </div>
    </div>

</div>


<div id="gstep" class="modal fade" style="font-weight: normal;" data-focus-on="input:first">
  <div class="modal-dialog" style="width:50%!important;">
  
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
  <div class="modal-dialog" style="width:50%!important;">
  
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
  <div class="modal-dialog" style="width:50%!important;">
  
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