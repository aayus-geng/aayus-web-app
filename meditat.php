<?php

include('init.php');
include('configPDO.php');

$med1 = $_GET['med1'];




$STMem = $dbh->prepare("SELECT * FROM tbl_meditate WHERE med_id='$med1'");

$STMem->execute();

$STMmedie = $STMem->fetchAll();
foreach($STMmedie as $medie)
					


?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h5 class="modal-title">Meditation - <?php echo $med1;?></h5>
</div>

    <div class="modal-body">
		
		<div align="center">
		
				<form action="db_journal.php" class="form" method="post" name="reg1" role="form"  id="reg">
          
				<div class="form-group">
                    
					<textarea class="form-control" rows="10" cols="50" id="jentry" name="jentry" ><?php echo $journale['jentry'] ;?></textarea>
				
				</div>
				
					<br><br>		
				
				Rate your vibration
				<?php $jvibe=$journale['jvibe'];?>
				<div class="form-group">
				<input id="vibe1" name="jvibe" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="<?php echo $jvibe;?>"/>
				</div>
				<br><br>
				<div class="form-group">
                    
					<input type="date" class="form-control" id="jdate" name="jdate" value="<?php echo $journale['jdate'];?>"/>
					<input type="text" class="form-control" id="jtime" name="jtime" value="<?php echo $journale['jtime'];?>"/>
				
				</div>
				
				<div class="form-group">
				
				<input type="hidden" name="jtype" id="jtype" value="<?php echo $journale['jtype'];?>"/>
				<input type="hidden" name="jid" id="jid" value="<?php echo $jid1;?>"/>
				<input type="hidden" name="usrid" id="usrid" value="<?php echo $journale['usrid'];?>"/>
				<input type="submit" name="edit" id="edit" class="btn btn-primary" value="Update">
				<button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
				
				</div>
			</form>	
			
			
		
            </div>
		    </div>
			
			
<script>
$('#vibe1').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});

</script>		
            
    




