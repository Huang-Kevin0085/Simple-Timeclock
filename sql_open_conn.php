<? 
$dbserver="localhost";
$dbuser="root";
$dbpass="root";
$dbbase="attendance";

$handler= mysql_connect($dbserver, $dbuser, $dbpass) or die("Couldnt connect to sql_server [".$dbserver."]");

mysql_select_db($dbbase, $handler) or die ("Couldnt open database" .$dbbase);
?>