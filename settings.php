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
$uemail= $row_user['email'];
$country= $row_user['country'];
$city= $row_user['city'];
$bday= $row_user['bday'];
$gender= $row_user['sex'];
$alrt=$row_user['alrtinterval'];
$fbacct=$row_user['fbuser'];
$twitracct=$row_user['instauser'];
$instaacct=$row_user['twitruser'];
$gplusacct=$row_user['gplususer'];
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

require_once 'device/Mobile_Detect.php';

$detect = new Mobile_Detect;

$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();

if ( $detect->isMobile() ) {
$ecamlink='imgcamemppic.html';
 
} elseif( $detect->isTablet() ){
$ecamlink='imgcamemppic.html';
 
} else {
$ecamlink='cam.php';
}

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta https-equiv="X-UA-Compatible" content="IE=edge">

<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href="assets/modal/css/bootstrap-modal.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel='stylesheet' href='assets/css/bootstrap.css'> 
<link rel='stylesheet' href='assets/css/<?php echo $bckgrnd;?>'>



<script src="vtline/js/libs/modernizr-2.5.3.min.js"></script> 
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://js.pusher.com/3.0/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="tzone/js/timezone_detect.js"></script>
	<script>
		$(function() {
			$.ajax({
				url: 'tzone/timezone_detect.php',
				data: getTimeZoneData(),
				method: 'POST',
				dataType: 'JSON'
			}).done(function(data) {
				$('#timezone').html(data);
			});
		});
		
		 $("#tzone").on('hide', function () {
        window.location.reload();
    });
	
	disableOn: function() {
    // if( $(window).width() < 600 ) {
        // return false;
    // } 
    // return true;

    if (Modernizr.touch){
        return false;
    }
    return true;
}
	</script>
	

     
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

#bgimage { 
    background-image: url('bg1.jpg'); 
}
    @media only screen and (max-width: 320px) {
    #bgimage { 
    background-image: url('bg1.jpg'); 
    }
}
</style>


  <title>Aayus</title>
  
        
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

			<br><br>
			<div class="txtcolor1 col-xs-12 col-md-9" align="center">
			<br>
				<h1>Settings </h1>
				<h3>Current Background <?php echo $bckgrnd;?></h3>
				<br>
					<?php  if ($detect->isMobile()) { $butwidth = '120%'; } else { $butwidth = '80%';}?>
					<div class="col-xs-6 col-md-6" align="center">
					<button type="button" class="btntopup btn-round" style="display: block; width: <?php echo $butwidth;?>; font-size: calc(100% + .05vw);">
					<a href="#" data-toggle="modal" data-target="#alertinv" data-placement="right" title="" data-original-title=""><i class="fa fa-calendar-o fa-2x "></i><br><strong> Alert Interval<br> <?php echo $alrt." Minutes";?></strong><br><br></a>
					</button>
				  </div>
			   
					<div class="col-xs-6 col-md-6" align="center">
					<button type="button" class="btntopup btn-round" style="display: block; width: <?php echo $butwidth;?>; font-size: calc(100% + .05vw);">
					<a href="#pdata" data-toggle="modal" data-target="#pdata" data-placement="right" data-vid="<?php echo $userida;?>" class="pdata" title="pdata" data-original-title="" style=""><i class="fa fa-list fa-2x"></i><br><strong>Personal Data<br> </strong><br><br></a>
				   </button>
				   </div>
				   
				   <br><br>

				<!--
				<div class="col-xs-6 col-md-6" align="center">
				<button type="button" class="btntopup btn" style="display: block; width: <?php //echo $butwidth;?>; font-size: calc(100% + .05vw)">
				<a href="#social" data-toggle="modal" data-target="#social" data-placement="right" data-uid="<?php //echo $userida;?>" class="social" title="social" data-original-title="" style="color: #5406A0;"><i class="fa fa-facebook fa-2x"></i><br><strong>Social<br> </strong><br><br></a></button>
				</div>
				-->			  
				     
					<div class="col-xs-6 col-md-6" align="center">
				  <button type="button" class="btntopup btn-round" style="display: block; width: <?php echo $butwidth;?>; font-size: calc(100% + .05vw);">
				 <a href="#" data-toggle="modal" data-target="#uppic" data-placement="right" title="" data-original-title="" style=""><i class="fa fa-picture-o fa-2x"></i><br><strong>Profile Pic<br> </strong><br><br></a></button>
				 </div>
				 
				 <br><br>
	
				<div class="col-xs-6 col-md-6" align="center">
				  
				  <button type="button" class="btntopup btn-round" style="display: block; width: <?php echo $butwidth;?>; font-size: calc(100% + .05vw);">
				  <a href="#" data-toggle="modal" data-target="#cngpass" data-placement="right" title="" data-original-title="" style=""><i class="fa fa-lock fa-2x"></i><br><strong>Password<br> </strong><br><br></a>
                </button>
				</div>
	
				<div class="col-xs-6 col-md-6" align="center">
				
				<button type="button" class="btntopup btn-round" style="display: block; width: <?php echo $butwidth;?>; font-size: calc(100% + .05vw);">
				
				<a href="#" data-toggle="modal" data-target="#tzone" data-placement="right"data-userid="<?php echo $userida;?>" class="tzone" title="tzone" data-original-title="" style=""><i class="fa fa-clock-o fa-2x"></i><br><strong>Time Zone<br> <?php echo $tz;?></strong><br><br></a></button>
				</div>
				
				<div class="col-xs-6 col-md-6" align="center">
				
				<button type="button" class="btntopup btn-round" style="display: block; width: <?php echo $butwidth;?>; font-size: calc(100% + .05vw);">
				
				<a href="#" data-toggle="modal" data-target="#bckgrnd" data-placement="right"data-userid="<?php echo $userida;?>" class="bckgrnd" title="bckgrnd" data-original-title="" style=""><i class="fa fa-square fa-2x"></i><br><strong>Background<br> <?php echo $bckgrnd;?></strong><br><br></a></button>
				</div>
				
				</div>
	  </div>
    </div>


<div id="tzone" class="modal fade" style="font-weight: normal;" data-focus-on="input:first">
  <div class="modal-dialog">
  
  <div class="modal-content">
  

</div>
 </div>
</div>

<script>
    $('.tzone').click(function(){
        var userid = $(this).attr('data-userid');
		//var timezn = $(this).attr('');
        $.ajax({url:"tzone.php?userid="+userid,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
	

</script>


<div class="modal fade" id="uppic" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
 <a href="#" class="widget-control" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close"></i>X</a>
  
</div>
          <h3><i class="fa fa-table"></i>Profile Picture</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body" style="overflow-y: auto;">
			<div align="center">
		
				<form enctype="multipart/form-data" action="db_settings.php" method="post" name="formaddgpic" class="style1" id="formaddgpic">
					<div class="widget-content">
					<div class="modal-body">
                 <div class="row">
              <div class="col-md-">
                <h4 class="widget-header" style="font-size: 16px!important; font-weight: 0!important;"> </h4>

				</div>       
			 
			
				</div>
				
				<div class="row">
                <div class="col-md-4">
				<a href="<?php echo $ecamlink;?>?u=<?php echo $userida;?>">Take Cam Picture</a>
				 </div>
              </div>
			  
			  
				<div class="row">
                <div class="col-md-4">
                <h4 class="widget-header" style="font-size: 16px!important; font-weight: 0!important;">Upload File</h4>
 
              </div>
              </div>
             
				<div class="row">
				<div class="col-md-4">
				<input name="uploaded" type="file" size="55" />
				</div>
			  
              </div><br>
				<div class="row">
				<div class="form-group">
                <div class="col-md-offset-3 col-lg-10">
				<input name="uid" type="hidden" id="uid" value="<?php echo $userida;?>"/>
                <input type="submit" name="ppic" id="ppic" class="btn btn-info" value="Upload">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> 
              </div>  
			</div>
          </div>
        </div>
			</form>
		
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="bckgrnd" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  

  
   <a href="#" class="widget-control" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close"></i>X</a>
  
</div>
          <h3><i class="fa fa-table"></i>App Background</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body" align="center">
			
		
				<form action="db_settings.php" method="post" name="formaddgpic" class="" id="formaddgpic">
					
             
				<div class="form-group">
				  <select title="Select Background" class="selectpicker" name="bckgrnd" id="bckgrnd">
				    <option value='app.css'><img src="assets/css/bg1.jpg" height="60" width="auto"/>Calm</option>
					<option value='app1.css'><img src="assets/css/bg3.jpg" height="60" width="auto"/>Liquid Energy</option>
					<option value='app2.css'><img src="assets/css/bg5.jpg" height="60" width="auto"/>Control</option>
					
				  </select>
				</div>

              <br>
				
				<div class="form-group">
                
				<input name="uid" type="hidden" id="uid" value="<?php echo $userida;?>"/>
                <input type="submit" name="ppic" id="ppic" class="btn btn-primary" value="Continue">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
              </div>  
			

			</form>
		
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="social" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close"></i>X</a>
  
</div>
          <h3><i class="fa fa-table"></i>Social Accounts</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="db_settings.php" class="form" method="post" name="reg1" role="form"  id="reg">
				<p> <span style="font-size: calc(100% + .2vw"> If you wish to post results to any of the social media add your account information.  <br><br>
			
				<div class="form-group">
					<div class="col-md-2">
				   Facebook

				   </div>
				   <div class="col-md-6">
					<input type="text" class="form-control" id="fbuser" name="fbuser" placeholder="Facebook Account" value="<?php echo $fbacct;?>"/>
					</div>
					<div class="col-md-4">
					<input type="password" class="form-control" id="fbpass" name="fbpass" placeholder="Facebook Password"/>
					</div>
				</div>
				<br><br>
				<div class="form-group">
					<div class="col-md-2">
                    Instagram
					</div>
					<div class="col-md-6">
					<input type="text" class="form-control" id="instauser" name="instauser" placeholder="Instagram Account" value="<?php echo $instaacct;?>"/>
					</div>
					<div class="col-md-4">
					<input type="password" class="form-control" id="instapass" name="instapass" placeholder="Instagram Password"/>
					</div>
				</div>
				<br><br>
					<div class="form-group">
					<div class="col-md-2">
                    Twitter
					</div>
					<div class="col-md-6">
					<input type="text" class="form-control" id="twitruser" name="twitruser" placeholder="Twitter Account" value="<?php echo $twitracct;?>"/>
					</div>
					<div class="col-md-4">
					<input type="password" class="form-control" id="twitrpass" name="twitrpass" placeholder="Twitter Password"/>
					</div>
				</div>
				<br><br>
					<div class="form-group">
					<div class="col-md-2">
                    Google +
					</div>
					<div class="col-md-6">
					<input type="text" class="form-control" id="gplususer" name="gplususer" placeholder="Google+ Account" value="<?php echo $gplusacct;?>"/>
					</div>
					<div class="col-md-4">
					<input type="password" class="form-control" id="gpluspass" name="gpluspass" placeholder="Google + Password"/>
					</div>
				</div>
								
					<br><br>		

				<div class="form-group">
				<input type="hidden" name="uid" id="uid" value="<?php echo $userida;?>">
				<input type="submit" name="social" id="social" class="btn btn-primary" value="Save">
				<button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
				</span>
			</form>	
		
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="pdata" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  
 <a href="#" class="widget-control" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close"></i>X</a>
  
</div>
          <h3><i class="fa fa-table"></i>Enter your Personal Information</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="db_settings.php" class="form" method="post" name="reg1" role="form"  id="reg">

			
				<div class="form-group">
                    <div class="col-md-5">
					First Name
					<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $fname;?>"/>
					</div>
					<div class="col-md-2">
					</div>
					<div class="col-md-5">
					Last Name
					<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $lname;?>"/>
					</div>
				
				</div>
				<br><br>
				<div class="form-group">
				<br><br>
                    <div class="col-md-5">
					Country
					<input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?php echo $country;?>"/>
					</div>
					<div class="col-md-2">
					</div>
					<div class="col-md-5">
					City
					<input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $city;?>"/>
					</div>
					
				
				</div>
				<br><br>
				
							<div class="form-group">
				<br><br>
                    <div class="col-md-12">
					Email
					<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $uemail;?>"/>
					</div>

					
				
				</div>
				
				<br><br>
				
					<div class="form-group">
					<br>
                    <div class="col-md-5">
					Birth Date
					<input type="date" class="form-control" id="bday" name="bday" placeholder="Birth Date" value="<?php echo $bday;?>"/>
					</div>
					<div class="col-md-2">
					</div>
					
					
					<div class="col-md-5">
					Gender
					<div class="btn-group btn-group-justified">
					<label class="btn btn-primary">
					
					<input type="radio" name="gender" value="male" <?php echo ($gender=='male')?'checked':'' ?>/>Male
					</label>
					<label class="btn btn-primary">
					<input type="radio" name="gender" value="female" <?php echo ($gender=='female')?'checked':'' ?>/>Female
					</label>
					
					</div>
				</div>
				
				</div>
				
					<br><br>	<br><br>		
				
				
				<div class="form-group">
				<input type="hidden" name="uid" id="uid" value="<?php echo $userida;?>">
				<input type="submit" name="pdata" id="pdata" class="btn btn-primary" value="Save">
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



<div class="modal fade" id="cngpass" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
 
  <a href="#" class="widget-control" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close"></i>X</a>
  
</div>
          <h3><i class="fa fa-table"></i>Enter New Password</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="db_settings.php" class="form" method="post" name="reg1" role="form"  id="reg">
          
			
				<div class="form-group">
                    
					<input type="password" class="form-control" id="upass" name="upass" placeholder="Enter New Password"/>
				
				</div>
				
								<div class="form-group">
                    
					<input type="password" class="form-control" id="upass1" name="upass1" placeholder="RE-Enter New Password"/>
				
				</div>
				
					<br><br>		
				
				
				<div class="form-group">
				<input type="hidden" name="uid" id="uid" value="<?php echo $userida;?>">
				<input type="submit" name="passupdate" id="passupdate" class="btn btn-primary" value="Save">
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


<div class="modal fade" id="alertinv" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
<a href="#" class="widget-control" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close"></i>X</a>
  
</div>
          <h3><i class="fa fa-table"></i>Alert Interval</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="db_settings.php" class="form" method="post" name="reg1" role="form"  id="reg">
          
			
				<div class="form-group">
                    
					<strong><big>Select the Interval</big></strong>
				<br><br><br><br>
				
				
								
				<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="alrt" value="15" <?php echo ($alrt=='15')?'checked':'' ?> autocomplete="off"/>15
				
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="alrt" value="30" <?php echo ($alrt=='30')?'checked':'' ?> autocomplete="off"/>30
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="alrt" value="45" <?php echo ($alrt=='45')?'checked':'' ?> autocomplete="off"/>45
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="alrt" value="60" <?php echo ($alrt=='60')?'checked':'' ?> autocomplete="off"/>60
			  </label>
				</div>
				
				</div>
				
	
				
					<br><br>		
				
				
				<div class="form-group">
				<input type="hidden" name="uid" id="uid" value="<?php echo $userida;?>">
				<input type="submit" name="intervl" id="intervl" class="btn btn-primary" value="Save">
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
<script src="assets/modal/js/bootstrap-modal.js"></script>
<script src="assets/modal/js/bootstrap-modalmanager.js"></script>

  
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "40%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>