<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">

    <!-- LOGO -->
    <a class="navbar-brand" href="admin.php">
      <img src="./bags/others/logo.png">
      <span class="brand-text">ERGOPACK ADMIN</span>
    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- LEFT SIDE (ADMIN ACTIONS) -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="admin.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="choose_category.php">Add Product</a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="update_product.php">Update Product</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="admin_report.php">Report</a>
        </li>

      </ul>

      <!-- SEARCH -->
      <form class="d-flex ms-3" role="search">
        <input class="form-control me-2" type="search" placeholder="Search products">
        <button class="btn btn-outline-success">Search</button>
      </form>

      <!-- RIGHT SIDE -->
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link" href="admin_login.php">Login</a>
        </li>

      </ul>

    </div>
  </div>
</nav>