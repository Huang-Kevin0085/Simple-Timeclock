<?php
$user = $_POST['user'];
$pass = $_POST['pass'];

if($user == "admin"
&& $pass == "GGRO??bar")
{
        include("total.php");
}
else
{
    if(isset($_POST))
    {?>
            <form method="POST" action="secure_total.php">
            User <input type="text" name="user"></input><br/>
            Pass <input type="password" name="pass"></input><br/>
            <input type="submit" name="submit" value="Go"></input>
            </form>
    <?}
}

?>
