<?php 
require_once "../admin/db.php";
$page_css = "achievement.css"; 
require 'include/header.php'; 

$query = "SELECT * FROM achievements ORDER BY category ASC, id DESC";
$result = $conn->query($query);

$currentCategory = "";
?>

<section class="achievement-section">

  <h1 class="main-title">Achievements</h1>

<?php while ($row = $result->fetch_assoc()) { 

  if ($currentCategory != $row['category']) {

    if ($currentCategory != "") {
      echo "</div>"; // close previous grid
    }

    $currentCategory = $row['category'];

    echo "<h2 class='category-title'>$currentCategory</h2>";
    echo "<div class='achievement-grid'>";
  }
?>

  <div class="achievement-card">
    <img src="../uploads/achievements/<?= htmlspecialchars($row['image']); ?>" alt="">
    
    <h4><?= htmlspecialchars($row['name']); ?></h4>
    
    <p class="title"><?= htmlspecialchars($row['title']); ?></p>
    
    <p class="desc"><?= htmlspecialchars($row['description']); ?></p>
  </div>

<?php } ?>

</div>
</section>

<?php require 'include/footer.php'; ?>
</body>
</html>