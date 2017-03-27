<?php
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
	function admin(){
	  echo("<html>\n");
	  echo("<head>\n");
	  echo("<title>System Message</title>\n");
	  echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n");
	
	  echo("<script type=\"text/javascript\">\n");
	  echo("location.replace('admin.php');\n");
	  echo("</script>\n");
	  echo("</head>\n");
	
	  echo("<body>\n");
	  echo("</body>\n");
	  echo("</html>\n");
	}
?>