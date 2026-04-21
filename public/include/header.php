<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Premier Senior Secondary School</title>
  <!-----favicon---->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico?v=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <!-- css -->
  <link rel="stylesheet" href="style.css">
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-------CArousel--->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

  <!-- Page-specific CSS -->
  <?php if (isset($page_css)): ?>
    <link rel="stylesheet" href="<?php echo $page_css; ?>">
  <?php endif; ?>


   <!-- FancyBox -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
  
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
  

</head>

<body>


  <!-- Hero Section -->
  <header class="hero">
  <div class="hero-content">
    <h1 class="fw-light">Welcome to Premier Sr.Secondary School</h1>
    <h2>Shaping Future Leaders</h2>
    <p class="lead">Empowering youth for a better tomorrow</p>
    <a href="admission_form.php" class="btn btn-light btn-lg">Apply Now</a>
  </div>
</header>

 <?php
function isActive($page) {
  return basename($_SERVER['PHP_SELF']) == $page ? 'active' : '';
}
?>

<nav class="custom-navbar">
  <div class="navbar-inner">

    <a href="index.php" class="home-icon <?= isActive('index.php') ?>">
      <i class="fa fa-home"></i>
    </a>

    <a href="About-us.php" class="<?= isActive('About-us.php') ?>">About Us</a>

    <a href="Faculty.php" class="<?= isActive('Faculty.php') ?>">Faculty</a>

    <a href="Gallery.php" class="<?= isActive('Gallery.php') ?>">Gallery</a>

    <a href="admission_form.php" class="<?= isActive('admission_form.php') ?>">Admission</a>
    
    <a href="achievement.php" class="<?= isActive('achievement.php') ?>">Achievement</a>
  

  </div>
</nav>