<?php

	function edituser($id){
		$query = "SELECT fname, lname, barcode, clockedin FROM intern WHERE barcode=$id";
		$result = mysql_query($query);
		$num = mysql_num_rows($result);
		echo "<form action =\"euseraction.php\" method=\"GET\">";
		
		for ($i=0; $i < $num; $i++ ){
			$row = mysql_fetch_row($result);
			echo "$i : <input type=\"text\" name=\"fname[]\" value=\"$row[0]\" />" .
			     "   " . 
			     "<input type=\"text\" name=\"lname[]\" value=\"$row[1]\" />" .
			     "   " .
			     "<input type=\"text\" name=\"barcode[]\" value=\"$row[2]\" readonly />";
			if ($row[3] == '1'){
				echo "<input type=\"radio\" name=\"checked[$i]\" value=\"In\" checked> In 
				      <input type=\"radio\" name=\"checked[$i]\" value=\"out\" > Out";
			}else{
				echo "<input type=\"radio\" name=\"checked[$i]\" value=\"In\" > In 
				      <input type=\"radio\" name=\"checked[$i]\" value=\"out\" checked> Out";
			}
		
			echo "<br />";
		
		}
	}
	
?>