<?php

include('init.php');
include('configPDO.php');

$goalid = $_GET['goalid'];




$STMimg = $dbh->prepare("SELECT * FROM tbl_goal WHERE goal_id='$goalid'");

$STMimg->execute();

$STMgoalimg = $STMimg->fetchAll();
foreach($STMgoalimg as $goalimg)
					


?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h5 class="modal-title">Add / Change Goal Image - <?php echo $goalid;?></h5>
</div>

    <div class="modal-body text-center block-center">
		
	
				<img src="<?php echo $goalimg['gimage'];?>" border="6" width="200" height="auto">
		
				<form enctype="multipart/form-data" action="add_goalpic.php" method="post" name="formaddgpic" class="style1" id="formaddgpic">
        <div class="widget-content">
          <div class="modal-body">
                 <div class="row">
              <div class="col-md-">
                <h4 class="widget-header" style="font-size: 16px!important; font-weight: 0!important;"> Add Picture --> <?php echo $goalimg['gentry'];?></h4>
				
				
				<input name="gid" type="hidden" id="gid" value="<?php echo $goalimg['goal_id'];?>"/>
				 
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
			  
              </div>
			  <br>
			  
			  
			   <div class="form-group">
                
                <input type="submit" name="gpic" id="gpic" class="btntopup btn-round" value="Upload">
                
                  <button type="button" class="btntopup btn-round" data-dismiss="modal">Close</button>
					<br><br>
				  <button type="button" onclick="location.href='vibes.php?goalid=<?php echo $goalid;?>';" class="btntopup btn-round" data-dismiss="modal">Select from Gallery</button>
                
              </div> 
          </div>
        </div>
</form>

	
</div>
			
			


