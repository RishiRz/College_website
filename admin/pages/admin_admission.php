<?php
require_once "../db.php";

// Protect the Dashboard
if (!isset($_SESSION["admin"]["name"])) {
  header("Location: ../../public/admin_login.php");
  exit;
}

$query = "SELECT * FROM admissions ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admission</title>
   <!-----favicon---->
  <link rel="icon" type="image/x-icon" href="../../public/assets/favicon.ico?v=1">
  
  <link rel="stylesheet" href="../css/admin_admission.css">

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
      <a href="admin_admission.php" class="active">Admissions</a>
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
      <h1>Admission Applications</h1>
    </header>

    <!-- Table Section -->
    <section class="content">
      <table class="data-table">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>Photo</th>
            <th>Student Name</th>

            <th>Phone</th>
            <th>Form</th>

            <th>Applied On</th>
            <th>Status</th>
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
                  <img src="../../uploads/admissions/<?php echo $row['photo']; ?>" width="60">
                </td>

                <td><?php echo $row['full_name']; ?></td>

                <td><?php echo $row['phone']; ?></td>

                <td>
                  <a href="print_application.php?id=<?php echo $row['id']; ?>" target="_blank">
                    Preview
                  </a>
                </td>

                <td><?php echo $row['dob']; ?></td>

                <td>
                  <span class="status <?php echo $row['status']; ?>">
                    <?php echo ucfirst($row['status']); ?>
                  </span>
                </td>

                <td>

                  <button class="btn-approve" onclick="updateStatus(<?php echo $row['id']; ?>,'approved')">
                    Approve
                  </button>

                  <button class="btn-reject" onclick="updateStatus(<?php echo $row['id']; ?>,'rejected')">
                    Reject
                  </button>

                </td>

                <td>

                  <button onclick="deleteRecord(<?php echo $row['id']; ?>,'faculty')">
                    Delete
                  </button>

                </td>

              </tr>

          <?php
            }
          } else {
            echo "<tr><td colspan='8'>No Applications Found</td></tr>";
          }
          ?>

        </tbody>
      </table>
    </section>
  </div>





  <!-- js -->
  <script>
    function updateStatus(id, status) {

      if (confirm("Are you sure?")) {

        fetch("update_status.php", {

            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded"
            },

            body: `id=${id}&status=${status}`

          })
          .then(res => res.text())
          .then(data => {

            alert(data);
            location.reload();

          });

      }

    }


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