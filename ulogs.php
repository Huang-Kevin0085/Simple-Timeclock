<?php 
//////////ulogs.php

function ulogs($u){
	for ($i=0; $i < sizeOf($u); ++$i){
		$query = "SELECT fname, lname, barcode, timelog FROM intern WHERE barcode=$u[$i]";
		$result = mysql_query($query);
		$row = mysql_fetch_row($result);
		$ausers[]  = $row;
	}
	
	/////////////////////////////
	// Format of $ausers[$x][$y]
	// $ausers[$x][0] = fname
	// $ausers[$x][1] = lname
	// $ausers[$x][2] = barcode
	// $ausers[$x][3] = timelog
	/////////////////////////////
	
	//convert $auseres[$x][3] (timelog) into an array of ins and outs
		//REGEX EXPRESSION TO BREAK UP TIMELOG INTO IN & OUT AND PRINT
		preg_match_all("/(in:).*'(.*)'/" , $ausers[0][3] , $tin, PREG_PATTERN_ORDER);
		preg_match_all("/(out:).*'(.*)'/", $ausers[0][3], $tout, PREG_PATTERN_ORDER);
		
		//Remove in's outs and single quotes
		for($z =0; $z < sizeOf($tin[0]); ++$z){
			$tin[0][$z] = preg_replace('/^in:/', '', $tin[0][$z]);
			$tin[0][$z] = preg_replace("/'/" , ''	, $tin[0][$z]);
		}
		
		for($a =0; $a < sizeOf($tout[0]); ++$a){
			$tout[0][$a] = preg_replace('/^out:/', '', $tout[0][$a]);
			$tout[0][$a] = preg_replace("/'/" , ''	, $tout[0][$a]);
		}
		//
		
		
		/* print_r($tin[0]);	//|
		echo "<br />";			//|DEBUGS
		print_r($tout[0]); */	//|	

		//return an array with both ins and outs.
		$ret[] = $tin[0];
		$ret[] = $tout[0];
		return $ret;

}
	

?>