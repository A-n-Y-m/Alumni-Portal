<?php
session_start();
error_reporting(0);
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
$d1=date("Y-m-d");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Events</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            <h1 class="display-6">Upcoming Events</h1>
            <div class="row card-deck">
                <?php
                $r1 = mysqli_query($mysqli, $sql1);
                while($r2=$r1->fetch_assoc()) {
                    $d2=$r2['date'];
                    if($d2>$d1){
                ?>
                <div class="col-4 pt-3 px-3">
                    <div class="card text-black bg-light px-2">
                        <div class="card-header">
                            <form action="event-edit.php" method="post" enctype="multipart/form-data">
                                <button type="submit" name="del" class="btn btn-dark float-end" value="<?=$r2['id']?>"><i class="fa-solid fa-trash "></i></button>
                            </form>
                            <img class="img-fluid pt-2" src="event-upload/<?=$r2['img']?>"  alt="">
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-11">
                                    <h5 class="card-title"><?=$r2["title"]?></h5>
                                    <i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;&nbsp;<?=$r2["loc"]?><br>
                                    <i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;<?=$r2["date"]?><br>
                                    <i class="fa-solid fa-clock"></i>&nbsp;&nbsp;<?=$r2["time"]?><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                $r1->free();
                ?>
            </div>
        </div>
        <div class="container p-4">
            <h1 class="display-6">Past Events</h1>
            <div class="row card-deck">
                <?php
                $r1 = mysqli_query($mysqli, $sql1);
                while($r2=$r1->fetch_assoc()) {
                    $d2=$r2['date'];
                    if($d2<$d1){
                ?>
                <div class="col-4 pt-3 px-3">
                    <div class="card text-black bg-light px-2">
                        <div class="card-header">
                            <form action="event-edit.php" method="post" enctype="multipart/form-data">
                                <button type="submit" name="del" class="btn btn-dark float-end" value="<?=$r2['id']?>"><i class="fa-solid fa-trash "></i></button>
                            </form>
                            <img class="img-fluid pt-2" src="event-upload/<?=$r2['img']?>"  alt="">
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-11">
                                    <h5 class="card-title"><?=$r2["title"]?></h5>
                                    <i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;&nbsp;<?=$r2["loc"]?><br>
                                    <i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;<?=$r2["date"]?><br>
                                    <i class="fa-solid fa-clock"></i>&nbsp;&nbsp;<?=$r2["time"]?><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                $r1->free();
                ?>
            </div>
        </div>
        <?php
        if(isset($_POST) && !empty( $_POST))
        {
            $sql1 = "delete from events where id={$_POST['del']}";
            $sql2 = "select img from events where id={$_POST['del']}";
            $result=mysqli_query($mysqli, $sql2);
            $ec=$result->fetch_assoc();
            print_r($ec);
            unlink("event-upload/{$ec['img']}");
            mysqli_query($mysqli, $sql1); 
        }
        ?>
    </main>
</body>
</html>