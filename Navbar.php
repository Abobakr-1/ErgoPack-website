<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$cart_count = 0;
if (isset($_SESSION['cart'])) {
    $cart_count = count($_SESSION['cart']);
}

/* =========================
   SEARCH LOGIC
========================= */
$search_results = [];
$search_query = "";

if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $search_query = trim($_GET['q']);

    // Connect to database
    $conn = mysqli_connect("localhost", "root", "", "ergopack");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Protect search input
    $safe = mysqli_real_escape_string($conn, $search_query);

    // Search in product table using your exact column names
    $sql = $sql = "SELECT Pro_id, Pro_name, Pro_description, Pro_price, Pro_stock, Pro_image, Pro_type
        FROM product
        WHERE Pro_name LIKE '%$safe%'
        ORDER BY Pro_id DESC";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $search_results[] = $row;
        }
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
    
</body>
</html>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">

        <!-- LOGO -->
        <a class="navbar-brand" href="home_page.php">
            <img src="./bags/others/logo.png" alt="Logo">
            <span class="brand-text">ERGOPACK</span>
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

<!-- NAV CONTENT -->
<div class="collapse navbar-collapse" id="navbarSupportedContent">

<!-- LEFT LINKS -->
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link" href="home_page.php">Home</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="about_us.php">About</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="contact_us.php">Contact</a>
    </li>

    <!-- SHOP DROPDOWN -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"
        href="#"
        data-bs-toggle="dropdown">
            Shop
        </a>

        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="adult.php">
                    Adults Collection
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="kids.php">
                    Kids Collection
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="charms.php">
                    Accessories
                </a>
            </li>
        </ul>
    </li>
</ul>

<!-- SEARCH FORM -->
<form class="d-flex ms-3" method="GET" action="">
    <input
        class="form-control me-2"
        type="search"
        name="q"
        placeholder="Search for bags or accessories..."
        style="width: 300px;"
        value="<?= htmlspecialchars($search_query) ?>"
    >

    <button
        class="btn btn-secondary"
        type="submit"
        style="width: 80px;">
        Search
    </button>
</form>

<!-- RIGHT LINKS -->
<ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a class="nav-link" href="customer_signup.php">
            Sign up
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="customer_login.php">
            Log in
        </a>
    </li>

<ul class="navbar-nav ms-auto">

    <?php if(isset($_SESSION['username'])) { ?>

    <li class="nav-item">
        <a class="nav-link" href="logout.php">
            Log out
        </a>
    </li>

    <?php } ?>

</ul>

    <!-- CART -->
        <li class="nav-item ms-auto me-3">
            <a class="nav-link position-relative" href="mycart.php">
                <i class="bi bi-cart3" style="font-size:1.4rem;"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $cart_count; ?>
                </span>
            </a>
        </li>


        </div>
    </div>

    <!-- DARK MODE BUTTON -->
    <button id="darkModeToggle"
            style="background-color:#6B89A8; border:0;">
        🌙
    </button>
</nav>

<!-- SEARCH RESULTS -->
<?php if (!empty($search_query)): ?>
<div class="container mt-4">

    <h5 class="mb-4">
        <?= count($search_results) ?>
        result(s) for
        "<strong><?= htmlspecialchars($search_query) ?></strong>"
    </h5>

    <?php if (!empty($search_results)): ?>
        <div class="row g-4">
            <?php foreach ($search_results as $item): ?>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm">

                        <!-- Product Image -->
                        <img
                            src="<?= htmlspecialchars($item['Pro_image']) ?>"
                            class="card-img-top"
                            style="height: 220px; object-fit: cover;"
                            alt="<?= htmlspecialchars($item['Pro_name']) ?>"
                        >

                        <!-- Product Details -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <?= htmlspecialchars($item['Pro_name']) ?>
                            </h5>

                            <p class="text-muted small">
                                <?= htmlspecialchars($item['Pro_description']) ?>
                            </p>

                            <p class="fw-bold mb-1">
                                EGP <?= number_format($item['Pro_price'], 2) ?>
                            </p>

                            <p class="text-secondary small mb-1">
                                Category:
                                <?= htmlspecialchars($item['Pro_type']) ?>
                            </p>

                            <!-- View Button -->
<a href="add_to_cart.php?id=<?= $item['Pro_id']; ?>"
   class="btn btn-primary mt-auto">
    Add to Cart
</a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <div class="alert alert-warning mt-3">
            No products found.
            <a href="home_page.php">Go back home</a>
        </div>
    <?php endif; ?>

</div>
<?php endif; ?>

<script>
/* DARK MODE */
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("darkModeToggle");

    toggleBtn.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            localStorage.setItem("theme", "dark");
            toggleBtn.innerHTML = "☀️";
        } else {
            localStorage.setItem("theme", "light");
            toggleBtn.innerHTML = "🌙";
        }
    });

    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark-mode");
        toggleBtn.innerHTML = "☀️";
    }
});

</script>