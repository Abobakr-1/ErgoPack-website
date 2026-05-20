<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "ergopack");

$toast = "";
$toastType = "";

if(isset($_POST['btn'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM customer WHERE Username='$username'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) == 1){

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['C_password'])){

            $_SESSION['C_id'] = $row['C_ID'];
            $_SESSION['username'] = $row['F_name'] . ' ' . $row['L_name'];

            $toast = "Login Successful!";
            $toastType = "success";

            header("Location: home_page.php");
            exit();
        } else {

            $toast = "Wrong Password!";
            $toastType = "error";
        }

    } else {

        $toast = "User Not Found!";
        $toastType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<style>

body{
    background:#f4f6f9;
}

.login-wrapper{
    min-height:80vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

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

.login-form-box{
    width:100%;
}

.form-control{
    padding:12px;
    border-radius:10px;
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

.simple-link{
    color:#6b89a8;
    text-decoration:none;
    font-weight:500;
}

.simple-link:hover{
    text-decoration:underline;
}

/* PASSWORD TOGGLE */
.pwd-wrap{
    position:relative;
}

.pwd-toggle{
    position:absolute;
    right:10px;
    top:50%;
    transform:translateY(-50%);
    background:#6b89a8;
    color:white;
    border:none;
    padding:5px 10px;
    border-radius:6px;
    font-size:12px;
    cursor:pointer;
}

.pwd-toggle:hover{
    background:#56728c;
}

/* RESPONSIVE */
@media(max-width:768px){

    .login-card{
        flex-direction:column;
        height:auto;
    }

    .login-left,
    .login-right{
        width:100%;
    }
}

/* TOAST */
#toast-wrap{
    position:fixed;
    bottom:24px;
    right:24px;
    z-index:9999;
    width:300px;
}

.toast-item{
    color:white;
    padding:15px 18px;
    margin-top:12px;
    border-radius:12px;
    font-size:15px;
    box-shadow:0 6px 18px rgba(0,0,0,0.2);

    transform:translateX(120%);
    opacity:0;
    transition:0.4s ease;
}

.toast-item.show{
    transform:translateX(0);
    opacity:1;
}

.toast-success{
    background:linear-gradient(135deg,#22c55e,#16a34a);
}

.toast-error{
    background:linear-gradient(135deg,#ef4444,#dc2626);
}

</style>
</head>

<body>


<div class="login-wrapper">

    <div class="login-card">

        <!-- LEFT -->
        <div class="login-left">
            <img src="bags/others/logo2.jpeg" alt="Logo">
        </div>

        <!-- RIGHT -->
        <div class="login-right">

            <div class="login-form-box">

                <h3 class="mb-2">Log In</h3>
                <p class="text-muted mb-3">Enter your credentials</p>

                <form method="post">

                    <!-- USERNAME -->
                    <div class="mb-3">
                        <input type="text"
                               name="username"
                               class="form-control"
                               placeholder="Username"
                               required>
                    </div>

                    <!-- PASSWORD (WITH TOGGLE ADDED) -->
                    <div class="mb-3 pwd-wrap">

                        <input type="password"
                               id="pwd"
                               name="password"
                               class="form-control"
                               placeholder="Password"
                               required>

                        <button class="pwd-toggle"
                                id="toggle-pwd"
                                onclick="togglePassword('pwd','toggle-pwd')"
                                type="button">
                            Show
                        </button>

                    </div>

                    <button type="submit"
                            name="btn"
                            class="btn-login">
                        Log in
                    </button>

                </form>

                <div class="mt-3 text-center">
                    <a href="customer_signup.php"
                       class="simple-link">
                        Don't have an account? Sign up
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

<!-- TOAST -->
<div id="toast-wrap"></div>

<script>

function togglePassword(inputId, buttonId) {

    let input = document.getElementById(inputId);
    let button = document.getElementById(buttonId);

    if (input.type === "password") {
        input.type = "text";
        button.textContent = "Hide";
    } else {
        input.type = "password";
        button.textContent = "Show";
    }
}

function showToast(type, message){

    let wrap = document.getElementById('toast-wrap');

    let toast = document.createElement('div');

    toast.className = 'toast-item toast-' + type;

    if(type == "success"){
        toast.innerHTML = "✔ " + message;
    }else{
        toast.innerHTML = "✖ " + message;
    }

    wrap.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('show');
    }, 100);

    setTimeout(() => {

        toast.classList.remove('show');

        setTimeout(() => {
            toast.remove();
        }, 4000);

    }, 3000);
}

</script>

<?php if($toast != ""){ ?>

<script>
showToast('<?php echo $toastType; ?>',
          '<?php echo $toast; ?>');
</script>

<?php } ?>

</body>
</html>