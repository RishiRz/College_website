<?php

require_once "../db.php";

if (!isset($_SESSION["admin"]["id"])) {
    header("Location: ../../public/admin_auth.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? '');
    $message = trim($_POST["message"] ?? '');

    if (!$name || !$message) {
        echo "All fields required";
        exit;
    }

    // image upload
    $image = "";

    if (!empty($_FILES["image"]["name"])) {

        $allowed = ["jpg", "jpeg", "png", "webp"];
        $ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            echo "Invalid image type";
            exit;
        }

        $image = time() . "." . $ext;
        move_uploaded_file($_FILES["image"]["tmp_name"], "../../uploads/testimonials/" . $image);
    }

    $stmt = $conn->prepare("INSERT INTO testimonials(name, message, image) VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $name, $message, $image);
    $stmt->execute();

    header("Location: testimonials.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Testimonials</title>
     <!-----favicon---->
  <link rel="icon" type="image/x-icon" href="../../public/assets/favicon.ico?v=1">

    <link rel="stylesheet" href="../css/testimonials.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="admin-info">
            <i class="fa-solid fa-user-circle"></i>
            <span><?php echo $_SESSION["admin"]["name"]; ?></span>
        </div>

        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="admin_gallery.php">Gallery</a>
            <a href="admin_admission.php">Admissions</a>
            <a href="admin_faculty.php">Faculty</a>
            <a href="admin_achievement.php">Achievement</a>
            <a href="testimonials.php" class="active">Testimonials</a>
            <a href="../../public/logout.php">Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main">

        <!-- Topbar -->
        <header class="topbar">
            <h1>Testimonials</h1>
            <button class="open-modal-btn" onclick="openModal()">
                + Add Testimonial
            </button>
        </header>

        <!-- Display Students -->

        <table class="table table-bordered align-middle">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM testimonials ORDER BY id DESC");
                $serial = 1;

                while ($row = $res->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $serial++; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['message']; ?></td>

                        <td>
                            <?php if ($row['image']) { ?>
                                <img src="../../uploads/testimonials/<?php echo $row['image']; ?>" width="50" height="50" style="border-radius:6px; object-fit:cover;">
                            <?php } ?>
                        </td>

                        <td>
                            <a href="delete_testimonial.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this testimonial?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>

        <!-- Modal  -->
        <div id="testimonialModal" class="custom-modal">

        <div class="custom-modal-content"> <!-- ✅ FIXED CLASS -->

            <!-- Header -->
            <div class="modal-header">
                <h5>Add Testimonial</h5>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" class="form-box">

                    <input type="text" name="name" placeholder="Student Name" required>

                    <textarea name="message" placeholder="Message" required></textarea>

                    <input type="file" name="image">

                    <button type="submit">Add</button>

                </form>
            </div>

        </div>

    </div>


    </div>




    
    



    <script>
        function openModal() {
            document.getElementById("testimonialModal").classList.add("show");
        }

        function closeModal() {
            document.getElementById("testimonialModal").classList.remove("show");
        }

        // close when clicking outside
        window.onclick = function(e) {
            let modal = document.getElementById("testimonialModal");
            if (e.target === modal) {
                modal.classList.remove("show");
            }
        }
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>