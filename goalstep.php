<?php

include('init.php');
include('configPDO.php');


$gsid = $_GET['gsid'];

$STMegs = $dbh->prepare("SELECT * FROM tbl_goalstep WHERE gstep_id ='$gsid'");

$STMegs->execute();

$STMgoals = $STMegs->fetchAll();
foreach($STMgoals as $goalstp);

$goalid=$goalstp['goal_id'];

$STMegsall = $dbh->prepare("SELECT SUM(gspercent) as gstotal, goal_id, gstep_id FROM tbl_goalstep WHERE goal_id='$goalid'");

$STMegsall->execute();

$STMgoalstepall = $STMegsall->fetchAll();
foreach($STMgoalstepall as $goalstpall);

$gsstattotal=$goalstpall['gstotal'];




$hourdiff = "14"; 
$today1 = date("Y-m-d",time() + ($hourdiff * 3600));
$today2 = date("Y-m-d",time() + ($hourdiff * 3600));

$gdate1 = date("Y-m-d",time() + ($hourdiff * 3600));
$gtime1 = date("H:i a",time() + ($hourdiff * 3600));
					

include('slider1.html');
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h5 class="modal-title">Goal Step - <?php echo $gsid;?></h5>
	
</div>

         <div class="modal-body">
			<div align="center">
			
			<h5>Enter steps towards your goal (Completed or Pending)</h5>
		
				<form action="db_goalstep2.php" class="form" method="post" name="reg1">
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gsentry" name="gsentry" ><?php echo $goalstp['gsentry'];?></textarea>
				
				</div>
				<div class="form-group">
				
				 % total goal = <?php if($gsstattotal ==""){ echo "0%"; } else { echo $gsstattotal."%";
				}?><br>
                    
					<input type="number" class="form-control" id="gspercent" name="gspercent" placeholder="Percentage this step completed towards the goal" value="<?php echo $goalstp['gspercent'];?>"/>
				
				</div>
				<br><br>
				<div class="form-group">
                <?php $stepstat=$goalstp['gsstatus']; echo $stepstat;?>
				<div class="btn-group btn-group-justified">
				
				<label class="btn btn-primary <?php if ($stepstat == 'complete') { echo 'active'; } ?>">
				<input type="radio" name="gsstatus" id="gsstatus1" value="complete" autocomplete="off" <?php if ($stepstat == 'complete') { echo 'checked="checked"'; } ?>> Complete
			  </label>
			  
			  <label class="btn btn-primary <?php if ($stepstat == 'pending') { echo 'active'; } ?>">
				<input type="radio" name="gsstatus" id="gsstatus2" value="pending" autocomplete="off" <?php if ($stepstat == 'pending') { echo 'checked="checked"'; } ?>> Pending
			  </label>  
					
				</div>
				</div>
				
				<div class="form-group">
                   <br>
				   Step Start Date<br>
					<input type="date" class="form-control" id="gsstartdate" name="gsstartdate" placeholder="Step Start Date" value="<?php echo $goalstp['gsstartdate'];?>"/>
					Step Due Date<br>
					<input type="date" class="form-control" id="gsduedate" name="gsduedate" placeholder="Step Due Date" value="<?php echo $goalstp['gsduedate'];?>"/>
				  
				
				</div>
				
					<br>
				
				
				
				<div class="form-group">
				Rate your vibration
				<?php $gsvibe1=$goalstp['gsvibe']; echo $gsvibe1;?>
				
			<input id="gsvibe2" name="gsvibe" data-slider-id='ex1Slider1' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="<?php echo $gsvibe1;?>"/>
				</div>
				
				<div class="form-group">
                   <br> 
					<input type="text" class="form-control" id="gscomment" name="gscomment" value="" placeholder="Comments" value="<?php echo $goalstp['gscomment'];?>"/>
					
				
				</div>

				<div class="form-group">
                    
					<input type="hidden" class="form-control" id="gsdate" name="gsdate" value="<?php echo $gdate1;?>"/>
					
				
				</div>
				
				<div class="form-group">
				<input type="hidden" name="gsid" id="gsid" value="<?php echo $gsid;?>"/>
				<input type="hidden" name="goalid" id="goalid" value="<?php echo $goalid;?>"/>
				<input type="submit" name="edit" id="edit" class="btn btn-info" value="Update">
			<button type="button" onclick="javascript:window.location.reload()" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancel</button>
				</div>
			</form>	
			<form action="db_goalstep3.php" method="post">
			   <input type="hidden" name="gsid" id="gsid" value="<?php echo $gsid;?>" />
			   <input type="hidden" name="goalid" id="goalid" value="<?php echo $goalid;?>"/>
			   <input type="submit" name="del" id="del" class="btn btn-info" value="Delete">
			   </form>
            </div>
          </div>
	
	
<script>	  
$('#gsvibe2').slider({
formatter: function(value) {
return 'Current value: ' + value;
	}
});
</script>


		  
