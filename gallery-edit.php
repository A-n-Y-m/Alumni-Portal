<?php
session_start();
// error_reporting(0);
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
    <title>Gallery Edit</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/home.css"> -->
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
                <h1 class="display-6 p-4">Post Collage</h1>
                <form action="gallery-edit.php" method="post" enctype="multipart/form-data">
                    <div class="input-group p-3">
                        <span class="input-group-text">Title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Picture 1</span>
                        <input type="file" name="p1" class="form-control">
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Picture 2</span>
                        <input type="file" name="p2" class="form-control">
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Picture 3</span>
                        <input type="file" name="p3" class="form-control">
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Picture 4</span>
                        <input type="file" name="p4" class="form-control">
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Picture 5</span>
                        <input type="file" name="p5" class="form-control">
                    </div>
                    <div class="input-group p-3">
                        <span class="input-group-text">Description&nbsp;&nbsp;&nbsp;</span>
                        <textarea name="des" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <input type="submit" class="form-control btn btn-dark" id="sub" value="Post">
                        </div>
                    </div>
                </form>
                <?php
                if(!empty($_POST))
                {
                    if(empty($_POST["title"]))
                    {
                        die("Title required");
                    }
                    if(empty($_POST["des"]))
                    {
                        die("Description is required");
                    }
                    $_POST['title'] = mysqli_escape_string($mysqli, $_POST['title']);
                    $_POST['des'] = mysqli_escape_string($mysqli, $_POST['des']);
                    if(empty($_POST["p1"]) || empty($_POST["p2"]) || empty($_POST["p3"]) || empty($_POST["p4"]) || empty($_POST["p5"]))
                    {
                        $s1="insert into gallery(title, p1, p2, p3, p4, p5, des) values('{$_POST['title']}', '{$_FILES['p1']['name']}', '{$_FILES['p2']['name']}', '{$_FILES['p3']['name']}', '{$_FILES['p4']['name']}', '{$_FILES['p5']['name']}', '{$_POST['des']}')";
                        if($r1=$mysqli->query($s1)) {
                            echo '<script type="text/javascript"> window.onload = function () { alert("Successfully Posted"); } </script>';
                            $s2="select * from gallery order by id desc limit 1";
                            $r1=$mysqli->query($s2);
                            while($row1 = $r1->fetch_assoc()) {
                                foreach($row1 as $key => $value) {
                                    if(empty($value)) {
                                        unset($row1[$key]);
                                    }
                                }
                                $arr=array_slice($row1,2,sizeof($row1)-3);
                                foreach ($arr as $key=>$value) {
                                    $dest="gallery-upload/".$value;
                                    move_uploaded_file($_FILES[$key]['tmp_name'], $dest);
                                }
                            }
                        }
                        else { 
                            print_r($mysqli->error); 
                        }
                    }
                    else
                    {
                        die('Atleast 1 picture Required');
                    }
                }
                ?>
            </div>
            <div class="container col-4 p-4">
                <h1 class="display-6">Images Posted</h1>
            </div>
        </main>
    <?php
    }
    else
    {
        echo "Let's leave editing galleries to the staffs";
        echo "<br>Redirecting to Gallery<br>";
        header("refresh:5;url=gallery.php");
    }
    ?>
</body>
</html>