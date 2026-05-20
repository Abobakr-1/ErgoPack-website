<?php
session_start();

$toast = "";
$toastType = "";

if (isset($_POST['btn'])) {

    $F_name = trim($_POST['F_name']);
    $L_name = trim($_POST['L_name']);
    $Username = trim($_POST['Username']);
    $C_email = trim($_POST['C_email']);
    $C_phone = trim($_POST['C_phone']);
    $password = $_POST['C_password'];
    $confirm  = $_POST['C_password2'];
    $C_gender = $_POST['C_gender'];

    // VALIDATIONS 
    if ($password != $confirm) {
        $toast = "Passwords do NOT match";
        $toastType = "error";
    }
    else if (strlen($C_phone) != 11 || !ctype_digit($C_phone)) {
        $toast = "Phone must be exactly 11 digits";
        $toastType = "error";
    }
    else if (is_numeric($F_name) || is_numeric($L_name)) {
        $toast = "Name cannot contain numbers";
        $toastType = "error";
    }
    else if (
        strlen($password) < 6 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[^A-Za-z0-9]/', $password)
    ) {
        $toast = "Password must be STRONG (uppercase, number & symbol required)";
        $toastType = "error";
    }
    else {

        $con = mysqli_connect("localhost", "root", "", "ergopack");

        if (!$con) {
            $toast = "Connection error";
            $toastType = "error";
        }
        else {
            // CHECK EXISTING USER — using prepared statement for safety
            $check = mysqli_prepare($con,
                "SELECT C_id FROM customer WHERE C_email=? OR Username=?");
            mysqli_stmt_bind_param($check, "ss", $C_email, $Username);
            mysqli_stmt_execute($check);
            mysqli_stmt_store_result($check);

            if (mysqli_stmt_num_rows($check) > 0) {
                $toast = "Email or Username already exists";
                $toastType = "error";
            }
            else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $ins = mysqli_prepare($con,
                    "INSERT INTO customer
                     (F_name, L_name, Username, C_email, C_phone, C_password, C_gender)
                     VALUES (?, ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($ins, "sssssss",
                    $F_name, $L_name, $Username,
                    $C_email, $C_phone, $hashed_password, $C_gender);

                if (mysqli_stmt_execute($ins)) {

                    $user_id = mysqli_insert_id($con);

                    $_SESSION['C_id']     = $user_id;
                    $_SESSION['username'] = $F_name . ' ' . $L_name;

                    if (isset($_GET['redirect']) && $_GET['redirect'] == 'checkout') {
                        header("Location: checkout.php");
                    } else {
                        header("Location: checkout.php?welcome=1");
                    }
                    exit();

                } else {
                    $toast = "Something went wrong. Please try again.";
                    $toastType = "error";
                }
            }
        }
    }
}

// build the action URL once so we can reuse it cleanly
$formAction = "customer_signup.php" .
    (isset($_GET['redirect']) ? "?redirect=" . htmlspecialchars($_GET['redirect']) : "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up - ErgoPack</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css.css" rel="stylesheet">

<style>
body { background: #f4f6f9; }

/* CARD  */
.signup-wrapper {
    min-height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.signup-card {
    width: 680px;
    max-width: 95%;
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    display: flex;
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    margin: 50px 0;
}

.signup-left {
    width: 45%;
    background: linear-gradient(135deg, #dfe8f1, #c8d7e8);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
}

.signup-left img {
    width: 80%;
    max-width: 280px;
    border-radius: 15px;
}

.signup-right {
    width: 55%;
    padding: 35px;
}

/* INPUTS */
.form-control {
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 12px;
    border: 1px solid #ccc;
}

.form-control:focus {
    border-color: #6b89a8;
    box-shadow: 0 0 8px rgba(107,137,168,.3);
}

/* PASSWORD WRAP */

.pwd-wrap {
    position: relative;
    margin-bottom: 10px;
}

.pwd-wrap .form-control {
    margin-bottom: 0;   
    padding-right: 70px;
}

.pwd-toggle {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: #6b89a8;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 12px;
    cursor: pointer;
}

.pwd-toggle:hover { background: #56728c; }

/* STRENGTH BAR */
.strength-box {
    height: 6px;
    background: white;
    border-radius: 4px;
    margin: 4px 0 2px;
    overflow: hidden;
}

#strength-bar {
    height: 100%;
    width: 0%;
    border-radius: 4px;
    transition: width .3s, background .3s;
}

#strength-text {
    font-size: 12px;
    margin-bottom: 10px;
    min-height: 18px;
}

/* GENDER */
.gender-box{ 
    margin-bottom: 15px;
    width: 300px; 
}
.gender-title{
    font-weight: 600;
    margin-bottom: 10px;
    color: #444;
}
.gender-options { 
    display: flex;
    gap: 15px; 
}

.gender-label {
    flex: 1;
    border: 2px solid #d0d7df;
    border-radius: 12px;
    padding: 12px;
    text-align: center;
    cursor: pointer;
    transition: .3s;
    font-weight: 500;
}

.gender-label input{
    display: none;
}

.gender-label:has(input:checked) {
    border-color: #658cb3;
    background: #eef3f8;
}

.gender-label input:checked + span {
    color: #6b89a8;
    font-weight: bold;
}

/* BUTTON */
.btn-submit {
    width: 100%;
    padding: 13px;
    border: none;
    border-radius: 12px;
    background: #6b89a8;
    color: white;
    font-weight: bold;
    transition: .3s;
}

.btn-submit:hover{
    background: #56728c;
}

.simple-link {
    color: #6b89a8;
    text-decoration: none;
    font-weight: 500;
}

.simple-link:hover { text-decoration: underline; }

/*  TOAST  */
#toast-wrap {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 9999;
    width: 320px;
}

.toast-item {
    color: white;
    padding: 15px 18px;
    margin-top: 12px;
    border-radius: 12px;
    font-size: 15px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.2);
    transform: translateX(120%);
    opacity: 0;
    transition: 0.4s ease;
}

.toast-item.show{
    transform: translateX(0);
    opacity: 1; 
}

.toast-success { background: linear-gradient(135deg, #22c55e, #16a34a); }
.toast-error   { background: linear-gradient(135deg, #ef4444, #dc2626); }
</style>
</head>

<body>


<div class="signup-wrapper">
    <div class="signup-card">

        <div class="signup-left">
            <img src="bags/others/logo2.jpeg" alt="ErgoPack Logo">
        </div>

        <div class="signup-right">
            <h3>Create Account</h3>
            <p class="text-muted mb-3">Sign up to get started</p>

            <form method="post" action="<?php echo $formAction; ?>">

                <input type="text"  name="F_name"   class="form-control" placeholder="First Name"  required>
                <input type="text"  name="L_name"   class="form-control" placeholder="Last Name"   required>
                <input type="text"  name="Username" class="form-control" placeholder="Username"    required>
                <input type="email" name="C_email"  class="form-control" placeholder="Email"       required>
                <input type="text"  name="C_phone"  class="form-control" placeholder="Phone (11 digits)" required maxlength="11">

                <!-- Password -->
                <div class="pwd-wrap">
                    <input type="password" id="pwd" name="C_password"
                           class="form-control" placeholder="Password" required>
                    <button class="pwd-toggle" type="button"
                            onclick="togglePassword('pwd', this)">Show</button>
                </div>

                <div class="strength-box"><div id="strength-bar"></div></div>
                <p id="strength-text"></p>

                <!-- Confirm Password -->
                <div class="pwd-wrap">
                    <input type="password" id="pwd-confirm" name="C_password2"
                           class="form-control" placeholder="Confirm Password" required>
                    <button class="pwd-toggle" type="button"
                            onclick="togglePassword('pwd-confirm', this)">Show</button>
                </div>

                <!-- Gender -->
                <div class="gender-box">
                    <div class="gender-title">Select Gender</div>
                    <div class="gender-options">
                        <label class="gender-label">
                            <input type="radio" name="C_gender" value="Male" required>
                            <span>Male</span>
                        </label>
                        <label class="gender-label">
                            <input type="radio" name="C_gender" value="Female">
                            <span>Female</span>
                        </label>
                    </div>
                </div>

                <button type="submit" name="btn" class="btn-submit">Sign Up</button>
            </form>

            <div class="mt-3 text-center">
                <a href="customer_login.php" class="simple-link">
                    Already have an account? Login
                </a>
            </div>
        </div>

    </div>
</div>

<div id="toast-wrap"></div>

<script>
/* TOGGLE PASSWORD */
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
        btn.textContent = "Hide";
    } else {
        input.type = "password";
        btn.textContent = "Show";
    }
}

/* ── PASSWORD STRENGTH ───────────────── */
const passwordInput = document.getElementById("pwd");
const strengthBar   = document.getElementById("strength-bar");
const strengthText  = document.getElementById("strength-text");

passwordInput.addEventListener("input", function () {
    const password = passwordInput.value;

    if (password.length === 0) {
        strengthBar.style.width = "0%";
        strengthText.textContent = "";
        return;
    }

    let strength = 0;
    if (password.length >= 6)           strength++;
    if (password.match(/[A-Z]/))        strength++;
    if (password.match(/[0-9]/))        strength++;
    if (password.match(/[^A-Za-z0-9]/)) strength++;

    if (strength <= 1) {
        strengthBar.style.width      = "33%";
        strengthBar.style.background = "#ef4444";
        strengthText.textContent     = "Weak Password";
        strengthText.style.color     = "#ef4444";
    } else if (strength <= 3) {
        strengthBar.style.width      = "66%";
        strengthBar.style.background = "#f59e0b";
        strengthText.textContent     = "Medium Password";
        strengthText.style.color     = "#f59e0b";
    } else {
        strengthBar.style.width      = "100%";
        strengthBar.style.background = "#22c55e";
        strengthText.textContent     = "Strong Password ✓";
        strengthText.style.color     = "#22c55e";
    }
});

/* ── TOAST ───────────────────────────── */
function showToast(type, message) {
    const wrap = document.getElementById('toast-wrap');
    const div  = document.createElement('div');
    div.className   = 'toast-item toast-' + type;
    div.textContent = message;
    wrap.appendChild(div);

    setTimeout(() => div.classList.add('show'), 100);
    setTimeout(() => {
        div.classList.remove('show');
        setTimeout(() => div.remove(), 400);
    }, 4000);
}
</script>

<?php if ($toast !== ""): ?>
<script>
    // run after DOM is ready
    document.addEventListener('DOMContentLoaded', function(){
        showToast('<?php echo $toastType; ?>', '<?php echo addslashes($toast); ?>');
    });
</script>
<?php endif; ?>

<?php include('footer.php'); ?>
</body>
</html>