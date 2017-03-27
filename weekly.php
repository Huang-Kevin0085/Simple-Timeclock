<?php

//copy db to hold and move everything and rename original
//jason.schorr@mandiant.com
//check contains 'current date' print all and trim down to past week  (but how?)

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
	$temp_intern['fname'] = $row['fname'];
	$temp_intern['lname'] = $row['lname'];
	$temp_intern['barcode'] = $row['barcode'];
	array_push ($interns, $temp_intern);

}

 echo 
 	"<table border='3'>
		<tr>
			<th>First</th>
			<th>Last</th>
			<th> ==> </th>
			<th>Time In</th>
			<th> - </th>
			<th>Time Out</th>
			<th> = </th>
			<th>(H:M:S)</th>
		</tr>";

//print_r($interns);

mysql_select_db('timelog', $db_link);
foreach ( $interns as $intern ) {
	$query = "SELECT * FROM `timelog`.`" . $intern['barcode']  . "` WHERE timein >= current_date - 7;";
	//echo  $query . "\n";
	$result = mysql_query($query) or die (mysql_error());
	//echo $result;

	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){

		// check if student hasn't logged out yet

		if ($row['timeout'] == "0000-00-00 00:00:00") {

			echo "<tr>";
			echo "<td>" . $intern['fname'] . "</td>";
			echo "<td>" . $intern['lname'] . "</td>";
			echo "<td>==></td>";
			echo "<td>" . $row['timein'] . "</td>";	
			echo "<td> - </td>";		
			echo "<td>" . $row['timeout'] . "</td>";
			echo "<td> = </td>";
			echo "<td> N/A </td>";
			echo "</tr>";

		}

		else {

			$timein = date_create($row['timein']);
			$timeout = date_create($row['timeout']);

			$diff = date_diff($timein, $timeout);

			echo "<tr>";
			echo "<td>" . $intern['fname'] . "</td>";
			echo "<td>" . $intern['lname'] . "</td>";
			echo "<td>==></td>";
			echo "<td>" . $row['timein'] . "</td>";	
			echo "<td> - </td>";		
			echo "<td>" . $row['timeout'] . "</td>";
			echo "<td> = </td>";
			echo "<td>" . $diff->format('%h:%i:%s') . "</td>";
			echo "</tr>";

		}

	}

}

echo "</table>";

?>

<html>
<head>
    <title>Weekly Report</title>
</head>
<body>
</body>
</html>