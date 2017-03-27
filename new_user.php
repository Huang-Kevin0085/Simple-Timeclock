<?

include 'sql_open_conn.php';



//PUT THINGS HERE
$ctime = date("Y\-m\-d h\:i\:s A");
	
$query = "INSERT INTO intern (fname, lname, barcode, clockedin, comments) VALUES ('$_POST[fname]' , '$_POST[lname]', '$_POST[barcode]', '0' ,'$_POST[comments]')";

if (!mysql_query($query)) { echo ("Couldnt insert into table.\n"); echo $query; die; }

// new query, create new table, copy previous as needed 

//$query = "CREATE TABLE `timelog`.`" . $_POST[barcode] . "` (`timein` VARCHAR(25) NOT NULL, `timeout` VARCHAR(25) NOT NULL) ENGINE = MyISAM;";

$query = "CREATE TABLE `timelog`.`" . $_POST[barcode] . "` (`timein` DATETIME NOT NULL, `timeout` DATETIME NOT NULL) ENGINE = MyISAM;";

if (!mysql_query($query)) { echo ("Couldnt insert into table.\n"); echo $query; die; }

echo "Success, user added, returning to main login page.\n";



//close the datebase
mysql_close($handler);

?>

<html>
	<head>
	<META  HTTP-EQUIV="Refresh" CONTENT="2; URL=index.php">
	</head>
	<body>
		<p>Fname: <?php echo $_POST["fname"]; ?><br />
		Lname: <?php echo $_POST["lname"]; ?><br />
		Barcode: <?php echo $_POST["barcode"]; ?> <br />
		Comments: <br/> <?php echo $_POST["comments"]; ?><br />
		</p>
		<p>
		Redirecting to main page...
		</p>	
	</body>
</html>	



