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

//date_default_timezone_set($tz);


$STMD= $dbh->prepare("SELECT * FROM tbl_company");
    $STMD->execute();
    $row_company = $STMD->fetch();
	$totalRows_company = $row_company;
	
	
$coname = $row_company['url_name'];
$coimg = $row_company['logo'];
$imgwidth=$row_company['imgwidth'];
$imgheight=$row_company['imgheight'];


$srvtime = date("Y-m-d H:i");

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
	</script>
	

     
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
	border-radius: 8px;
	width: 160px;
	color: #888888;
	padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;	
} 

.btntopup2 {
	background-color: #e0e0e0;
	border-radius: 8px;
	width: 200px;
	color: #888888;
	padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;	
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


  <title>Aayus</title>
  
        
</head>

<body>


<?php include('nav_side.php');?>


<?php  if ($detect->isMobile()) { ?>

<div class="main-content" style="padding-top: 0px;">

<?php } else {?>

<div class="main-content" style="padding-top: 90px;">
	<div class="col-md-2">

  </div>
<?php } ?>
		
            <div class="col-md-10" align="center">
			

				<br>
				<big><h1>Settings</h1></big>
				<br>
				<big><h4>Server Time - <?php echo $srvtime;?></h4></big>
				<big><h4>User Time Zone - <?php echo $tz;?></h4></big>
				<br>
				<big><h4><?php 
				date_default_timezone_set($tz);
				$usertime = date("Y-m-d H:i");
				echo $usertime; ?>
				
				<br>
				<?php $hourdiff = round((strtotime($usertime) - strtotime($srvtime))/3600, 1);  
				echo $hourdiff." Hour Difference";?></h4></big>
				<br>
				
				<a href="#" data-toggle="modal" data-target="#alertinv" data-placement="right" title="" data-original-title="" class="btn btntopup">Alert Inverval - <?php echo $alrt;?></a>

				<a href="#" data-toggle="modal" data-target="#pdata" data-placement="right" title="" data-original-title="" class="btn btntopup">Personal Data</a>
				
				<a href="#" data-toggle="modal" data-target="#social" data-placement="right" title="" data-original-title="" class="btn btntopup">Social Settings</a>
					
				<a href="#" data-toggle="modal" data-target="#uppic" data-placement="right" title="" data-original-title="" class="btn btntopup">Upload Picture</a>
								
				<a href="#" data-toggle="modal" data-target="#cngpass" data-placement="right" title="" data-original-title="" class="btn btntopup">Change Password</a>
	
				<br><br>
				<a href="#tzone" data-toggle="modal" data-target="#tzone" data-placement="right"data-userid="<?php echo $userida;?>" class="tzone btn btntopup2" title="tzone" data-original-title="" >Time Zone - <?php echo $tz;?></a>
				<br><br>
				<a href="#" data-toggle="modal" data-target="#msgpush" data-placement="right" title="" data-original-title="" class="btn btntopup">Send Push Android</a>
				<a href="#" data-toggle="modal" data-target="#msgpushios" data-placement="right" title="" data-original-title="" class="btn btntopup">Send Push iOS</a>

		<br><br><br><br>		
            </div><br><br>
			<div class="col-md-4">
    <div class="widget widget-orange">
         
     </div>
  </div>
			
			<div class="col-md-7" align="center">
			
				<?php
					
				$minutes=40;  
				
				$t=date('Y-m-d H:i:s', time()-$minutes*60);  
					  				
					$STMj1 = $dbh->prepare("select count(*) as onlinecnt from tbl_users where lastaccess > '".$t."'  LIMIT 1");

					$STMj1->execute();

					$STMonln1 = $STMj1->fetchAll();
					foreach($STMonln1 as $online1)
					$cnt=$online1['onlinecnt'];
					if($cnt > 0)
					{	
						
					?>
			 
			 <div class="table-responsive">
				<table class="table table-hover datatable bordered">
								
					
					<tr>
					<td align="left" width="25%"><strong>Name</strong></td>
					<td align="left" width="25%"><strong>Last Access</strong></td>
					<td align="left" width="25%"><strong>Minutes</strong></td>
					<td align="left" width="25%"><strong>Options</strong></td>
					
					</tr>
					
					<?php

					$minutes=40;  
				
					$t=date('Y-m-d H:i:s', time()-$minutes*60);  				
					$STMj2 = $dbh->prepare("select * from tbl_users where lastaccess > '".$t."'");
					$STMj2->execute();
					$STMonln2 = $STMj2->fetchAll();
					foreach($STMonln2 as $online2)
					{	
					?>
					<tr>
					
					
					
					<td align="left"><?php echo $online2['id']."-".$online2['fname']." ".$online2['lname'];?></td>
					
					<td align="left"><?php echo $online2['lastaccess'];?></td>
					<td align="left">
					<?php 
					$to_time = strtotime($usertime);
					$from_time = strtotime($online2['lastaccess']);
					echo round(abs($to_time - $from_time) / 60,2). " minutes"; ?></td>
					<td align="left"></td> 
					</tr>
					<?php } ?>
					
					
				</table>
				</div>
					<?php } ?>
				</div>
						
				
			

		 
        </div>
	  </div>
    </div>


  <div class="page-footer">

</div>
</div>

<div id="tzone" class="modal fade" style="font-weight: normal;" data-focus-on="input:first">
  <div class="modal-dialog" style="width:50%!important;">
  
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
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Profile Picture</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
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


<div class="modal fade" id="msgpush" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Push Notification - Android</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="push/SinglePush1.php" class="form" method="post" name="reg1" role="form"  id="reg">
				
			
				<div class="form-group">
					<div class="col-md-2">
				   Title

				   </div>
				   <div class="col-md-10">
					<input type="text" class="form-control" id="title" name="title" placeholder="Title"/>
					</div>
					
				</div>
				<br><br><br>
				<div class="form-group">
					<div class="col-md-2">
                    Message
					</div>
					<div class="col-md-10">
					<input type="text" class="form-control" id="message" name="message" placeholder="Imessage"/>
					</div>
					
				</div>
				<br><br>
					<div class="form-group">
					<div class="col-md-2">
                    Recipient Token
					</div>
					<div class="col-md-10">
					<input type="text" class="form-control" id="token" name="token" placeholder="Recipient Token" />
					</div>
					
				</div>
				
				<br><br>
					<div class="form-group">
					<div class="col-md-2">
                    Image
					</div>
					<div class="col-md-10">
					<input type="text" class="form-control" id="image" name="image" placeholder="Image" />
					</div>
					
				</div>
							
					<br><br>		

				<div class="form-group">
				<input type="hidden" name="priority" id="priority" value="high">
				<input type="hidden" name="uid" id="uid" value="<?php echo $userida;?>">
				<input type="submit" name="send" id="send" class="btn btn-primary" value="Send">
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

<div class="modal fade" id="msgpushios" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Push Notification - iOS</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="push/PushNotification.php" class="form" method="post" name="reg1" role="form"  id="reg">
				
			
				<div class="form-group">
					<div class="col-md-2">
				   Title

				   </div>
				   <div class="col-md-10">
					<input type="text" class="form-control" id="title" name="title" placeholder="Title"/>
					</div>
					
				</div>
				<br><br><br>
				<div class="form-group">
					<div class="col-md-2">
                    Message
					</div>
					<div class="col-md-10">
					<input type="text" class="form-control" id="message" name="message" placeholder="Imessage"/>
					</div>
					
				</div>
				<br><br>
					<div class="form-group">
					<div class="col-md-2">
                    Recipient Token
					</div>
					<div class="col-md-10">
					<input type="text" class="form-control" id="token" name="token" placeholder="Recipient Token" />
					</div>
					
				</div>
				
				<br><br>
					<div class="form-group">
					<div class="col-md-2">
                    Image
					</div>
					<div class="col-md-10">
					<input type="text" class="form-control" id="image" name="image" placeholder="Image" />
					</div>
					
				</div>
							
					<br><br>		

				<div class="form-group">
				<input type="hidden" name="priority" id="priority" value="high">
				<input type="hidden" name="uid" id="uid" value="<?php echo $userida;?>">
				<input type="submit" name="send" id="send" class="btn btn-primary" value="Send">
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


<div class="modal fade" id="social" tabindex="-1" role="dialog" aria-labelledby="addtaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="widget widget-dark-grey">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
</div>
          <h3><i class="fa fa-table"></i>Social Accounts</h3>
        </div>
        <div class="widget-content">
          <div class="modal-body">
			<div align="center">
		
				<form action="db_settings.php" class="form" method="post" name="reg1" role="form"  id="reg">
				<p> If you wish to post results to any of the social media below please add your account information.  (Function will be available March 21)
				<br><br>
			
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
				<br><br><br>
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
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
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
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
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
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  
  <a href="#" class="widget-control widget-control-refresh" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>
  <a href="#" class="widget-control widget-control-minimize" data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize"><i class="fa fa-minus-circle"></i></a>
  
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