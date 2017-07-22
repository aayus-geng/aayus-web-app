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
#container {
    width: 300px;
    height: 300px;
    background-color: #FFF;
}

#target {
    height: 100%;
    background-color: #C00;
    border-radius: 50%;
    position: relative;
    cursor: crosshair;
}

.bullet-hole {
    width: 80px;
    height: 80px;
    background-image: url('https://i.imgur.com/YOjHYjH.gif');
    background-size: cover;
    position: absolute;
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
<script>

// Mouseover/ Click sound effect- by JavaScript Kit (www.javascriptkit.com)
// Visit JavaScript Kit at https://www.javascriptkit.com/ for full source code

//** Usage: Instantiate script by calling: var uniquevar=createsoundbite("soundfile1", "fallbackfile2", "fallebacksound3", etc)
//** Call: uniquevar.playclip() to play sound

var html5_audiotypes={ //define list of audio file extensions and their associated audio types. Add to it if your specified audio file isn't on this list:
	"mp3": "audio/mpeg",
	"mp4": "audio/mp4",
	"ogg": "audio/ogg",
	"wav": "audio/wav"
}

function createsoundbite(sound){
	var html5audio=document.createElement('audio')
	if (html5audio.canPlayType){ //check support for HTML5 audio
		for (var i=0; i<arguments.length; i++){
			var sourceel=document.createElement('source')
			sourceel.setAttribute('src', arguments[i])
			if (arguments[i].match(/\.(\w+)$/i))
				sourceel.setAttribute('type', html5_audiotypes[RegExp.$1])
			html5audio.appendChild(sourceel)
		}
		html5audio.load()
		html5audio.playclip=function(){
			html5audio.pause()
			html5audio.currentTime=0
			html5audio.play()
		}
		return html5audio
	}
	else{
		return {playclip:function(){throw new Error("Your browser doesn't support HTML5 audio unfortunately")}}
	}
}

//Initialize two sound clips with 1 fallback file each:

var mouseoversound=createsoundbite("click1.mp3")
var clicksound=createsoundbite("click1.mp3")


var uniquevar=createsoundbite("soundfile1", "fallbacksound", "fallbacksound2", etc)

</script>



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

			<div id="container">
			
			<?php
			
			$STMbstr = $dbh->prepare("SELECT * FROM tbl_buster WHERE bstr_id='$userida'");
			$STMbstr->execute();
			$STMbstr1 = $STMbstr->fetchAll();
			foreach($STMbstr1 as $bstr)
			
					?>
			
				<div id="target"><a href="#current" style="cursor:crosshair;" onclick="clicksound.playclip()"><img src="images/finger2.jpg" width="300" height="auto"/></a></div>
			</div>
			

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
					<td align="left" width="20%"><strong>edit</strong></td>
					
									
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

<script>
$('#target').click(function(e) {
    $('<div />').addClass('bullet-hole').css({
        top: e.offsetY - 5,
        left: e.offsetX - 10
    }).appendTo('#target');
    setTimeout(removeImage, 50000);
});

function removeBulletHole() {
	$('#target .bullet-hole:not(:animated):first').fadeOut(function() {
    	$(this).remove();
    });
}

function removeImage() {
	$('#target :not(:animated):first').fadeOut(function() {
    	$(this).remove();
    });
}
</script> 

</body>
</html>