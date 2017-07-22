<?php
include('configPDO.php');

	$STMgs = $dbh->prepare("SELECT * FROM tbl_users WHERE UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(last_login) <= 300");

	$STMgs->execute();

    $members_online = mysql_query();  
   
   $onlinemembers = mysql_num_rows($members_online); 

   if(mysql_num_rows($members_online) == 0) {  

   $members = 'No members online';  

   }else{  
   
   $members=""; 

   while($row = mysql_fetch_array($members_online)){ 

   $members .= '<a href="index.php?action=shdetails&userid='.$row['userid'].'">'.ValidateOutput($row['user_name']).'</a>, '; 

   }  
}  

// Delete old inactive visitors 
    $inactive = time() - 310; 

    mysql_query ("DELETE FROM ppl_online WHERE UNIX_TIMESTAMP(activity) < $inactive");  
	
?>