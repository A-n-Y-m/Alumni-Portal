<?php
$is_invalid = false;
error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));
    $result = $mysqli->query($sql);
    // print_r($result);
    echo "<br>";
    $user = $result->fetch_assoc();
    // print_r($user);
    $secretKey ="6LdCuA8pAAAAAKNozyz58Die8fHgpHawpFuENAhw";
    $responseKey =$_POST["g-recaptcha-response"];
    $UserIP = $_SERVER["REMOTE_ADDR"];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";
    $response = file_get_contents($url);
    $response = json_decode($response, true);
    // print_r($response);
    if($response["success"] == true)
    {
        if ($user) 
        {
            if (password_verify($_POST["password"], $user["password"])) 
            {
                session_start();
                session_regenerate_id();
                $_SESSION["user_id"] = $user["id"];
                header("Location: home.php");
                exit;
            }
            else
            {
                echo '<script type="text/javascript"> window.onload = function () { alert("Password is Incorrect"); } </script>';
            }
        }
        else
        {
            $is_invalid = true;
        }
    }
    else{
        echo '<script type="text/javascript"> window.onload = function () { alert("Invalid Captcha..."); } </script>';
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sign In</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        
        <main>
            <div class="container p-4 ">
                
                <?php if($is_invalid):
                        echo '<script type="text/javascript"> window.onload = function () { alert("Email not found"); } </script>';
                endif; ?>
                <div class="row">
                    <div class="col-md-6 align-self-start">
                        <img src="images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-4 align-self-end">
                        <h1 class="display-6 p-3">Let's Connect!</h1>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="input-group p-3">
                                <span class="input-group-text">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="input-group p-3">
                                <span class="input-group-text">Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="g-recaptcha" data-sitekey="6LdCuA8pAAAAAGa6vpbIycgRBFB4TUUCYu28b4x5"></div>
                            </div>
                            <div class="row justify-content-between p-3">
                                <div class="col">
                                    <input type="submit" class="form-control btn btn-dark" id="sub" value="Submit">
                                </div>
                                <div class="col">
                                    <a href="signup.php"><button class="form-control btn btn-dark">Register</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>