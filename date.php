	<?php
	date_default_timezone_set('Asia/Manila');
	$clock = date('H:i:s');
	$da= date("Y-m-d");
	
	$datetime = $da ." ". $clock;
	
	$tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));

	
	$lastweek = mktime(0,0,0,date("m"),date("d")-7,date("Y"));


	$lastmonth = mktime(0,0,0,date("m"),date("d")-30,date("Y"));
	
	$tomorrow2 = date("Y-m-d", $tomorrow);
	$lastweek2 = date("Y-m-d", $lastweek);

	$month = date("Y-m");
	$year = date("Y");
	?>