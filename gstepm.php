<?php

include('init.php');
include('configPDO.php');

$goalid = $_GET['goalid'];

$STMegsall = $dbh->prepare("SELECT SUM(gsstatus) as gstotal, goal_id, gstep_id FROM tbl_goalstep WHERE goal_id='$goalid'");

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

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h5 class="modal-title"><i class="fa fa-table"></i>Goal Step - <?php echo $goalid;?></h5>
	
</div>

         <div class="modal-body">
			<div align="center">
			
			<h5>Enter steps towards your goal (Completed or Pending)</h5>
		
				<form action="db_goalstepm.php" class="form" method="post" name="reg1" role="form"  id="reg">
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="3" cols="50" id="gsentry" name="gsentry" ></textarea>
				
				</div>
				<div class="form-group">
				
				Current % complete = <?php if($gsstattotal ==""){ echo "0%"; } else { echo $gsstattotal."%";
				}?><br>
                    
					<input type="number" class="form-control" id="gsstatus" name="gsstatus" placeholder="Percentage this step completed towards the goal"/>
				
				</div>
				
				<div class="form-group">
                    
					<input type="date" class="form-control" id="gsduedate" name="gsduedate" placeholder="Goal Step Date" value="<?php print date("Y-m-d",time() + (14 * 3600));?>"/>
				
				</div>
				
					<br><br>		
				
				Rate your vibration
								<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="gsvibe" id="gsvibe1" value="1" autocomplete="off"> Low
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gsvibe" id="gsvibe2" value="2" autocomplete="off"> Neutral
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="gsvibe" id="gsvibe3" value="3" autocomplete="off"> High
			  </label>
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