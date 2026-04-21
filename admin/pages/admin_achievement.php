<?php
require_once "../db.php";

// Protect the Dashboard
if (!isset($_SESSION["admin"]["name"])) {
  header("Location: ../../public/admin_login.php");
  exit;
}

// ADD DATA
if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $category = $_POST['category'];

  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];

  move_uploaded_file($tmp, "../../uploads/achievements/" . $image);

  $sql = "INSERT INTO achievements (name, title, description, category, image) 
          VALUES ('$name','$title','$description','$category','$image')";

  $conn->query($sql);
}

// DELETE
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM achievements WHERE id=$id");
}

// FETCH DATA
$result = $conn->query("SELECT * FROM achievements ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Achievements</title>
   <!-----favicon---->
  <link rel="icon" type="image/x-icon" href="../../public/assets/favicon.ico?v=1">
  
  <link rel="stylesheet" href="../css/admin_achievement.css">

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
      <a href="admin_gallery.php">Gallery</a>
      <a href="admin_admission.php">Admissions</a>
      <a href="admin_faculty.php">Faculty</a>
      <a href="admin_achievement.php" class="active">Achievement</a>
      <a href="testimonials.php">Testimonials</a>
      <a href="../../public/logout.php">Logout</a>
    </nav>
  </aside>


  <div class="main">

    <!-- Topbar -->
    <header class="topbar">

      <h2>Manage Achievements</h2>
      <button class="open-modal-btn" onclick="openModal()">+ Add Achievement</button>
    </header>


    <hr>

    <!-- TABLE -->
    <table class="data-table">
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>Action</th>
      </tr>

      <?php
      $serial = 1;
      while ($row = $result->fetch_assoc()) { ?>

        <tr>
          <td><?php echo $serial++; ?></td>

          <td>
            <img src="../../uploads/achievements/<?= $row['image']; ?>" width="60">
          </td>

          <td><?= $row['name']; ?></td>

          <td><?= $row['category']; ?></td>

          <td>
            <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Delete?')" class="delete-btn">
              <i class="fa-solid fa-trash"></i>
            </a></a>
          </td>
        </tr>

      <?php } ?>

    </table>

    <!-----Achievement Modal------>
    <!-- Modal -->
    <div id="achievementModal" class="modal">

      <div class="modal-content">

        <span class="close-btn" onclick="closeModal()">&times;</span>

        <h2>Add Achievement</h2>

        <form method="POST" enctype="multipart/form-data" class="form-box">

          <input type="text" name="name" placeholder="Student Name" required>

          <input type="text" name="title" placeholder="Title (e.g. 1st Position)" required>

          <input type="text" name="description" placeholder="Description (HS Exam 2023)" required>

          <select name="category" required>
            <option value="">Select Category</option>
            <option value="Achievements">Achievements</option>
            <option value="Subject Toppers">Subject Toppers</option>
            <option value="Medical & Engineering">Medical & Engineering</option>
          </select>

          <label class="file-upload">
            Choose Image
            <input type="file" name="image" required>
          </label>

          <button type="submit" name="submit">Add Achievement</button>

        </form>

      </div>

    </div>
  </div>

  <!-- Modal -->
  <script>
    function openModal() {
      document.getElementById("achievementModal").classList.add("show");
    }

    function closeModal() {
      document.getElementById("achievementModal").classList.remove("show");
    }

    window.onclick = function(e) {
      let modal = document.getElementById("achievementModal");
      if (e.target === modal) {
        modal.classList.remove("show");
      }
    }
  </script>

</body>

</html>