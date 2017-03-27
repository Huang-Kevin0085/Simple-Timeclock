<?

include 'sql_open_conn.php';


//PUT THINGS HERE

 $gtime = date("Y\-m\-d h\:i\:s A");
 $ctime = date("Y\-m\-d G\:i\:s"); //current time of most recent logout/login


function popup($vMsg,$vDestination) { //presents a javascript alert with a message and takes them to a destination
  echo("<html>\n");
  echo("<head>\n");
  echo("<title>System Message</title>\n");
  echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n");

  echo("<script type=\"text/javascript\">\n");
    echo("alert('$vMsg');\n");
    //echo("window.location = ('$vDestination');\n");
    echo("location.replace('$vDestination');\n");
    //echo("window.close();\n");
  echo("</script>\n");
  echo("</head>\n");

  echo("<body>\n");
  echo("</body>\n");
  echo("</html>\n");

  exit;

}

function home(){
	 echo("<html>\n");
  echo("<head>\n");
  
  echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n");

  echo("<script type=\"text/javascript\">\n");
   
    echo("location.replace(\"index.php\");\n");
  
  echo("</script>\n");
  echo("</head>\n");

  echo("<body>\n");
  echo("</body>\n");
  echo("</html>\n");

  exit;

}
function signin($student, $gtime, $ctime){
	//echo $student['fname'] . " you are being signed in.<br/>";
   	$query="UPDATE intern SET clockedin=1 WHERE barcode='$_POST[StudentID]'";
	mysql_query($query) or die ("Couldnt log in student");
	$query="UPDATE intern SET timelog=concat(\"in: '$gtime'\n\", timelog) WHERE barcode='$student[id]'";
	mysql_query($query) or die ("Couldnt update time table.<br/>");
	$query="UPDATE intern SET ctime='$ctime' WHERE barcode='$student[id]'";
	mysql_query($query) or die ("Couldnt set ctime.<br/>");
	
	//get image of user
	grabimage($student);
	
}

function signout($student, $gtime, $ctime){
	echo $student['fname'] ." you are being signed out.<br/>";
	$query="UPDATE intern SET clockedin=0 WHERE barcode='$student[id]'";
	mysql_query($query) or die ("Couldnt log out student");
	$query="UPDATE intern SET timelog=concat(\"out:'$gtime'\n\", timelog) WHERE barcode='$student[id]'";
	mysql_query($query) or die ("Couldnt update time table.<br/>");
	$query="UPDATE intern SET ctime='$ctime' WHERE barcode='$student[id]'";
	mysql_query($query) or die ("Couldnt set ctime.<br/>");
	echo "<p>Seems like there were no problems, have a great day!</p>";
	
	
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

function adminopt(){
	echo "Click to continue<br />";
		popup("Logged in","admin.php");
}

$query ="SELECT * FROM intern WHERE barcode='$_POST[StudentID]'";
if($result =  mysql_query($query)){
	if($row = mysql_fetch_row($result)){
		$student['fname']=$row[0];
		$student['lname']=$row[1];
    	$student['id']=$row[2];
    	$student['ctime']=$row[3];
    	$student['in']=$row[4];
    	$student['pic']=$row[7];
    	$student['admin']=$row[8];
    	$cutime = time(); //get unix time stamp for current time.
    	
        	
    	$lutime = mktime(substr($student['ctime'], 11,2), substr($student['ctime'], 14,2),substr($student['ctime'],17,2), substr($student['ctime'],5,2), substr($student['ctime'], 8,2), substr($student['ctime'],0,4)); //last login/out action unix time
    	$cudiff = $cutime - $lutime; //difference between the two times.
    	//print "Current Hour: " . $cutime . "<br/>" . "Last Hour: " . $lutime . "<br/>Difference in unixtime is: " . $cudiff . "<br />";  //unix time debug line
    	
		if($student['admin'] == "1"){
			adminopt();
		}else{
	    	if($student['in'] == "1"){ //if they;re already signed in.
	    		echo "You are currently signed in<br/>";
	    		if($cudiff > 43200){ // for more than 12 hours
	    			echo "WARNING: You are attempting to sign in when you havnt signed out for at least 12 hours.<br/>
	    			You are being signed out and back in.<br/>
	    			Please remember to sign out in the future.<br/>";
	    			
	    			signout($student, $gtime, $ctime); //sign them out
	    			signin($student, $gtime, $ctime); // then back in
	    			popup("Logged out and back in, please remember to logout next time", "index.php");
	    		}else{ 
					signout($student, $gtime, $ctime); // else, just sign out.
					popup("Logged out", "index.php");
	    		} 
	    	}
		
		   	if($student['in'] == "0"){ //if not signed in
				signin($student, $gtime, $ctime); //sign them in!
				popup("Logged in", "index.php");
			}
		}		
  	}else {
		//echo "User doesnt exist. Returning to main page.";
		 popup("User Doesnt exist", "index.php");
		
	}
}


//close connection
mysql_close($handler);





//<html><head><META  HTTP-EQUIV="Refresh" CONTENT="2; URL=index.php"></head></html>

?>
