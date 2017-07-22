<!-- TOP BAR -->
<?php

include('configPDO.php');

$user=($_SESSION['username']);

$STMu= $dbh->prepare("SELECT * FROM tbl_users WHERE username = '$user'");
    $STMu->execute();
    $row_user = $STMu->fetch();
	$totalRows_user = $row_user;

$uimg = $row_user['img'];	
$userid = $row_user['id'];
$userida = $userid;


?>


	<div class="all-wrapper fixed-header" style="background-color: #fff;">
	<div class="page-header" style="background-color: #fff;">
	<div class="header-links hidden-xs" style="background-color: #fff;"> 
    
	<ul class="nav navbar-nav navbar-right" style="background-color: #fff;">
	
			<?php 
			
			if(!isset($_SESSION['username'])){
             ?>  
			 <form action="checklogin.php" method="POST" id="login-form" class="cmxform">
            <li>
           <input name="username" type="text" autofocus class="round full-width-input" id="login-username" placeholder=" User" size="15%"  />
              
           <input name="password" type="password" class="round full-width-input" id="login-password" placeholder=" Password" size="15%"  />
           
			<input type="submit" class="btn btn-default btn-sm" name="submit" value="Login" />
            </li>            
          </form>
			<?php } else { 
			
				$STMalrtcnt = $dbh->prepare("SELECT COUNT(alert_text) as alrtcnt, usrid FROM tbl_alerts WHERE usrid='$userida'");
				$STMalrtcnt->execute();
				$STMalrtcnt1 = $STMalrtcnt->fetchAll();
				foreach($STMalrtcnt1 as $alrtcnt1)
	
				$totalrt=$alrtcnt1['alrtcnt'];
				?>
				
				<li>
				<a href="<?php echo $ecamlink;?>?u=<?php echo $userida;?>">
					<?php
					if(isset($uimg)){
					?>
					<img class="img-circle" src="<?php echo $uimg;?>" width="60" height="auto"></a>
                    <?php } else { ?>
					<img class="img-circle" src="assets/images/mindfullogo.png" width="60" height="auto"></a>
					<?php } ?>
				</li>
				
				
			   <li><a href="alrt.php" itemprop="url">
                    <span itemprop="name"><?php echo $totalrt." ".Alerts;?></span>
					</a>
				</li>
				
				<?php 
			$STManncnt = $dbh->prepare("SELECT COUNT(announcement) as anncnt, status, exp_date FROM tbl_announcements WHERE status='active' AND exp_date>='$today1'");
			$STManncnt->execute();
			$STManncnt1 = $STManncnt->fetchAll();
			foreach($STManncnt1 as $anncnt1)

			$totann=$anncnt1['anncnt'];
				?>
				
			   <li><a href="announ.php" itemprop="url">
                    <span itemprop="name"><?php echo $totann." ".Announcements;?></span>
					</a>
				</li>
				
			   <li><a href="#" itemprop="url">
                    <span itemprop="name"><?php echo $userid."-".$fname;?></span>
                </a></li>
			
                <li><a href="logout.php?usr=<?php echo $user;?>"><span style="color: black"> Logout</span></a></li>
              <?php } ?>  
				
				
            </ul>
	
	
	
  </div>
  <div style="padding: 0px 0px 0px 30px ">
  <a class="current logo hidden-xs" href="dashboard.php"><img src="assets/images/mmlogo1.png" width="90" height="auto" alt="Aayus"  title="Dashboard" hspace="0"></a>
  </div>
  
    </div> 
	<!-- end top-bar -->
	
