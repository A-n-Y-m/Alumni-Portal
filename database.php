<?php

$host = "localhost";
$dbname = "register";
$username = "root";
$passwrd = "";

$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $passwrd,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}
return $mysqli;

?>