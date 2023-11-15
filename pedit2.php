<?php
session_start();
$db = require __DIR__ . '/database.php';
$uname = $_POST["uname"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mid = $_POST["eid"];
$dep = $_POST["dep"];
$mno = $_POST["mno"];
$yr = $_POST["yr"];
$cmp = $_POST["cmp"];
$exp = $_POST["exp"];
if (empty($uname)) 
{
    print "<br>Redirecting to Profile Edit Page...<br>";
    header( "refresh:5;url=pedit1.php" );
    die("UserName is required");
}
if (empty($fname)) 
{
    print "<br>Redirecting to Profile Edit Page...<br>";
    header( "refresh:5;url=pedit1.php" );
    die("First Name is required");
}
if (empty($lname)) 
{
    print "<br>Redirecting to Profile Edit Page...<br>";
    header( "refresh:5;url=pedit1.php" );
    die("Last Name is required");
}
if (empty($mid)) 
{
    print "<br>Redirecting to Profile Edit Page...<br>";
    header( "refresh:5;url=pedit1.php" );
    die("Email is required");
}
if (empty($dep)) 
{
    print "<br>Redirecting to Profile Edit Page...<br>";
    header( "refresh:5;url=pedit1.php" );
    die("Department is required");
}
if (empty($mno)) 
{
    print "<br>Redirecting to Profile Edit Page...<br>";
    header( "refresh:5;url=pedit1.php" );
    die("Mobile is required");
}
if (empty($yr)) 
{
    print "<br>Redirecting to Profile Edit Page...<br>";
    header( "refresh:5;url=pedit1.php" );
    die("Graduation Year is required");
}
$sql1 = "update info set uname='{$uname}', fnm='{$fname}', lnm='{$lname}', company='{$cmp}', email='{$mid}', dept='{$dep}', exp='{$exp}', year={$yr}, ph_no='{$mno}' where id={$_SESSION["user_id"]}";
$sql2 = "update user set name='{$uname}', email='{$mid}' where id={$_SESSION["user_id"]}";
try {
    $mysqli->query($sql2);
    $mysqli->query($sql1);
} catch (Exception $e) {
    print $e->getMessage();
    print "<br>Changes not Saved : Recheck your Inputs<br>";
    print "<br>Redirecting to Home Page...<br>";
    header( "refresh:5;url=home.php" );
    exit;
}

$sql_u = "select * from user where id={$_SESSION["user_id"]}";
$r1 = mysqli_query($db, $sql_u);
$user = $r1->fetch_assoc();
$old_pp_des = "upload/" . $user["pic"];
if (isset($_FILES['npp']['name']) and !empty($_FILES['npp']['name'])) {
    $img_name = $_FILES['npp']['name'];
    $tmp_name = $_FILES['npp']['tmp_name'];
    $error = $_FILES['npp']['error'];
    if ($error === 0) {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

        $img_ex_to_lc = strtolower($img_ex);
        $allowed_exs = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = uniqid($mid, true) . '.' . $img_ex_to_lc;
            // print_r($new_img_name);
            $img_upload_path = 'upload/' . $new_img_name;
            if (unlink($old_pp_des)) {
                move_uploaded_file($tmp_name, $img_upload_path);
            } else {
                move_uploaded_file($tmp_name, $img_upload_path);
            }
        } else {
            $em = "You can't upload files of this type";
            print "<br>Redirecting to Home Page...<br>";
            header( "refresh:5;url=home.php" );
            exit;
        }
    }
    $sql3 = "update user set pic='{$new_img_name}' where id={$_SESSION["user_id"]}";
    if ($mysqli->query($sql3) == TRUE) {
        print "<br>Your account has been updated successfully<br>";
        print "<br>Redirecting to Home Page...<br>";
        header( "refresh:5;url=home.php" );
        exit;
    } else {
    $mysqli->error;
    }
}
else{
    print "<br>Your account has been updated successfully<br>";
    print "<br>Redirecting to Home Page...<br>";
    header( "refresh:5;url=home.php" );
    exit;
}
?>
<img style="width: 6rem;" src="images/reload.gif" alt="">