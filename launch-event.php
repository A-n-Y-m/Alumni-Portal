<?php
session_start();
error_reporting(0);
if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . '/database.php';
    $sql = "select * from user where id={$_SESSION["user_id"]}";
    $result = mysqli_query($mysqli, $sql);
    $user = $result->fetch_assoc();
    $imgadd = "upload/" . $user["pic"];
} else {
    $imgadd = "images/user.jpg";
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Launch Event</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <header class="p-3  border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="home.php" class="nav-link px-2 link-body-emphasis">Home</a></li>
                    <li><a href="events.php" class="nav-link px-2 link-body-emphasis">Events</a></li>
                    <li><a href="alumni.php" class="nav-link px-2 link-body-emphasis">Alumni</a></li>
                    <li><a href="gallery.php" class="nav-link px-2 link-body-emphasis">Gallery</a></li>
                </ul>
                <!-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form> -->
                <div class="dropdown ">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= $imgadd ?>" alt="mdo" width="40" height="40" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small">
                        <?php if (isset($_SESSION["user_id"]) && $user["type"]!="staff") { ?>
                            <li><a class="dropdown-item disabled" href="login.php">Sign in</a></li>
                            <li><a class="dropdown-item" href="pedit1.php">Settings</a></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        <?php } elseif ($user["type"]=="staff") { ?>
                            <li><a class="dropdown-item disabled" href="login.php">Sign in</a></li>
                            <li><a class="dropdown-item disabled" href="pedit1.php">Settings</a></li>
                            <li><a class="dropdown-item disabled" href="profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        <?php }else { ?>
                            <li><a class="dropdown-item" href="login.php">Sign in</a></li>
                            <li><a class="dropdown-item disabled" href="pedit1.php">Settings</a></li>
                            <li><a class="dropdown-item disabled" href="profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item disabled" href="logout.php">Sign out</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <?php
    if ($user["type"] == "staff") {
    ?>
        <main>
            <div class="container col-4 p-4">
                <h1 class="display-6 p-3">Launch Event!</h1>
                <form action="launch-event.php" method="post" enctype="multipart/form-data">
                    <div class="input-group p-3">
                        <span class="input-group-text">Title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="text" name="loc" class="form-control">
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="date" name="dt" class="form-control">
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="time" name="tm" class="form-control">
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Description&nbsp;&nbsp;&nbsp;</span>
                        <textarea name="des" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Cover Picture</span>
                        <input type="file" name="cp" class="form-control">
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <input type="submit" class="form-control btn btn-dark" id="sub" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </main>
    <?php
    } else {
        print "<br>Let's leave editing event to the staff members<br>";
        print "<br>Redirecting to Events Page...<br>";
        header("refresh:5;url=events.php");
        exit;
    }
    if (isset($_FILES['cp']['name']) AND !empty($_FILES['cp']['name'])) 
    {
        $img_name = $_FILES["cp"]["name"];
        $tmp_name = $_FILES['cp']['tmp_name'];
        $error = $_FILES['cp']['error'];
        if ($_POST["title"] == "") {
            echo '<script type="text/javascript"> window.onload = function () { alert("Title is Required"); } </script>';
        } elseif ($_POST["loc"] == "") {
            echo '<script type="text/javascript"> window.onload = function () { alert("Location is Required"); } </script>';
        } elseif ($_POST["dt"] == "") {
            echo '<script type="text/javascript"> window.onload = function () { alert("Date is Required"); } </script>';
        } elseif ($_POST["tm"] == "") {
            echo '<script type="text/javascript"> window.onload = function () { alert("Time is Required"); } </script>';
        } elseif(isset($_POST["title"]) and !empty($_POST["title"])) {
            $desc = mysqli_escape_string($mysqli, $_POST['des']);
            $_POST["title"] = mysqli_escape_string($mysqli, $_POST['title']);
            $_POST['loc'] = mysqli_escape_string($mysqli,$_POST['loc']);
            $sql = "insert into events(title, loc, date, time, desp, img) values ('{$_POST["title"]}', '{$_POST["loc"]}', '{$_POST["dt"]}', '{$_POST["tm"]}', '{$desc}', '{$img_name}') ";
            if ($mysqli->query($sql) == TRUE) {
                echo '<script type="text/javascript"> window.onload = function () { alert("Successfully Launched"); } </script>';
            } else {
                echo $mysqli->error;
                header("refresh:5;url=events.php");
                exit;
            }
        }
        if($error === 0)
        {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);
            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs))
            {
                $img_upload_path = 'event-upload/'.$img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            }
        }
    }
    else
    {
        die("Cover Picture Required");
    }
    ?>
</body>

</html>