<?php
require_once "../db.php";

// Protect the Dashboard
if (!isset($_SESSION["admin"]["name"])) {
  header("Location: ../../public/admin_login.php");
  exit;
}

/* ===== Upload Logic ===== */
if (isset($_POST['upload'])) {
  $title = $_POST['title'];
  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];
  $description = $_POST['description'];
  $section = $_POST['section'];




  $uploadDir = "../../uploads/gallery/";
  move_uploaded_file($tmp, $uploadDir . $image);

  $stmt = $conn->prepare("INSERT INTO gallery (image_name, image_title, description, section, upload_date) VALUES (?, ?, ?, ?, CURDATE())");
  $stmt->bind_param("ssss", $image, $title, $description, $section);
  $stmt->execute();

  header("Location: admin_gallery.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Gallery</title>
   <!-----favicon---->
  <link rel="icon" type="image/x-icon" href="../../public/assets/favicon.ico?v=1">
  
  <link rel="stylesheet" href="../css/admin_gallery.css">

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
      <a href="dashboard.php">Dashboard</a>
      <a href="admin_gallery.php" class="active">Gallery</a>
      <a href="admin_admission.php">Admissions</a>
      <a href="admin_faculty.php">Faculty</a>
      <a href="admin_achievement.php">Achievement</a>
      <a href="testimonials.php">Testimonials</a>
      <a href="../../public/logout.php">Logout</a>
    </nav>
  </aside>

  <!-- Main -->
  <div class="main">

    <!-- Topbar -->
    <header class="topbar">
      <h1>Gallery Management</h1>
      <button class="btn-primary">+ Add New Image</button>
    </header>

    <!-- Table -->
    <section class="content">
      <table class="data-table">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>Image Preview</th>
            <th>Image Name</th>
            <th>Image Title</th>
            <th>Section</th>
            <th>Upload Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sr = 1;
          $result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
          while ($row = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $sr++; ?></td>
              <td>
                <img src="../../uploads/gallery/<?= $row['image_name']; ?>" width="70">
              </td>
              <td><?= $row['image_name']; ?></td>
              <td><?= $row['image_title']; ?></td>
              <td><?= $row['section']; ?></td>
              <td><?= $row['upload_date']; ?></td>
              <td>
                <button onclick="deleteRecord(<?php echo $row['id']; ?>,'gallery')">
                  Delete
                </button>
              </td>
            </tr>
          <?php } ?>

        </tbody>
      </table>
    </section>

  </div>

  <!-- Modal (Form UI only) -->
  <div class="modal">
    <div class="modal-content">
      <h2>Upload New Image</h2>

      <form method="POST" enctype="multipart/form-data">
        <label>Choose Image</label>
        <input type="file" name="image" required>

        <label>Image Title (optional)</label>
        <input type="text" name="title" placeholder="Enter title">

        <label>Description</label>
        <textarea name="description"></textarea>

        <label>Select Section</label>
        <select name="section" required>
          <option value="event">Events</option>
          <option value="gallery">Gallery</option>
        </select>

        <div class="modal-actions">
          <button type="submit" name="upload" class="btn-primary">Upload</button>
          <button type="button" class="btn-secondary">Cancel</button>
        </div>
      </form>

    </div>
  </div>


  <script>
    // Select elements
    const openBtn = document.querySelector(".btn-primary");
    const modal = document.querySelector(".modal");
    const cancelBtn = document.querySelector(".btn-secondary");

    // Open modal
    openBtn.addEventListener("click", () => {
      modal.style.display = "flex";
    });

    // Close modal (Cancel button)
    cancelBtn.addEventListener("click", () => {
      modal.style.display = "none";
    });

    // Close modal when clicking outside content
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    });
  </script>


  <script>
    function deleteRecord(id, type) {

      if (confirm("Delete this record?")) {

        fetch("delete.php", {

            method: "POST",

            headers: {
              "Content-Type": "application/x-www-form-urlencoded"
            },

            body: `id=${id}&type=${type}`

          })

          .then(res => res.text())
          .then(data => {
            alert(data);
            location.reload();
          });

      }

    }
  </script>

</body>

</html>