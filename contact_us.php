<?php
$con = mysqli_connect("localhost", "root", "", "ergopack");

$success = false;

if (isset($_POST['btn'])) {

    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];

    $stat = "INSERT INTO contacts (name, email, message)
             VALUES ('$name', '$email', '$message')";

    $res = mysqli_query($con, $stat);

    if($res){
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - ErgoPack</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  
  <link rel="stylesheet" href="css.css">
</head>

<body>

<?php include('navbar.php'); ?>
<?php if(empty($search_query)): ?>

<main class="flex-grow-1 d-flex align-items-center justify-content-center">

  <div class="contact-box text-center">

    <h2>Contact Us</h2>
    <p class="mb-4">We are always here to help you</p>

<div class="p-4 shadow rounded contact-card">
      <h5 class="mb-3">Send us a Message</h5>

      <form method="POST">

        <div class="mb-3 text-start">
          <label>Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
          <label>Message</label>
          <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" name="btn" class="btn btn-primary w-100">
          Send
        </button>

      </form>

    </div>

  </div>

</main>
<!-- Toast Top Right -->
<div class="position-fixed top-10 end-0 p-3" style="z-index: 9999;">

  <div id="successToast"
       class="toast align-items-center text-bg-success border-0"
       role="alert"
       aria-live="assertive"
       aria-atomic="true">

    <div class="d-flex">
      <div class="toast-body">
        ✅ Message sent successfully!
      </div>

      <button type="button"
              class="btn-close btn-close-white me-2 m-auto"
              data-bs-dismiss="toast">
      </button>
    </div>

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<?php if($success): ?>
<script>
    const toast = new bootstrap.Toast(document.getElementById('successToast'));
    toast.show();
</script>
<?php endif; ?>
<?php endif; ?>

<?php include('footer.php'); ?>

</body>
</html>