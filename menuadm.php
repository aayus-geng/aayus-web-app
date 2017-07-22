<!DOCTYPE html>

<ul class="sidebar-nav nav" style="text-color: black">

	<?php 
	
	 
	 $curpage = $_SERVER['REQUEST_URI']; 
	 if($curpage != "/wapp/dashboard.php") {
	 ?>
	
	
	<li>
	<br>
      <a href="dashboard.php" data-toggle="tooltip" data-placement="right" title="" data-original-title="">
		<i class="fa fa-home"></i><br>
      </a>
    </li>
	
	 <?php } ?>
	
    <li>
	<br>
      <a href="assessment.php" data-toggle="tooltip" data-placement="right" title="" data-original-title="">
		<i class="fa fa-stethoscope"></i><br>Assessment
      </a>
    </li>

	 <li>
      
	  <a href="goals.php" data-toggle="tooltip" data-placement="right" title="" data-original-title="">
        <i class="fa fa-tasks"></i><br>
		Goals
      </a>
    </li>

   
    <li>

      <a href="meditation.php" data-toggle="tooltip" data-placement="right" title="" data-original-title="">
		<i class="fa fa-eye"></i><br>Meditation
      </a>
    </li>
	<li>

	    <li>

      <a href="affirmations.php" data-toggle="tooltip" data-placement="right" title="" data-original-title="">
		<i class="fa  fa-exclamation"></i><br>Affirmations
      </a>
    </li>

	    <li>
      
	  <a href="journals.php" data-toggle="tooltip" data-placement="right" title="" data-original-title="">
        <i class="fa fa-list-alt"></i><br>
		Journals
      </a>
    </li>

	<li>
	
      <a href="settings.php" data-toggle="tooltip" data-placement="right" title="" data-original-title="">
		<i class="fa fa-cogs"></i><br>Settings
      </a>
    </li>
<li>
       <?php 
	   
	   	   
	   if($user=="todd"){
	   ?>
	  <li>
	
      <a href="superadmin.php" data-toggle="tooltip" data-placement="right" title="" data-original-title="">
		<i class="fa fa-superpowers"></i><br>SUPER Admin
      </a>
    </li>
	   <?php } ?>
	   
	   
    </li>
    
  </ul>
</div>
  