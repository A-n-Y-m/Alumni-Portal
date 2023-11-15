<!DOCTYPE html>
<html>
<head>
    <title>Signup_Success</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1>Signup</h1>
    
    <p>Signup successful.
    <?php
        print "<br>Redirecting to Home Page...<br>";
        header( "refresh:4;url=home.php" );
    ?>
    <img style="width: 6rem;" src="images/reload.gif" alt="">
</body>
</html>