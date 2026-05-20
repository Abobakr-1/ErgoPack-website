<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Custom Cursor</title>
<style>


</style>
  <meta charset="UTF-8">
  <title>ErgoPack</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="css.css">
  <style>

#deal-bar{
    width:100%;
    background: linear-gradient(90deg, #1c4e7a, #264e80);
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:20px;
    padding:12px 20px;
    margin-top: 0 !important;
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    position:relative;
    margin-bottom: 0px;

}

.deal-text{
    font-weight:700;
    font-size:15px;
    letter-spacing:0.5px;
    margin: 0px;
}

.deal-timer span{
    background:#F2F2F2;
    color:#111;
    padding:6px 10px;
    border-radius:6px;
    font-weight:700;
    margin:0 2px;
    min-width:35px;
    display:inline-block;
    text-align:center;
}

.welcome-nav1 {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0;
  background: linear-gradient(90deg, #1c4e7a, #264e80);
  color: white;
  padding: 6px 40px;
  border-radius: 20px;
  font-size: 30px;
  font-weight: 600;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
  margin-right: 10px;
  margin-bottom: 20px;
}
.stars{
    font-size:22px;
    cursor:pointer;
    color:#ccc;
    margin:8px 0;
}

.stars span{
    transition:0.2s;
}

.stars span.active{
    color:gold;
}
</style>
</head>

<body>
  
<?php include('navbar.php'); ?>
<?php if(empty($search_query)): ?>

<!-- COUNTDOWN TIMER (ADDED HERE) -->
<div id="deal-bar" data-end="2026-6-1 23:59:59">
  <div class="deal-text">
    🔥 LIMITED TIME DEAL ENDS IN:
  </div>
  <div class="deal-timer">
    <span id="cd-days">00</span>d :
    <span id="cd-hrs">00</span>h :
    <span id="cd-min">00</span>m :
    <span id="cd-sec">00</span>s
  </div>
  <div id="cd-msg"></div>

</div>    
<!-- WELCOME MESSAGE -->
<div class="container mt-3 text-center">

  <?php if(isset($_SESSION['username'])) { ?>

    <div class="welcome-nav1">
        <div class="welcome-dot"></div>
        <span>Welcome, <?php echo $_SESSION['username']; ?></span>
    </div>






  <?php } else { ?>

    <div class="welcome-nav1">
        <div class="welcome-dot"></div>
        <span>Welcome, Guest</span>
    </div>

  <?php } ?>

</div>
<!-- <?php print_r($_SESSION); ?> -->

<!-- CAROUSEL -->
<div id="carouselExampleIndicators" class="carousel slide"
     data-bs-ride="carousel" data-bs-interval="4000" data-bs-pause="false">

  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
  </div>

  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
        <a href="adult.php">
        <img src="./bags/others/Bundel c.png" class="d-block w-100">
      </a>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <a href="adult.php">
        <img src="./bags/others/best sellers c.png" class="d-block w-100">
      </a>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <a href="adult.php">
        <img src="./bags/others/crousil3.jpg" class="d-block w-100">
      </a>
    </div>

  </div>

  <button class="carousel-control-prev" type="button"
          data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>

  <button class="carousel-control-next" type="button"
          data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

</div>

<!-- FEATURES -->
<div class="container my-5 text-center">
  <div class="row">

    <div class="col-md-4 mb-4">
      <div class="feature-box p-4">
        <h4>Carry Smart</h4>
        <p style="text-align: justify;">Feel Better Evenly distributed weight reduces strain on your back and shoulders, keeping you comfortable and energized throughout the day.</p>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="feature-box p-4">
        <h4>Built for Your Body</h4>
        <p style="text-align: justify;">Thoughtfully designed to align with your spine, our bags promote better posture whether you're commuting, working, or on the go.</p>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="feature-box p-4">
        <h4>Style Meets Comfort</h4>
        <p style="text-align: justify;">With a wide variety of designs and colors to choose from, you never have to compromise, look great and feel great, every single day.</p>
      </div>
    </div>

  </div>
</div>

<!-- ABOUT -->
<div class="container my-5">
  <div class="row align-items-center">

    <div class="col-md-6 mb-4">
      <h2>ErgoPack</h2>
<p style="text-align: justify;">
    ErgoPack is a modern brand dedicated to creating high-quality ergonomic backpacks designed for everyday life. 
    We believe that carrying your essentials should never come at the cost of your health or style. 
    Every bag we craft is built with your body in mind, using premium materials, smart weight distribution, 
    and thoughtful design to keep you comfortable, supported, and looking great, whether you're heading to work, 
    school, or your next adventure.
</p>

      <a href="adult.php" class="btn btn-primary mt-2">
        Explore Products
      </a>
    </div>

    <div class="col-md-6">
      <img src="./bags/others/logo2.jpeg" class="img-fluid rounded shadow">
    </div>

  </div>
</div>

<!-- BEST SELLERS -->
<?php
$con = mysqli_connect("localhost", "root", "" , "ergopack");
$stat = "SELECT * FROM product WHERE Pro_id IN (38, 45, 52)";
$res = mysqli_query($con, $stat);
?>

<h2 class="text-center mb-3">BEST SELLERS</h2>

<div class="container mt-4">
  <div class="row g-3">

    <?php while($row = mysqli_fetch_assoc($res)) { ?>

    <div class="col-md-4">
      <div class="card h-100">

<img src="<?php echo $row['Pro_image']; ?>" 
     class="card-img-top"
     style="height:250px; object-fit:cover;">

        <div class="card-body">

          <h6><?php echo $row['Pro_name']; ?></h6>

          <p class="small" style="text-align: justify;"><?php echo $row['Pro_description']; ?></p>

          <h6>EGP <?php echo $row['Pro_price']; ?></h6>

<a href="add_to_cart.php?id=<?php echo $row['Pro_id']; ?>" 
   class="btn btn-primary w-100 text-center mt-auto">
    Add to Cart
</a>

          <!-- STARS -->
          <div class="stars" data-rating="0">
            <span onclick="rate(this,1)">☆</span>
            <span onclick="rate(this,2)">☆</span>
            <span onclick="rate(this,3)">☆</span>
            <span onclick="rate(this,4)">☆</span>
            <span onclick="rate(this,5)">☆</span>
          </div>

        </div>
      </div>
    </div>

    <?php } ?>

  </div>
</div>

<!-- CSS -->
<style>
.stars{
    font-size:22px;
    cursor:pointer;
    color:#ccc;
    margin-top:10px;
}

.stars span{
    transition:0.2s;
}

.stars span.active{
    color:gold;
}
</style>

<!-- JS -->
<script>
function rate(el, value){

    let parent = el.parentElement;

    let stars = parent.querySelectorAll("span");

    parent.setAttribute("data-rating", value);

    stars.forEach((s, index)=>{

        if(index < value){

            s.classList.add("active");
            s.innerHTML = "★";

        } else {

            s.classList.remove("active");
            s.innerHTML = "☆";

        }

    });

}
</script>
<?php endif; ?>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</button>

<button onclick="window.scrollTo({top:0, behavior:'smooth'})" 
  style="position:fixed;
  bottom:30px;
  right:30px;
  z-index:999;
  background:#264e80;
  color:white;
  border:none;
  border-radius:50%;
  width:45px;
  height:45px;
  font-size:20px;
  cursor:pointer;">
  ↑
</button>
<script src="js.js"></script>

</body>
</html>