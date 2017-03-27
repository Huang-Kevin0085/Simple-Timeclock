<?php
session_start();

include "sql_open_conn.php";
include "popup.php"; //function popup($vMsg,$vDestination) & function admin($vDestination) 
include "loginf.php"; //testadmin() 

//grab post variable ID and test for validity.
if(isset($_POST['id'])){
	if(!preg_match_all('/.*(\d{14}).*/', "$_POST[id]", $arr, PREG_PATTERN_ORDER)){
		/* ERROR DIDNT MATCH REGEX */
		popup("Invalid entry, please resubmit" , "index.php");		
	}else{
		$_SESSION['uid'] = $arr[1][0];
	}
	
	
}else{
	popup("Invalid barcode", "index.php");
}

//check barcode against database.
$query = "SELECT clockedin, admin,fname, lname FROM intern WHERE barcode='$_SESSION[uid]'";
if ( $result = (mysql_query ($query)) or die ("Unable to run query[01] " . mysql_error()) ){
	if($row = mysql_fetch_row($result)){
		$_SESSION['clock'] = $row[0]; //clocked in
		$_SESSION['admin'] = $row[1]; //admin
		$_SESSION['fname'] = $row[2]; //fname
		$_SESSION['lname'] = $row[3]; //lname
	}else{
	popup("user doesnt exist, please add user", "index.php");
	}
}
testadmin();
if ($_SESSION['clock'] == "0" ){
	//print "<embed src='/mp3/file.mp3' />"; //for mp3 playing.
	login();
}else{
	//print "<embed src='/mp3/file.mp3' />"; // for mp3 playing on logout
	logout();
}

?>


