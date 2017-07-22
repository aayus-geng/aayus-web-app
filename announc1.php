<?php

include('init.php');
include('configPDO.php');

$uid = $_GET['uid'];




$STMal = $dbh->prepare("SELECT * FROM tbl_announcements");

$STMal->execute();

$STMalert = $STMal->fetchAll();
foreach($STMalert as $ann)
					


?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h5 class="modal-title">Announcements - <?php echo $fname;?></h5>
</div>

    <div class="modal-body">
		
		<div align="center">
		
				<table class="table table-bordered table-hover datatable">
          <thead>
            <tr>
              <th>Announcment</th>
              <th>Date</th>
              <th>Status</th>
			  <th>Options</th>
              		  
			</tr>
          </thead>
          <tbody>

			<?php

    $STM = $dbh->prepare("SELECT * FROM tbl_announcements ORDER BY a_date DESC");

    $STM->execute();

    $STMrecords5 = $STM->fetchAll();
    foreach($STMrecords5 as $annc1)
        { ?>
			<tr>
              <td><?php echo $annc1['announcement'];?></td>
              <td><?php echo $annc1['a_date'];?></td>
			  <td><?php echo $annc1['status'];?></td>
              <td><a href="">Delete</a></td>

            </tr> 
			
			<?php }	?>
            
          </tbody>
        </table>			

			
            </div>
		    </div>
			
			
			
			
			
