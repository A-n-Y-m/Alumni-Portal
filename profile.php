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
$sql1="select * from info where id={$_SESSION['user_id']}";
$result1 = mysqli_query($mysqli, $sql1);
$info = $result1->fetch_assoc();
if($info=="") {
    print("First Complete Your Profile");
    print "<br>Redirecting to Home Page...<br>";
    header( "refresh:5;url=home.php" );
?>
<img style="width: 6rem;" src="images/reload.gif" alt="">
<?php
exit;
}
else{
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
    <script src="https://kit.fontawesome.com/6f67d33e86.js" crossorigin="anonymous"></script>
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
    <main>
        <div class="container p-4">
            <div class="row">
                <div class="col-6">
                    <img src="<?= $imgadd ?>" alt="mdo" width="90" height="90" class="rounded-circle">
                    <h1 class="display-6 pt-2">About Me</h1>
                    <form action="profile.php" method="post" id="abt_me" novalidate enctype="multipart/form-data">
                        <div class="form-group row p-2">
                            <div class="col-sm-7">
                                <textarea class="form-control" name="abt" rows="2"></textarea>
                            </div>
                            <input name="sub" type="submit" class="btn btn-dark col-sm-2 pt-6" value="Save">
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <h1 class="display-6 pt-2">Preview</h1>
                    <div class="card text-black bg-light col-7 px-2 py-2">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3">
                                    <img src="<?= $imgadd ?>" alt="mdo" width="60" height="60" class="rounded-circle">
                                </div>
                                <?php 
                                if(isset($_POST['abt'])) { 
                                    $sql2="update info set about_me='{$_POST["abt"]}' where id={$_SESSION['user_id']}";
                                    $mysqli->query($sql2);
                                    $result1 = mysqli_query($mysqli, $sql1);
                                    $info = $result1->fetch_assoc();
                                    // print_r($_POST);
                                }
                                ?>
                                <div class="col-9">
                                    <p class="ps-2"><?=$info["about_me"] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title"><?=$info["fnm"]?> <?=$info["lnm"]?></h5>
                                    <i class="fa-regular fa-building"></i>&nbsp;&nbsp;&nbsp;<?=$info["dept"]?><br>
                                    <i class="fa-solid fa-graduation-cap"></i>&nbsp;&nbsp;<?=$info["year"]?><br>
                                    <?php 
                                        if(!empty($info["company"]))
                                        {
                                    ?>
                                        <i class="fa-solid fa-briefcase"></i>&nbsp;&nbsp;<?=$info["company"]?> (<?=$info["exp"]?>)<br>
                                    <?php
                                        }
                                    ?>
                                    <i class="fa-solid fa-phone"></i>&nbsp;&nbsp;<?=$info["ph_no"]?><br>
                                    <i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;<?=$info["email"]?>
                                </div>
                                <div class="col-2">
                                    <a href="pedit1.php" class="btn btn-dark">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
<?php }?>