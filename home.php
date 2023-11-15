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
    <title>Home</title>
    <script src="https://kit.fontawesome.com/6f67d33e86.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header class="p-3  border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="home.php" class="nav-link px-2 link-secondary">Home</a></li>
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
                        <?php if (isset($_SESSION["user_id"]) && $user["type"] != "staff") { ?>
                            <li><a class="dropdown-item disabled" href="login.php">Sign in</a></li>
                            <li><a class="dropdown-item" href="pedit1.php">Settings</a></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        <?php } elseif ($user["type"] == "staff") { ?>
                            <li><a class="dropdown-item disabled" href="login.php">Sign in</a></li>
                            <li><a class="dropdown-item disabled" href="pedit1.php">Settings</a></li>
                            <li><a class="dropdown-item disabled" href="profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        <?php } else { ?>
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
        <div class="container p-4 col-4">
            <h1 class="display-3">Alumni Portal</h1>
            <p>Welcome to our spectacular Alumni Webpage where memories never fade and connections never end! Join us in embracing
                the most exhilarating moments from the past while crafting exciting new ones with fellow alumni.</p>
            <form action="signup.php" method="post" id="signup" novalidate enctype="multipart/form-data">
                <div class="form-group row">
                    <!-- <label for="signup" class="col-sm-2 col-form-label">Signup</label> -->
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="su" placeholder="Email">
                    </div>
                    <input type="submit" value="Sign Up" class="btn btn-dark col-sm-2">
                </div>
            </form>
        </div>
        <div class="container p-4">
            <div class="row justify-content-between">
                <div class="col p-4">
                    <div class="container">
                        <img class="object-fit-fill border rounded" width="300px" height="200px" src="images/reunion.jpg">
                        <h1 class="display-6 pt-2">Reunion</h1>
                        <p>Celebrate old times and make precious new memories with friends and classmates.</p>
                    </div>
                </div>
                <div class="col p-4">
                    <div class="container">
                        <img class="object-fit-fill border rounded" width="300px" height="200px" src="images/community.avif">
                        <h1 class="display-6 pt-2">Community</h1>
                        <p>Connect with people who share the same interests.</p>
                    </div>
                </div>
                <div class="col p-4">
                    <div class="container">
                        <img class="object-fit-fill border rounded" width="300px" height="200px" src="images/mentoring.avif">
                        <h1 class="display-6 pt-2">Mentorship</h1>
                        <p>Empower the next generation through valuable guidance and advice from your wisdom.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="container-fluid">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <!-- <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a> -->
                <span class="mb-3 mb-md-0 text-muted">© 2023 </span>
            </div>
            <p>Made with ❤️ by Aakash Gowala</p>
            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <p>Connect with me on:</p>
                <li class="ms-3"><a class="text-muted" href="https://www.linkedin.com/in/aakash-gowala-3b60bb1b4/"><i class="fa-brands fa-linkedin"></i></a></li>
                <li class="ms-3"><a class="text-muted" href="https://github.com/A-n-Y-m"><i class="fa-brands fa-github"></i></a></li>
            </ul>
        </footer>
    </div>
</body>

</html>