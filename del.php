<?php

include 'sql_open_conn.php';


function delete(){
	if (isset($_GET['u'])){
		$query = "DELETE FROM intern WHERE barcode=" . $_GET['u'];	
		mysql_query($query) or die ("Was unable to delete userID " . $_GET['u']);
	}
}
if (isset($_POST['submit'])){
	echo "sUBMITTED<br />";
}else{
	echo "LOZER<br />";
}
echo "POST ";
print_r($_POST);
echo "<br />GET ";
print_r ($_GET);
?>

<html><body><h3>Are you sure?</h3><form action="del.php" method="POST">
<input type="button" name="submit" value="Submit">
</form>
</body></html>