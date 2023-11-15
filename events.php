<?php
session_start();
// error_reporting(0);
$mysqli = require __DIR__ . '/database.php';
if (isset($_SESSION["user_id"])) {
    $sql = "select * from user where id={$_SESSION["user_id"]}";
    $result = mysqli_query($mysqli, $sql);
    $user = $result->fetch_assoc();
    $imgadd = "upload/" . $user["pic"];
} else {
    $imgadd = "images/user.jpg";
}
$sql1="select * from events";
$c=true;
$a='<div class="carousel-item active" data-bs-interval="2000">';
$b='<div class="carousel-item" data-bs-interval="2000">';
$d1=date("Y-m-d");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Events</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header class="p-3  border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="home.php" class="nav-link px-2 link-body-emphasis">Home</a></li>
                    <li><a href="events.php" class="nav-link px-2 link-secondary">Events</a></li>
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
            <?php
            error_reporting(0);
            if ($user["type"] == "staff") {
            ?>
                <div class="col">
                    <a href="launch-event.php"><button class="btn btn-dark col-2">Launch</button></a>
                </div>
                <div class="col pt-3">
                    <a href="event-edit.php"><button class="btn btn-dark col-2">Edit</button></a>
                </div>
            <?php 
            }
            ?>
            <!-- </div> -->
        </div>
        <div class="container p-4">
            <div class="row justify-content-around">
                <div class="col-6">
                    <h1 class="display-6">Upcoming Events</h1>
                    <div id="c1" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $e1=mysqli_query($mysqli, $sql1); 
                            while($e2=$e1->fetch_assoc())
                            {
                                $d2=$e2['date'];
                                if($d2>$d1)
                                {
                                    if($c==true)
                                    {
                                        echo"".$a;
                                        $c=false;
                                    }
                                    else
                                    {
                                        echo"".$b;
                                    }
                            ?>
                                    <img src="event-upload/<?=$e2['img']?>" class="d-block w-100" height="400px" alt="">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 class="display-6"><?=$e2['title'] ?></h5>
                                        <p>loc : <?=$e2['loc'] ?> Date : <?=$e2['date'] ?></p>
                                        <p>Time : <?=$e2['time'] ?></p><br>
                                        <p><?=$e2['desp'] ?></p>
                                    </div>
                                </div>
                            <?php 
                                }
                            }
                            $c=true; 
                            $e1->free();
                            ?>
                        </div>
                    </div>    
                </div>
                <div class="col-6">
                    <h1 class="display-6">Past Events</h1>
                    <div id="c1" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $e1=mysqli_query($mysqli, $sql1); 
                            while($e2=$e1->fetch_assoc())
                            {
                                $d2=$e2['date'];
                                if($d2<$d1)
                                {
                                    if($c==true)
                                    {
                                        echo"".$a;
                                        $c=false;
                                    }
                                    else
                                    {
                                        echo"".$b;
                                    }
                            ?>
                                    <img src="event-upload/<?=$e2['img']?>" class="d-block w-100" height="400px" alt="">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 class="display-6"><?=$e2['title'] ?></h5>
                                        <p>loc : <?=$e2['loc'] ?> Date : <?=$e2['date'] ?></p>
                                        <p>Time : <?=$e2['time'] ?></p><br>
                                        <p><?=$e2['desp'] ?></p>
                                    </div>
                                </div>
                            <?php 
                                }
                            }
                            $c=true; 
                            $e1->free();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>