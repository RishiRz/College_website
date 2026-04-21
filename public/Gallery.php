<?php 
require_once '../admin/db.php';
$page_css = "gallery.css"; 
require 'include/header.php'; 
?>

<section class="gallery-section">
  <h1 class="gallery-title">Premier Senior Secondary School</h1>

  <div class="gallery-grid">
    <?php
    $result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
    ?>
        <div class="gallery-item">
  <div class="gallery-img">

    <a href="../uploads/gallery/<?= htmlspecialchars($row['image_name']); ?>" 
       data-fancybox="gallery" 
       data-caption="<?= htmlspecialchars($row['image_title']); ?>">

      <img src="../uploads/gallery/<?= htmlspecialchars($row['image_name']); ?>" alt="Gallery Image">

      <div class="overlay">
        <span class="zoom-icon">
          <i class="fa-solid fa-magnifying-glass-plus"></i>
        </span>
      </div>

    </a>

  </div>
</div>
    <?php
      }
    } else {
      echo "<p class='text-center'>No images available.</p>";
    }
    ?>
  </div>
</section>

<script>
  Fancybox.bind("[data-fancybox='gallery']", {
    Thumbs: false,
    Toolbar: {
      display: ["close"],
    },
  });
</script>

<?php require 'include/footer.php';?>
</body>
</html>