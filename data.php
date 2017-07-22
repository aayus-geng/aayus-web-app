<?php
session_start();
$goalid=($_SESSION['goalid']);

$con = mysql_connect("localhost","veyeprec_fausr","2ksGC89df$");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("veyeprec_fadb", $con);



$result = mysql_query("SELECT DAY(gsstartdate) AS dtDay, MONTHNAME(gsstartdate) AS dtMonth, gsentry, gsdate, gsstartdate, gsduedate, goal_id, gsstatus, gscomment, gsvibe, gstep_id FROM tbl_goalstep WHERE goal_id='$goalid' ORDER BY gsstartdate DESC");

$rows = array();

while ($r = mysql_fetch_assoc($result)) {
	$row = array();
	$row['title'] = $r['gsentry'];
	$row['date'] = $r['gsstartdate'];
	$row['display_date'] = $r['dtMonth']." - ".$r['dtDay'];  
	$row['gsstartdate'] = $r['gsstartdate'];
	$row['gduedate'] = $r['gsduedate'];
	$row['caption'] = $r['gsstatus'];
	$row['body'] = $r['gscomment'];
	$row['gstpid'] = $r['gstep_id'];
	$row['read_more_url'] = $r['gsvibe'];
	
	array_push($rows,$row);
}
print json_encode($rows);
mysql_close($con );
?>