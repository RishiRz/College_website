<?php
require 'include/header.php';
require_once __DIR__ . '/../admin/db.php';
// require 'db.php';


?>





<section class="home-section">

  <!-- ===== SLIDER ===== -->
  <div class="slider">
    <button class="slider-btn left" onclick="prevSlide()">
      <i class="fa fa-chevron-left"></i>
    </button>

    <button class="slider-btn right" onclick="nextSlide()">
      <i class="fa fa-chevron-right"></i>
    </button>

    <div class="slides" id="slides">
      <div class="slide">
        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978" alt="Image 1">
        <div class="slide-caption">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, modi!
        </div>
      </div>

      <div class="slide" id="slides">
        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1" alt="Image 2">
        <div class="slide-caption">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe, assumenda?
        </div>
      </div>

      <div class="slide" id="slides">
        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7" alt="Image 3">
        <div class="slide-caption">
          Congratulations to All Achievers
        </div>
      </div>
    </div>
  </div>

  
  <!-- ===== MESSAGE FROM PRINCIPAL ===== -->
  <div class="message-box">
    <h3>A Message from the Principal</h3>

    <div class="principal-info">
      <img src="" alt="Principal">
      <p>
     আমাৰ বিদ্যালয়খন শিক্ষাৰ উৎকর্ষতা, নৈতিক মূল্যবোধ আৰু ছাত্ৰ-ছাত্ৰীৰ সৰ্বাংগীন বিকাশৰ লক্ষ্যৰে প্ৰতিশ্ৰুতিবদ্ধ।
        আমি বিশ্বাস কৰোঁ যে শিক্ষা কেৱল জ্ঞান আহৰণ নহয়, ই হৈছে চৰিত্ৰ গঠন আৰু ব্যক্তিত্ব বিকাশৰ এক প্ৰক্ৰিয়া। আমাৰ অভিজ্ঞ আৰু নিবেদিতপ্ৰাণ শিক্ষকসকলে ছাত্ৰ-ছাত্ৰীসকলৰ মাজত ইতিবাচক চিন্তা, দায়িত্ববোধ আৰু আত্মবিশ্বাস গঢ়ি তুলিবলৈ সদায় প্ৰচেষ্টা চলাই আছে।
      </p>
    </div>

    <p>
       
         আমাৰ বিদ্যালয়ত শৃংখলা, সততা, নতুন চিন্তা আৰু পাৰস্পৰিক সন্মানক গুৰুত্ব দিয়া হয়। আমি ছাত্ৰ-ছাত্ৰীৰ কেৱল পৰীক্ষাত সফলতা নহয়, জীৱনত সফল আৰু দায়িত্বশীল নাগৰিক হিচাপে গঢ়ি তোলাৰ লক্ষ্য লৈ আগবাঢ়িছোঁ।

      আপোনালোকক আমাৰ বিদ্যালয়ৰ শৈক্ষিক কাৰ্যসূচী, সাফল্য আৰু বিভিন্ন কাৰ্যকলাপৰ বিষয়ে অধিক জানিবলৈ এই ৱেবছাইট পৰিদৰ্শন কৰিবলৈ আহ্বান জনালোঁ। আহক, আমি সকলোৱে মিলি আমাৰ সন্তানসকলৰ উজ্জ্বল ভৱিষ্যৎ গঢ়ি তোলোঁ।

     
    </p>

    <p class="right">
      - Pranita Baruah <br>
      M.A. (Double) B. Ed. <br>
    </p>
  </div>

</section>

<!-- Events  -->
<?php
$events = $conn->query("
  SELECT * FROM gallery 
  WHERE section = 'event' 
  ORDER BY id DESC 

");
?>
<section class="events-section">
  <div class="container">

    <h2>Events</h2>

    <!-- 🔹 TOP: 4 SMALL IMAGES -->
    <div class="events-top">
      <?php
      $count = 0;
      $events->data_seek(0); // reset pointer

      while ($row = $events->fetch_assoc()) {
        if ($count >= 4) break;
      ?>
        <div class="small-card">
          <img src="../uploads/gallery/<?= $row['image_name']; ?>">
        </div>
      <?php $count++;
      } ?>
    </div>

    <!-- 🔹 BOTTOM: FEATURED EVENT -->
    <div class="featured-event">

      <?php
      $events->data_seek(0);

      $count = 0;
      while ($row = $events->fetch_assoc()) {
        if ($count >= 2) break;
      ?>

        <div class="event-block">

          <h3><?= $row['image_title']; ?></h3>

          <p class="date"><?= $row['upload_date']; ?></p>

          <img src="../uploads/gallery/<?= $row['image_name']; ?>">

          <p class="desc"><?= $row['description']; ?></p>

        </div>

      <?php $count++;
      } ?>

    </div>
  </div>

</section>


<?php
$gallery = $conn->query("
  SELECT * FROM gallery 
  WHERE section = 'gallery' 
  ORDER BY id DESC 

");
?>
<section class="gallery-section">
  <div class="container">
    <h2>Gallery</h2>

    <div class="custom-slider">

      <div class="slides-wrapper">

        <?php
        $count = 0;
        while ($row = $gallery->fetch_assoc()) {

          if ($count % 2 == 0) {
            echo '<div class="slide">';
          }
        ?>

          <div class="slide-item">
            <img src="../uploads/gallery/<?= $row['image_name']; ?>">
            <h4><?= $row['image_title']; ?></h4>
          </div>

        <?php
          if ($count % 2 == 1) {
            echo '</div>'; // close slide after 2 items
          }

          $count++;
        }

        // if odd count → close last slide
        if ($count % 2 != 0) {
          echo '</div>';
        }
        ?>

      </div>

      <!-- NAV -->
      <button class="slider-btn prev">&#10094;</button>
      <button class="slider-btn next">&#10095;</button>

    </div>

  </div>
</section>



<!-- Testimonials & Stats -->

<section class="testimonial-section">
  <h2>What Students Say</h2>
  
  <div class="testimonial-container">
    <?php
    $res = $conn->query("SELECT * FROM testimonials LIMIT 3");

    while ($row = $res->fetch_assoc()) {
    ?>
      <div class="testimonial-card">

        <div class="student-img">
          <img src="../uploads/testimonials/<?php echo $row['image'] ?: 'default.png'; ?>" alt="Student">
        </div>

        <h3><?php echo $row['name']; ?></h3>

        <p>"<?php echo $row['message']; ?>"</p>

      </div>
    <?php } ?>
  </div>
</section>

<div class="text-center mt-4">
 <span class="h4">100%</span> student pass rate
</div>
</div>

</section>

<!-- Contact Button -->
<div class="contact-btn" onclick="toggleContact()">
  <i class="fa-solid fa-envelope"></i> Contact Us
</div>

<!-- Side Popup -->
<div class="contact-panel" id="contactPanel">
  <span class="close-btn" onclick="toggleContact()">×</span>
  
  <h3>Contact Us</h3>
  <p><strong>Phone:</strong> +91 8638650745</p>
  <p><strong>Email:</strong> director@premierseniorsecondaryschool.in</p>
  <p><strong>Address:</strong> Tangla road, Mangaldoi, Darrang, Assam-784125</p>
</div>

    <!--googlemap-->
<div class="map-container ">
  <iframe 
    src="https://www.google.com/maps?q=Premier+Senior+Secondary+School+Mangaldoi&output=embed"
    width="100%" 
    height="250" 
    style="border:0;" 
    allowfullscreen="" 
    loading="lazy">
  </iframe>
</div>

<!-- footer -->
<?php require 'include/footer.php'; ?>



<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- 1. jQuery FIRST -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- 2. Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- custom JS -->
<script src="../js/script.js"></script>



</body>

</html>