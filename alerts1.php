<?php

include('init.php');
include('configPDO.php');

$uid = $_GET['uid'];


$STMal = $dbh->prepare("SELECT * FROM tbl_alerts WHERE usrid='$uid'");

$STMal->execute();

$STMalert = $STMal->fetchAll();
foreach($STMalert as $alrt)
					

?>

<div class="widget">
        <div class="widget-title">
          <div class="widget-controls">
  
  <a href="#" class="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i class="fa fa-expand"></i></a>
  

  <button type="button" class="close" data-dismiss="modal">&times;</button>
  
</div>

<div class="modal-header">
   
    <h5 class="modal-title">Alerts - <?php echo $fname;?></h5>
</div>

    <div class="modal-body">
		
		<div align="center">
		
				<table class="table table-bordered table-hover datatable">
          <thead>
            <tr>
              <th>Alert</th>
              <th>Date</th>
              <th>Status</th>
			  <th>Options</th>
              		  
			</tr>
          </thead>
          <tbody>

			<?php

    $STM = $dbh->prepare("SELECT * FROM tbl_alerts WHERE usrid='$uid'");

    $STM->execute();

    $STMrecords5 = $STM->fetchAll();
    foreach($STMrecords5 as $alrt1)
        { ?>
			<tr>
              <td><?php echo $alrt1['alert_text'];?></td>
              <td><?php echo $alrt1['alert_date'];?></td>
			  <td><?php echo $alrt1['alert_status'];?></td>
              <td><a href="">Dismiss</a></td>

            </tr> 
			
			<?php }	?>
            
          </tbody>
        </table>			

			
            </div>
		    </div>
		</div>
 </div>
</div>