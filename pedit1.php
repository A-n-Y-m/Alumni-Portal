<!DOCTYPE html>
<html>

<head>
    <title>Profile Edit 1</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/pedit.css"> -->
</head>

<body >
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <?php
                session_start();
                $db = require __DIR__ . '/database.php';
                $sql_u = "select * from user where id={$_SESSION["user_id"]}";
                $r1 = mysqli_query($db, $sql_u);
                $user = $r1->fetch_assoc();
                if (isset($_SESSION["user_id"])) {
                $imgadd = "upload/" . $user["pic"];
                } else {
                $imgadd = "https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg";
                }
            ?>
            <div class="col-md-5 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="<?= $imgadd ?>">
                    <?php if (isset($user)) : ?>
                    <span class="font-weight-bold"><?= htmlspecialchars($user["name"]) ?></span>
                    <span class="text-black-50"><?= htmlspecialchars($user["email"]) ?></span>
                    <br>
                    <!-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Change</button></div> -->
                    <?php endif; ?>
                </div>
            </div>
            <?php
                $sql_i = "select * from info where id={$_SESSION["user_id"]}";
                $r = mysqli_query($mysqli, $sql_i);
                $rcnt = mysqli_num_rows($r);
                if ($rcnt == 0) {
                $sql_i1 = "insert into info(id, uname, email) values ({$user["id"]}, '{$user["name"]}', '{$user["email"]}')";
                $mysqli->query($sql_i1);
            ?>     
                <div class="col-md-5 border-right">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="form">
                        <form action="pedit2.php" method="post" id="signup" novalidate enctype="multipart/form-data">
                            <div>
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" class="form-control" placeholder="first name" value="">
                            </div>
                            <div>
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" class="form-control" value="" placeholder="last name">
                            </div>
                            <div>
                                <label for="uname">UserName</label>
                                <input type="text" name="uname" class="form-control" placeholder="enter the display name" value="<?= htmlspecialchars($user["name"]) ?>">
                            </div>
                            <div>
                                <label for="mno">Mobile Number</label>
                                <input type="text" name="mno" class="form-control" placeholder="enter phone number" value="">
                            </div>
                            <div>
                                <label for="dep">Department</label>
                                <input type="text" name="dep" class="form-control" placeholder="enter your department" value="">
                            </div>
                            <div>
                                <label for="eid">Email ID</label>
                                <input type="text" name="eid" class="form-control" placeholder="enter your personal mail-id" value="<?= htmlspecialchars($user["email"]) ?>">
                            </div>
                            <div>
                                <label for="yr">Year</label><input type="text" name="yr" class="form-control" placeholder="enter the Graduation Year" value="">
                            </div>
                            <div>
                                <label class="labels">Company</label>
                                <input type="text" name="cmp" class="form-control" placeholder="enter your current company" value="">
                            </div>
                            <div>
                                <label class="labels">Experience</label>
                                <input type="text" name="exp" class="form-control" placeholder="enter no. of experienced year" value="">
                            </div>
                            <div>
                                <label class="labels">Change Profile Picture</label>
                                <input type="file" name="npp" class="form-control">
                            </div>
                            <br>
                            <button class="btn btn-primary profile-button">Save Changes</button>
                        </form>
                    </div>
                </div>
            <?php }
            else{ 
                $r2 = mysqli_query($db, $sql_i);
                $info = $r2->fetch_assoc();
                // print_r($info);
            ?>
                <div class="col-md-5 border-right">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="form">
                        <form action="pedit2.php" method="post" id="signup" novalidate enctype="multipart/form-data">
                            <div>
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" class="form-control" placeholder="first name" value="<?= htmlspecialchars($info["fnm"]) ?>">
                            </div>
                            <div>
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" class="form-control" value="<?= htmlspecialchars($info["lnm"]) ?>" placeholder="last name">
                            </div>
                            <div>
                                <label for="uname">UserName</label>
                                <input type="text" name="uname" class="form-control" placeholder="enter the display name" value="<?= htmlspecialchars($info["uname"]) ?>">
                            </div>
                            <div>
                                <label for="mno">Mobile Number</label>
                                <input type="text" name="mno" class="form-control" placeholder="enter phone number" value="<?= htmlspecialchars($info["ph_no"]) ?>">
                            </div>
                            <div>
                                <label for="dep">Department</label>
                                <input type="text" name="dep" class="form-control" placeholder="enter your department" value="<?= htmlspecialchars($info["dept"]) ?>">
                            </div>
                            <div>
                                <label for="eid">Email ID</label>
                                <input type="text" name="eid" class="form-control" placeholder="enter your personal mail-id" value="<?= htmlspecialchars($info["email"]) ?>">
                            </div>
                            <div>
                                <label for="yr">Year</label><input type="text" name="yr" class="form-control" placeholder="enter the Graduation Year" value="<?= htmlspecialchars($info["year"]) ?>">
                            </div>
                            <div>
                                <label class="labels">Company</label>
                                <input type="text" name="cmp" class="form-control" placeholder="enter your current company" value="<?= htmlspecialchars($info["company"]) ?>">
                            </div>
                            <div>
                                <label class="labels">Experience</label>
                                <input type="text" name="exp" class="form-control" placeholder="enter no. of experienced year" value="<?= htmlspecialchars($info["exp"]) ?>">
                            </div>
                            <div>
                                <label class="labels">Change Profile Picture</label>
                                <input type="file" name="npp" class="form-control">
                            </div>
                            <br>
                            <button class="btn btn-primary profile-button">Save Changes</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>