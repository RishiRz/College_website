<?php
require_once "../db.php";

// Protect the Dashboard
if (!isset($_SESSION["admin"]["name"])) {
  header("Location: ../../public/admin_login.php");
  exit;
}

/* ===== Upload Logic ===== */
if (isset($_POST['upload'])) {

  $name = $_POST['name'];
  $subject = $_POST['subject'];
  $qualification = $_POST['qualification'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $department = $_POST['department'];

  $image = time() . "_" . $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];

  $uploadDir = "../../uploads/faculty/";

  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  move_uploaded_file($tmp, $uploadDir . $image);

  $stmt = $conn->prepare(
    "INSERT INTO faculty (faculty_image, name,email,phone, subject, qualification,department)
VALUES (?, ?, ?, ?,?,?,?)"
  );

  if (!$stmt) {
    die("SQL Error: " . $conn->error);
  }

  $stmt->bind_param("ssssss", $image, $name, $email, $phone, $subject, $qualification);

  $stmt->execute();

  header("Location: admin_faculty.php");
}


$query = "SELECT * FROM faculty ORDER BY id DESC";
$result = $conn->query($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Faculty</title>
   <!-----favicon---->
  <link rel="icon" type="image/x-icon" href="../../public/assets/favicon.ico?v=1">
  
  <link rel="stylesheet" href="../css/admin_faculty.css">

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
      <a href="admin_gallery.php">Gallery</a>
      <a href="admin_admission.php">Admissions</a>
      <a href="admin_faculty.php" class="active">Faculty</a>
      <a href="admin_achievement.php">Achievement</a>
      <a href="testimonials.php">Testimonials</a>
      <a href="../../public/logout.php">Logout</a>
    </nav>
  </aside>

  <!-- Main -->
  <div class="main">

    <!-- Topbar -->
    <header class="topbar">
      <h1>Faculty Management</h1>
      <button class="btn-primary">+ Add New Faculty</button>
    </header>

    <!-- Table Section -->
    <section class="content">
      <table class="data-table">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>Name</th>
            <th>Image</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subject</th>
            <th>Qualification</th>
            <th>Department</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>




          <?php
          $serial = 1;
          if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
          ?>

              <tr>

                <td><?php echo $serial++; ?></td>

                <td>
                  <img src="../../uploads/faculty/<?php echo $row['faculty_image']; ?>" width="60">
                </td>

                <td><?php echo $row['name']; ?></td>

                <td><?php echo $row['email']; ?></td>

                <td><?php echo $row['phone']; ?></td>

                <td><?php echo $row['subject']; ?></td>

                <td><?php echo $row['qualification']; ?></td>

                <td><?php echo $row['department']; ?></td>








                <td>


                  <button onclick="deleteRecord(<?php echo $row['id']; ?>,'faculty')">
                    Delete
                  </button>

                </td>

              </tr>

          <?php
            }
          }
          ?>

        </tbody>
      </table>
    </section>

  </div>



  <!-- Modal (Form UI only) -->
  <div class="modal">
    <div class="modal-content">
      <h2>Faculty Details</h2>

      <form method="POST" enctype="multipart/form-data">
        <label>Choose Image</label>
        <input type="file" name="image" required>

        <label>Name</label>
        <input type="text" name="name" placeholder="Enter Name">
        <label>Email</label>
        <input type="Email" name="email" placeholder="Email">
        <label>Phone Number</label>
        <input type="text" name="phone" placeholder="Phone Number">
        <label>Subject</label>
        <input type="text" name="subject" placeholder="Subject">
        <label>Qualification</label>
        <input type="text" name="qualification" placeholder="Qualification">

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