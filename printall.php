<?php

function optionbox(){
	$table .= "	<select name=\"query\">
				<option value=\"edit\">Edit</option>
				<option value=\"delete\">Delete</option>
				<option value=\"checking\">Login/Logout</option>
				<option value=\"logs\">Output Logs</option>
				<option value=\"madmin\">Make Admin</option>
			</select>
			<button name=\"submit\" id=\"submit\">Action</button>";
	return $table;
}



function printall(){
	
	if($_GET['o'] == 'fa'){
		$query = "SELECT * FROM intern ORDER BY fname ASC";
	}elseif($_GET['o'] == 'fd'){
		$query = "SELECT * FROM intern ORDER BY fname DESC";
	}elseif($_GET['o'] == 'la' ){ 
		 $query = "SELECT * FROM intern ORDER BY lname ASC"; //last name ascending
	}elseif($_GET['o'] == 'ld' ){
		$query = "SELECT * FROM intern ORDER BY lname DESC";//last name ascending 
	}elseif($_GET['o'] == 'ba' ){
		$query = "SELECT * FROM intern ORDER BY lname ASC";//barcode ascending
	}elseif($_GET['o'] == 'bd' ){
		$query = "SELECT * FROM intern ORDER BY lname DESC";//barcode descending
	}else{
	$query = "SELECT * FROM intern";
	}
	
	$result = mysql_query($query);
	$num = mysql_num_rows($result);





	//table header
	$table = "<form action=\"susers.php\" method=\"POST\"><table border=\"0\" bordercolor=\"#000099\" style=\"background-color:#FFFFFF\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\">";
$table .=	"<tr>";
$table .=		"<td>First Name</td>";
$table .=		"<td>Last Name</td>";
$table .=		"<td>Barcode</td>";
$table .=		"<td>Picture</td>";
$table .=		"<td>Clocked In</td>";
$table .=		"<td>Action</td>";
$table .=	"</tr>";



	if (isset($result)){
		$color=0;
		$x=0;
		
		for($i =0; $i < $num; ++$i){
			($student[$i] = mysql_fetch_array($result, MYSQL_ASSOC)) or die ("couldnt fetch row");
			//print_r($student[$i]);
			
	
			if($color % 2){

	    		$table .= "<tr><td>" . $student[$x]['fname'] . "</td><td>" . $student[$x]['lname'] . "</td><td>". $student[$x]['barcode'] . "</td><td><img src=\"". $student[$x]['imageurl'] ."\" width=\"100\" height=\"75\"></a></td><td>"; if ($student[$x]['clockedin']) {$table .= "yes";}else{$table .="no";} $table .="</td><td>";
	    		$table .= "<input type=\"checkbox\" name=\"auser[]\" value=\"" . $student[$x]['barcode'] . "\">"; //insert checkbox
	    		$table .= "</td></tr>";
	    		$color++;
			}else{
				$table .= "<tr><td bgcolor=\"#ccccff\">" . $student[$x]['fname'] . "</td><td bgcolor=\"#ccccff\">" . $student[$x]['lname'] . "</td><td bgcolor=\"#ccccff\">". $student[$x]['barcode'] . "</td><td bgcolor=\"#ccccff\"><img src=\"". $student[$x]['imageurl'] ."\" width=\"100\" height=\"75\"></a></td><td bgcolor=\"#ccccff\">"; if ($student[$x]['clockedin']) {$table .= "yes";}else{$table .= "no";} $table .="</td><td bgcolor=\"#ccccff\">";
				$table .= "<input type=\"checkbox\" name=\"auser[]\" value=\"" . $student[$x]['barcode'] . "\">"; //insert checkbox
				$table .= "</td></tr>";
				$color++;
			}
			$x++;
		}
	}
	$table .=optionbox();
	$table .= "</table></form>";
	return $table;
}