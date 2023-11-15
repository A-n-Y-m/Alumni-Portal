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
$sql1 = "select * from info where id={$_SESSION['user_id']}";
$f = false;
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Alumni</title>
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
                    <li><a href="alumni.php" class="nav-link px-2 link-secondary">Alumni</a></li>
                    <li><a href="gallery.php" class="nav-link px-2 link-body-emphasis">Gallery</a></li>
                </ul>
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
            <form action="alumni.php" method="post">
                <div class="row justify-content-end">
                    <div class="col-3">
                        <input type="search" name="sr" class="form-control" placeholder="Search..." aria-label="Search">
                    </div>
                    <div class="col-2">
                        <button type="submit" name="go" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
            <h1 class="display-6 pt-3">The search results are...</h1>
            <hr class="hr" />
            <div class="row card-deck">
                <?php
                if (!empty($_POST)) {
                    $src = $_POST['sr'];
                    $sql1 = "select * from info where fnm like '{$src}' or lnm like '{$src}' or year like '{$src}' or dept like '{$src}' or company like '{$src}' ";
                    $result = mysqli_query($mysqli, $sql1);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $f = true;
                ?>
                        <div class="col-6 p-4">
                            <div class="card text-black bg-light col-7 px-2 py-2">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-3">
                                            <?php
                                                $sql2="select * from user where id='{$row['id']}'";
                                                $result2 = mysqli_query($mysqli, $sql2);
                                                $row2 = mysqli_fetch_assoc($result2);
                                            ?>
                                            <img src="upload/<?=$row2['pic']?>" alt="mdo" width="60" height="60" class="rounded-circle">
                                        </div>
                                        <div class="col-9">
                                            <p class="ps-2"><?= $row["about_me"] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title"><?= $row["fnm"] ?> <?= $row["lnm"] ?></h5>
                                            <i class="fa-regular fa-building"></i>&nbsp;&nbsp;&nbsp;<?= $row["dept"] ?><br>
                                            <i class="fa-solid fa-graduation-cap"></i>&nbsp;&nbsp;<?= $row["year"] ?><br>
                                            <?php
                                            if (!empty($row["company"])) {
                                            ?>
                                                <i class="fa-solid fa-briefcase"></i>&nbsp;&nbsp;<?= $row["company"] ?> (<?= $row["exp"] ?>)<br>
                                            <?php
                                            }
                                            ?>
                                            <i class="fa-solid fa-phone"></i>&nbsp;&nbsp;<?= $row["ph_no"] ?><br>
                                            <i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;<?= $row["email"] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                    if (!$f) {
                        echo "<p>No results were found..</p>";
                    }
                }
                elseif (!isset($_SESSION["user_id"])) {
                    echo "<p>You need to login first in order to use the search</p>";
                }
                else
                {
                    echo "<p>Use the search bar to connect with the desired person</p>";
                }
                ?>
            </div>
        </div>
    </main>
</body>

</html>