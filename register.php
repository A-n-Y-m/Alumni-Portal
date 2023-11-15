<?php
if (empty($_POST["name"])) 
{
    die("Name is required");
}
if (empty($_POST["id"]))
{
    die("Email is required");
}
                                                                    //as for now validate and sanitize is applied only on "name" textbox
$_POST["name"] = filter_var($_POST["name"], FILTER_SANITIZE_EMAIL); //we sanitize a field to prevent fatal attacks like sql injections
                                                                    //or to prevent a illegal characters to take action in the field
                                                                    //please comment and un-comment this line to see the effects.
if ( ! filter_var ($_POST["id"], FILTER_VALIDATE_EMAIL)) //to validate an email format we use the filter_var function
{                                                        //but it is totally possible to do with regex to customize the validation to 
    die("Valid email is required");                      //our preferences.
}
if (strlen($_POST["pwd"]) < 8) 
{
    die("Password must be at least 8 characters");
}
if ( ! preg_match("/[a-z]/i", $_POST["pwd"])) 
{
    die("Password must contain at least one letter");
}
if ( ! preg_match("/[0-9]/i", $_POST["pwd"])) 
{
    die("Password must contain at least one number");
}
if ($_POST["pwd"] !== $_POST["pwd_cnfrm"]) {
    die("Passwords must match");
}
$password = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) 
{
    $img_name = $_FILES['pp']['name'];
    $tmp_name = $_FILES['pp']['tmp_name'];
    $error = $_FILES['pp']['error'];
    if($error === 0)
    {
       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
       $img_ex_to_lc = strtolower($img_ex);
       $allowed_exs = array('jpg', 'jpeg', 'png', 'gif');
       if(in_array($img_ex_to_lc, $allowed_exs))
       {
          $new_img_name = uniqid($_POST["id"], true).'.'.$img_ex_to_lc;
          $img_upload_path = 'upload/'.$new_img_name;
          move_uploaded_file($tmp_name, $img_upload_path);
       }
    }
}
else
{
    die("Profile Picture Required");
}

$mysqli = require __DIR__ . "/database.php";
$sql = "INSERT INTO user (name, email, type, password, pic) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->stmt_init();
if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}
$stmt->bind_param("sssss", $_POST["name"], $_POST["id"], $_POST["type"], $password, $new_img_name);

try {
    if ($stmt->execute()) 
    {
        header("Location: signup-success.php");
        exit;
    }
} catch (Exception $e) {
    print $e->getMessage();
}
// if ($stmt->execute()) 
// {
//     header("Location: signup-success.html");
//     exit;
// }
// else 
// {
//     if ($mysqli->errno === 1062) 
//     {
//         die("email already taken");
//     } 
//     else 
//     {
//         die($mysqli->error . " " . $mysqli->errno);
//     }
// }