<?php
session_start();
$uid=$_GET['u'];

$_SESSION["userid"] = "$uid";


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Aayus Webcam</title>
	
<link rel="apple-touch-icon" sizes="180x180" href="assets/images/mindfullogo2.png">
<link rel="icon" type="image/png" href="assets/images/mindfullogo2.png">
<link rel="icon" type="image/png" href="assets/images/mindfullogo2.png">
<link rel="shortcut icon" href="assets/images/mindfullogo2.png" type="image/png">

    <script type="text/javascript" src="webcam.js"></script>
    <script>
        webcam.set_api_url( 'upload.php' );
        webcam.set_quality( 90 ); // JPEG quality (1 - 100)
        webcam.set_shutter_sound( true ); // play shutter click sound
        
        webcam.set_hook( 'onComplete', 'my_completion_handler' );
        
        function take_snapshot() {
            // take snapshot and upload to server
            document.getElementById('upload_results').innerHTML = 'Snapshot<br>'+
            '<img src="empcam/uploading.gif">';
            webcam.snap();
        }
        
        function my_completion_handler(msg) {
            // extract URL out of PHP output
            if (msg.match(/(https\:\/\/\S+)/)) {
                var image_url = RegExp.$1;
                // show JPEG image in page
                document.getElementById('upload_results').innerHTML = 
                    'Snapshot (Click to Save)<br>' + 
                    '<a href="add_usercampic.php?img=' + image_url + '" target"_blank"><img src="' + image_url + '"></a>';
                
				
				
				
                // reset camera for another shot
                webcam.reset();
            }
			
            else alert("PHP Error: " + msg);
        }
    </script>
	
<style>
.main
{
    margin-left: auto;
    margin-right: auto;
    width: 690px;
}
.snap
{
    color: white;
    border-radius: 4px;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    background: #5405A0;
    font-family: inherit;
    font-size: 100%;
    padding: .5em 1em;
    border: 0 hsla(0, 0%, 0%, 0);
    text-decoration: none;
}
.border
{
    border: 3px black solid;
    padding: 5px;
    width: 320px;
    height: 258px;
}

body {
	margin: 0;
}

#over img {
	margin-left: auto;
	margin-right: auto;
	display: block;
}
</style>
</head>
<body>


	<table class="main">
        <tr>
		
<div style="text-align: center;">
<h2>Aayus Cam</h2>
<br>


You can now take a picture with your Webcam or <a href="settings.php" class="btn btn-primary">Upload from computer</a>
<br><br>
Click on the "Allow" button on the left side.  Once you can see the live image click the "snap it" button.  When the snapped image appears on the right side frame, simply click to save.  
<br><br>
<a href="dashboard.php" class="btn btn-primary">cancel</a>
<br>
</div>
            <td valign="top">
			
			
	            <div class="border">
                Webcam<br>
                <script>
                document.write( webcam.get_html(320, 240) );
                </script>
                </div>
                <br/><input type="button" class="snap" value="SNAP IT" onClick="take_snapshot()">
				
            </td>
            <td width="50">&nbsp;</td>
            <td valign="top">
                <div id="upload_results" class="border">
                    Snapshot (Click the picture to save)<br>
					<div id="over" style="position:absolute; width:25%; height:80%">
                    <img src="assets/images/mindfullogo.png" width="240" height="auto"/>
					</div>
                </div>
				
				<div>
				
				</div>
				
            </td>
        </tr>
    </table>
	
</body>
</html>
