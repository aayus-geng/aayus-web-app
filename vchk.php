<?php

include('init.php');
include('configPDO.php');

$uid = $_GET['vid'];





?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h5 class="modal-title">Vibe Check</h5>
</div>

    <div class="modal-body">
		
		<div align="center">
		
				<strong><big>Quick Vibe Check</big></strong>
				
				<br><br>
				
				<form action="db_addvibe.php" method="post" name="vibe" role="form" id="uid">
				
				
				<strong><big>Overall Vibe</big></strong>
				
								
				<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="ovibe" id="ovibe1" value="-1" autocomplete="off"> Low
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="ovibe" id="ovibe2" value="0" autocomplete="off"> Neutral
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="ovibe" id="ovibe3" value="1" autocomplete="off"> High
			  </label>
				</div>
				
				<br>
				<strong><big>Financial Vibe</big></strong>
												
				<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="fvibe" id="fvibe1" value="-1" autocomplete="off"> Low
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="fvibe" id="fvibe2" value="0" autocomplete="off"> Neutral
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="fvibe" id="fvibe3" value="1" autocomplete="off"> High
			  </label>
				</div>
				
				<br>
				<strong><big>Relationships Vibe</big></strong>
												
				<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="rvibe" id="rvibe1" value="-1" autocomplete="off"> Low
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="rvibe" id="rvibe2" value="0" autocomplete="off"> Neutral
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="rvibe" id="rvibe3" value="1" autocomplete="off"> High
			  </label>
				</div>
				
				<br>
				<strong><big>Health and Wellness Vibe</big></strong>
												
				<div class="btn-group btn-group-justified">
				<label class="btn btn-primary">
				<input type="radio" name="hvibe" id="hvibe1" value="-1" autocomplete="off"> Low
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="hvibe" id="hvibe2" value="0" autocomplete="off"> Neutral
			  </label>
			  <label class="btn btn-primary">
				<input type="radio" name="hvibe" id="hvibe3" value="1" autocomplete="off"> High
			  </label>
				</div>
				<br>
				<div class="form-group">
				<input type="hidden" name="vdate" id="vdate" value="<?php echo $vdate;?>"/>
				<input type="hidden" name="usrid" id="usrid" value="<?php echo $userida;?>"/>
				<input type="submit" name="addvibe" id="addvibe" class="btn btn-primary" value="Save">
				<input type="reset" name="reset" id="reset" class="btn btn-primary" value="Reset">
				
				</div>
				
				</form>	
			
            </div>
		    </div>
			
			
			
			
			
