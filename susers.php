<?php 
/////////////////////includes
include 'sql_open_conn.php';
include 'ulogs.php';
include 'edituser.php';
include 'style.css';


if (!isset($_POST['auser']))
	{ echo "incorrect variables passed"; die; }

//print_r($_POST);



if ($_POST['query'] == "logs") { 
	$users[]=$_POST['auser'] ; 
	$i=0;
	foreach ($_POST['auser'] as $id){
		$users[0][$i] = ulogs($id);
	 	$i++;
	 }
}

if($_POST['query'] == "edit"){
	$users[]=$_POST['auser'];
	$i=0;
	foreach ($_POST['auser'] as $id){
		edituser($id);
	}
	echo "<input type=\"submit\"></form>";
}

//print_r($users);


?>

