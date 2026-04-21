<?php 
require_once "../admin/db.php";
$page_css = "faculty.css"; 
require 'include/header.php'; 

$query = "SELECT * FROM faculty ORDER BY department ASC, id DESC";
$result = $conn->query($query);

$currentDept = "";
?>

<section class="faculty-section">
  <h1 class="faculty-title">Faculty Members</h1>

<?php while ($row = $result->fetch_assoc()) { 

  if ($currentDept != $row['department']) {

    if ($currentDept != "") {
      echo "</div>"; // close previous grid
    }

    $currentDept = $row['department'];
    echo "<h2 class='department-title'>Department Of $currentDept</h2>";
    echo "<div class='faculty-grid'>";
  }
?>

  <div class="faculty-card">
    <div class="faculty-img">
      <img src="../uploads/faculty/<?= $row['faculty_image']; ?>" alt="">
    </div>

    <div class="faculty-info">
      <h3><?= $row['name']; ?></h3>
      <p><?= $row['qualification']; ?></p>
    </div>
  </div>

<?php } ?>

</div> <!-- last grid -->
</section>

<?php require 'include/footer.php';?>
</body>
</html>