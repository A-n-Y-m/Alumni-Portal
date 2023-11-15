
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="/js/validation.js" defer></script>
</head>
<body>
    
    <h1>Signup</h1>
    
    <form action="register.php" method="post" id="signup" novalidate enctype="multipart/form-data">
        <div>
            <label for="name">Username</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="id">email</label>
            <input type="email" id="email" name="id" value="<?=$_POST["su"] ?>">
        </div>
        <div>
            <label for="pwd">Password</label>
            <input type="password" id="password" name="pwd">
        </div>
        <div>
            <label for="pwd_cnfrm">Repeat password</label>
            <input type="password" id="pswd_cnfrm" name="pwd_cnfrm">
        </div>
        <div>
            <label for="file-selector">Profile Picture</label>
            <input type="file" id="pfp" name="pp">
        </div>
        <br>
        <div>
            <label for="rad">A Student or a Staff member?</label>
        </div>
        <div id="rad">
            <div>
                <input type="radio" name="type" id="stf" value="staff" checked="checked">
                <label for="stf">Staff</label>
            </div>
            <div>
                <input type="radio" name="type" id="stu" value="student">
                <label for="stu">Student</label>
            </div>
        </div>
        <br>
        <button>Sign up</button>
    </form>
    
</body>
</html>