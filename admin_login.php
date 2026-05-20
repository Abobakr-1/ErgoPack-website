<?php
session_start();

$error = "";

if(isset($_POST['btn'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $con = mysqli_connect("localhost", "root", "", "ergopack");

    if(!$con){
        $error = "Connection error";
    } else {

        $stat = "SELECT * FROM admin_login 
                 WHERE username='$username' AND password='$password'";

        $res = mysqli_query($con, $stat);

        if(mysqli_num_rows($res) > 0){

            $_SESSION['admin'] = $username;

            header("Location: admin.php");
            exit;

        } else {
            $error = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
}

/* MAIN WRAPPER */
.login-wrapper{
    min-height:80vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* CARD */
.login-card{
    width:900px;
    max-width:95%;
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    display:flex;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

/* LEFT SIDE */
.login-left{
    width:50%;
    background:#dfe8f1;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
}

.login-left img{
    width:80%;
    max-width:250px;
}

/* RIGHT SIDE */
.login-right{
    width:50%;
    padding:40px;
    display:flex;
    align-items:center;
}

.form-box{
    width:100%;
}

.form-control{
    padding:12px;
    border-radius:10px;
    margin-bottom:12px;
}

.btn-login{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#6b89a8;
    color:white;
    font-weight:bold;
}

.btn-login:hover{
    background:#56728c;
}

.error-msg{
    background:#ffdddd;
    color:#b30000;
    padding:10px;
    border-radius:8px;
    margin-bottom:15px;
    text-align:center;
}

/* RESPONSIVE */
@media(max-width:768px){
    .login-card{
        flex-direction:column;
    }
    .login-left, .login-right{
        width:100%;
    }
}
</style>

</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <!-- LEFT SIDE LOGO -->
        <div class="login-left">
            <img src="bags/others/logo2.jpeg" alt="Logo">
        </div>

        <!-- RIGHT SIDE FORM -->
        <div class="login-right">

            <div class="form-box">

                <h3 class="mb-2">Admin Login</h3>
                <p class="text-muted mb-3">Enter admin credentials</p>

                <?php if($error != "") { ?>
                    <div class="error-msg"><?php echo $error; ?></div>
                <?php } ?>

                <form method="post">

                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>

                    <button type="submit" name="btn" class="btn-login">Login</button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>