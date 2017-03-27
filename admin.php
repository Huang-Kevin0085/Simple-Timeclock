<?php
session_start();
include "sql_open_conn.php";
//include "admin_header.php";
include "printall.php";

	//admin test
	if (!(isset($_SESSION['admin']) && ($_SESSION['admin'] == 1 ))) {
		echo "You do not have permissions to access this page.<br />Returning to main page.";
		print ("<html><head><META  HTTP-EQUIV=\"Refresh\" CONTENT=\"3; URL=index.php\"></head></html>");
	}
	
	
	$table = printall();
	
?>

<html><head> <? include 'style.css'; ?>

<script language="javascript">
  function toggle(itemID){
      // Toggle visibility between none and inline
      if ((document.getElementById(itemID).style.display == 'none')){
        document.getElementById(itemID).style.display = '';
      } else {
        document.getElementById(itemID).style.display = 'none';
      }
  }
</script> 
</head><body>
<div id="everything"> <center>
<a href="#" onclick="toggle('printall')">Print All</a>
<a href="#" onclick="toggle('users')">Print selected users</a>
<a href="#" onclick="toggle('nuser')">New User</a>
</center><p></p>

<!-- PHP PRINT ALL TABLE -->
<center><div id="printall" style="display:none;">
<? print "$table"; ?>
</div>
</center>


<div id="nuser" style="display:none;">
<form action="new_user.php" method="post">
<table>
	<tr>
		<td>First Name:</td>
		<td><input type="text" id="fname" name="fname" size=22></td>
	</tr>
	<tr>
		<td>Last Name:</td>
		<td><input type="text" id="lname" name="lname" size=22></td>
	</tr>
	<tr>
		<td>Comments:</td>
		<td><textarea rows="3" columns="6" id="comments" name="comments"></textarea></td>
	</tr>
	<tr>
		<td>Barcode:</td>
		<td><input type="text" id="barcode" name="barcode" size=22></td>
	</tr>
	<tr>
		<td><input type="submit"></td>
	</tr>
	</table>
</form>
</div>

<div id="users" style="display:none;">
<? echo "p_users();"; ?>
</div>


</div> <!-- everything div -->
</body></html>