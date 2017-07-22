<?php if ( $detect->isMobile() ) { ?> 

<span style="font-size:30px;cursor:pointer;color:black;" onclick="openNav()"><img src="img/menu.png" width="36" height="36"/></span>	

<?php } else {require("top_bar.php");} ?>


    <!-- Sidebar -->
	
<?php if ( $detect->isMobile() ) {  
			
			if(!isset($_SESSION['username'])){
             ?>  
			 <form action="checklogin.php" method="POST" id="login-form" class="cmxform">
            
           <input name="username" type="text" autofocus class="round full-width-input" id="login-username" placeholder=" User" size="10%"  />
              
           <input name="password" type="password" class="round full-width-input" id="login-password" placeholder=" Password" size="10%"  />
           
			<input type="submit" class="btn btn-default btn-sm" name="submit" value="Login" />
                      
          </form>
			<?php } ?>
			
		
 
    <div id="mySidenav" class="sidenav">
        
		<?php 

  if ($ugrp=="admin"){ include_once("menu_mobi.php");} 
  
  ?>
        
    </div>

<?php } else { ?>


  <div class="side">
  <div class="sidebar-wrapper">
  <?php 

  if ($ugrp=="admin"){ include_once("menuadm.php");}   if ($ugrp=="goal") { include_once("menugoal.php");  }
  
  ?>
	</div>

<?php } ?>