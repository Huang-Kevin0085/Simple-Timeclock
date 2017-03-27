<?php
unset($_SESSION['uid']);
unset($_SESSION['admin']);



include 'heading.html';
include 'style.css'; //doesnt exist.

?>
<html><head>

<script language="javascript">
  function toggle_it(itemID){
      // Toggle visibility between none and inline
      if ((document.getElementById(itemID).style.display == 'none')){
        document.getElementById(itemID).style.display = 'inline';
      } else {
        document.getElementById(itemID).style.display = 'none';
      }
  }
</script> 

</head><body>
<div id="everything">
<center><img src="images/hunterlogo.jpg" width="35%"></center>
<div id="login">
	<form action="in.php" method="post">
	<table>
		<tr>
			<td><input type="text" id="id" name="id"></td>
			<td><button name="submit" id="submit">Login/Logout</button></td>
		</tr>
	</table>
	</form>
</div>
<script type="text/javascript" language="javascript"> document.getElementById("id").focus(); </script>
<a href="#" onClick="toggle_it('nuser')">New User</a>
<div id="nuser" style="display: none;">
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

</div>

</body>

<footer>
	<p>
		<a href="http://localhost:8888/attendance-new/secure_weekly.php">Weekly Report</a>
	</p>
	<p>
		<a href="http://localhost:8888/attendance-new/secure_total.php">Total Timesheet</a>
	</p>
</footer>

</html>

