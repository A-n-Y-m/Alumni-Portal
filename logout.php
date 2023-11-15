<?php
session_start();
session_destroy();

print("Successfully Logged Out");
print "<br>Redirecting to Home Page...<br>";
header( "refresh:5;url=home.php" );
?>
<img src="images/reload.gif" height="80px" width="80px" alt="">