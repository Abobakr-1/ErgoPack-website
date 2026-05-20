<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - ErgoPack</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


  <style>
      /* story image */
      .story-img-wrap {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(23, 84, 139, 0.15);
        height: 420px;
      }
      .story-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      /* story text tweaks */
      .story-eyebrow {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #6b89a8;
        margin-bottom: 20px;
      }
      .story-divider {
        width: 48px;
        height: 3px;
        background: #6b89a8;
        border-radius: 2px;
        margin: 16px 0 20px;
      }

      /* team tweaks */
      .team-bg {
        background-color: #f7f9fc;
      }
      .team-subtitle {
        font-size: 14px;
        color: #6b89a8;
        letter-spacing: 0.05em;
        margin-bottom: 40px;
      }
      .team-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 28px 16px 22px;
        text-align: center;
        box-shadow: 0 2px 16px rgba(107, 137, 168, 0.12);
        transition: transform 0.3s ease, box-shadow 0.22s ease;
      }
      .team-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 32px rgba(23, 84, 139, 0.18);
      }
      .avatar-circle {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        margin: 0 auto 14px;
        color: #ffffff;
      }
      .team-card h6 {
        font-size: 14px;
        font-weight: 700;
        color: #17548b;
        margin-bottom: 4px;
      }
      .team-card p {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #6b89a8;
        margin: 0;
    }
  </style>
</head>

<body>

<?php include('navbar.php'); ?>
<?php if(empty($search_query)): ?>

<main class="flex-grow-1">

  <!-- STORY -->
  <section class="about-section">
    <div class="container">
      <div class="row align-items-center g-4">

        <div class="col-md-6">
          <div class="about-box text-start">
            <p class="story-eyebrow">What we stand for</p>
            <h2 class="text-start">Our Mission</h2>
            <div class="story-divider"></div>
            <p>
              We set out with one clear goal to make bags that people can truly depend on.
              Not just for a season, but for years of daily adventures, commutes, and journeys.
            </p>
            <p>
              Quality is not a feature for us, it is the foundation. Every stitch, zipper, and strap
              goes through careful thought before it ever reaches your hands.
            </p>
          </div>
        </div>

        <div class="col-md-6">
          <div class="about-box text-start">
            <p class="story-eyebrow">Who we are</p>
            <h2 class="text-start">Our Story</h2>
            <div class="story-divider"></div>
            <p>
              We believe a good bag is not just an accessory, but something that supports your lifestyle every day.
              Every design is carefully made to balance strength, comfort, and modern style.
            </p>
            <p>
              At ErgoPack, we aim to deliver products that last long and feel easy to use in any situation.
              Your satisfaction is our priority, and we always work to improve our quality and designs.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- TEAM -->
  <section class="about-section team-bg">
    <div class="container text-center">

      <h2>Meet the Team</h2>
      <p class="team-subtitle">5 founders, one shared vision</p>

      <div class="row g-3 justify-content-center">

        <div class="col-6 col-md-2">
          <div class="team-card">
            <div class="avatar-circle" style="background-color:#17548b;">AM</div>
            <h6>Abobakr<br>Mohamed</h6>
            <p>Founder</p>
          </div>
        </div>

        <div class="col-6 col-md-2">
          <div class="team-card">
            <div class="avatar-circle" style="background-color:#6b89a8;">AH</div>
            <h6>Adham<br>Hossam</h6>
            <p>Founder</p>
          </div>
        </div>

        <div class="col-6 col-md-2">
          <div class="team-card">
            <div class="avatar-circle" style="background-color:#0f3d66;">GM</div>
            <h6>Gharam<br>Mohamed</h6>
            <p>Founder</p>
          </div>
        </div>

        <div class="col-6 col-md-2">
          <div class="team-card">
            <div class="avatar-circle" style="background-color:#17548b;">SA</div>
            <h6>Salma<br>Atef</h6>
            <p>Founder</p>
          </div>
        </div>

        <div class="col-6 col-md-2">
          <div class="team-card">
            <div class="avatar-circle" style="background-color:#6b89a8;">JA</div>
            <h6>Jumana<br>Adel</h6>
            <p>Founder</p>
          </div>
        </div>

      </div>

    </div>
  </section>

</main>
<?php endif; ?>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>