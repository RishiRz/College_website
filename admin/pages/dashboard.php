<?php
require_once "../db.php";

// Protect the Dashboard
if (!isset($_SESSION["admin"]["id"])) {
  header("Location: ../../public/admin_login.php");
  exit;
}


// Total Admissions
$res1 = $conn->query("SELECT COUNT(*) as total FROM admissions");
$totalAdmissions = $res1->fetch_assoc()["total"];

// Total Gallery
$res2 = $conn->query("SELECT COUNT(*) as total FROM gallery");
$totalGallery = $res2->fetch_assoc()["total"];

// Total Faculty
$res3 = $conn->query("SELECT COUNT(*) as total FROM gallery");
$totalFaculty = $res3->fetch_assoc()["total"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>

  <!-----favicon---->
  <link rel="icon" type="image/x-icon" href="../../public/assets/favicon.ico?v=1">

  <!----Custom CSS------>
  <link rel="stylesheet" href="../css/dashboard.css">

  <!-----fonts-aowesome----->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="admin-info">
      <i class="fa-solid fa-user-circle"></i>
      <span><?php echo $_SESSION["admin"]["name"] ?? 'Admin'; ?></span>
    </div>
    <nav>
      <a href="dashboard.php" class="active">Dashboard</a>
      <a href="admin_gallery.php">Gallery</a>
      <a href="admin_admission.php">Admissions</a>
      <a href="admin_faculty.php">Faculty</a>
      <a href="admin_achievement.php">Achievement</a>
      <a href="testimonials.php">Testimonials</a>
      <a href="../../public/logout.php">Logout</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="main">

    <!-- Topbar -->
    <header class="topbar">
      <h1>Dashboard</h1>
      <div class="admin-info">
        <span>Admin</span>
      </div>
    </header>


    <!-- Content Area -->
    <!-- <section class="content">
      <h2>Welcome to Admin Panel</h2>
      <p>
        Use the sidebar to manage gallery images, admission forms,
        and other college data.
      </p>
    </section> -->


    <!-- Cards -->
    <section class="cards">
      <div class="card">
        <h3>Total Admissions</h3>
        <p><?php echo $totalAdmissions; ?></p>
      </div>
      <div class="card">
        <h3>Gallery Images</h3>
        <p><?php echo $totalGallery; ?></p>
      </div>
      <div class="card">
        <h3>Faculty</h3>
        <p><?php echo $totalFaculty; ?></p>
      </div>
      
    </section>

    

  </div>


  </script>
</body>

</html>