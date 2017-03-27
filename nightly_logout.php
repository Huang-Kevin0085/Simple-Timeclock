<?php

// checks db for everyone who is still logged in every night and logs them out

$db_name     = "attendance";
$db_password = "root";
$db_link     = mysql_connect("localhost", "root", $db_password);
mysql_select_db($db_name, $db_link);

//$query="SELECT * FROM intern WHERE WEEKOFYEAR(ctime) < WEEKOFYEAR(NOW());";
//$query="SELECT * FROM intern WHERE timelog LIKE '%2017-12-00%';";

//$result=mysql_query($query);

$interns = array();

$query = "SELECT * FROM intern";
$result = mysql_query($query);

while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	$temp_intern = array();
	$temp_intern['clockedin'] = $row['clockedin'];
	$temp_intern['barcode'] = $row['barcode'];
	array_push ($interns, $temp_intern);

}

foreach ( $interns as $intern ) {

	if ($intern['clockedin'] == "1") {

		$ctime = date("Y\-m\-d G\:i\:s"); 

   		$query="UPDATE intern SET clockedin=0 WHERE barcode='$intern[barcode]'";
		mysql_query($query) or die ("Couldnt log out student");

		$query="UPDATE `timelog`.`" . $intern[barcode] ."` SET `timeout` =  '" . $ctime . "' WHERE `" . $intern[barcode] ."`.`timeout` = '0000-00-00 00:00:00' LIMIT 1;";

		mysql_query($query) or die ("Couldnt update timelog \n" . mysql_error());

	}

}


// 0 0 * * * /usr/bin/curl --silent --compressed http://localhost:8888/attendance-new/nightly_logout.php = every night at midnight
// */1 * * * * /usr/bin/curl --silent --compressed http://localhost:8888/attendance-new/nightly_logout.php = every minute

?>