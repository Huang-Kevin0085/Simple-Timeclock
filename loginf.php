<?php

	function testadmin(){
		if ($_SESSION['admin'] == 1 ) { 
			admin();
		}
	}

 	// updates student to be logged in, sets clockedin table = 1

	function login(){
	echo "login print session";
	print_r($_SESSION);
	$gtime = date("Y\-m\-d h\:i\:s A");
 	$ctime = date("Y\-m\-d G\:i\:s"); //current time of most recent logout/login

   	$query="UPDATE intern SET clockedin=1 WHERE barcode='$_SESSION[uid]'";
	mysql_query($query) or die ("Couldnt log in student");
	
	/*

	// old function that concatenated timelog into unreadable format, don't use

	$query="UPDATE intern SET timelog=concat(\"in: '$gtime'\n\", timelog) WHERE barcode='$_SESSION[uid]'";
	mysql_query($query) or die ("Couldnt update time table.<br/>");
	$query="UPDATE intern SET ctime='$ctime' WHERE barcode='$_SESSION[uid]'";
	mysql_query($query) or die ("Couldnt set ctime.<br/>");
	*/

	// inserts timein as date("Y\-m\-d G\:i\:s") into new student database `timelog`, sets timeout = '-'

	$query="INSERT INTO `timelog`.`" . $_SESSION[uid] ."` (`timein`, `timeout`) VALUES ('" . $ctime  ."', '0000-00-00 00:00:00');";

	mysql_query($query) or die ("Couldnt update timelog :( \n" . mysql_error());

	popup("Logged in: $_SESSION[fname] $_SESSION[lname]", "index.php");
	
	//get image of user
	//grabimage($_SESSION['uid']);
	
	}

	// updates student to be logged out, sets clockedin table = 0

	function logout(){
	
	$gtime = date("Y\-m\-d h\:i\:s A");
	$ctime = date("Y\-m\-d G\:i\:s"); //current time of most recent logout/login
	
	$query="UPDATE intern SET clockedin=0 WHERE barcode='$_SESSION[uid]'";
	mysql_query($query) or die ("Couldnt log out student");

	/*

	$query="UPDATE intern SET timelog=concat(\"out:'$gtime'\n\", timelog) WHERE barcode='$_SESSION[uid]'";
	mysql_query($query) or die ("Couldnt update time table.<br/>");
	$query="UPDATE intern SET ctime='$ctime' WHERE barcode='$_SESSION[uid]'";
	mysql_query($query) or die ("Couldnt set ctime.<br/>");
	
	*/

	/*

	$query="INSERT INTO `timelog`.`" . $_SESSION[uid] ."` (`timein`, `timeout`) VALUES ('-' , '" . $ctime . "');";

	mysql_query($query) or die ("Couldnt update timelog :( \n" . mysql_error());

	popup("Logged Out: $_SESSION[fname] $_SESSION[lname]", "index.php");	
	}
	
	*/

	// updates new database `timelog` by changing '-' from the login insertion into the actual timeout time

	$query="UPDATE `timelog`.`" . $_SESSION[uid] ."` SET `timeout` =  '" . $ctime . "' WHERE `" . $_SESSION[uid] ."`.`timeout` = '0000-00-00 00:00:00' LIMIT 1;";

	mysql_query($query) or die ("Couldnt update timelog \n" . mysql_error());

	popup("Logged Out: $_SESSION[fname] $_SESSION[lname]", "index.php");	
	}

	function checktime(){
		
	}

	function grabimage($student){
		$from = "camimages/webcam.jpg";
		$to = "userimg/$student[id].jpg";
		if(!copy($from, $to)){
			echo "Failed to copy webcam image.<br />";
		}else{
			$query="UPDATE intern SET imageurl='$to' WHERE barcode='$student[id]'";
			mysql_query($query) or die ('Couldnt update image url: $to <br />');
		}
	}

?>