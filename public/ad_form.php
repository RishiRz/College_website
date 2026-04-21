<?php
require_once "../admin/db.php";
$page_css = "admission_form.css"; 
require 'include/header.php'; ; 

if (isset($_POST['submit'])) {

  // Collect form data
  $full_name = $_POST['full_name'];
  $mother_name = $_POST['mother_name'];
  $father_name = $_POST['father_name'];
  $address = $_POST['address'];
  $guardian_name = $_POST['guardian_name'];
  $nationality = $_POST['nationality'];
  $religion = $_POST['religion'];
  $category = $_POST['category'];
  $dob = $_POST['dob'];
  $local_guardian = $_POST['local_guardian'];
  $institution = $_POST['institution'];
  $division = $_POST['division'];
  $phone = $_POST['phone'];
  $total_marks = $_POST['total_marks'];
  $percentage = $_POST['percentage'];

  $marks_assamese = $_POST['marks_assamese'];
  $marks_english = $_POST['marks_english'];
  $marks_gm = $_POST['marks_gm'];
  $marks_gsc = $_POST['marks_gsc'];
  $marks_ssc = $_POST['marks_ssc'];
  $marks_evs = $_POST['marks_evs'];

  $stream = $_POST['stream'];

  $elective1 = $_POST['elective1'];
  $elective2 = $_POST['elective2'];
  $elective3 = $_POST['elective3'];
   $elective4 = $_POST['elective4'];
  $elective5 = $_POST['elective5'];
  $elective6 = $_POST['elective6'];

 

  // File Upload
  $photo = $_FILES['photo']['name'];
  $tmp = $_FILES['photo']['tmp_name'];

  $uploadDir = "../uploads/admissions/";
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  move_uploaded_file($tmp, $uploadDir . $photo);

  // Insert into DB
  $stmt = $conn->prepare("INSERT INTO admissions 
        (full_name, mother_name, father_name, address, guardian_name, nationality, religion, category, dob, local_guardian_name, institution_last_attended, division, photo,phone,total_marks,percentage,marks_assamese,marks_english,marks_gm,marks_gsc,marks_ssc,marks_evs,stream,elective1,elective2,elective3,elective4,elective5,elective6)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

  $stmt->bind_param(
    "sssssssssssssssssssssssssssss",
    $full_name,
    $mother_name,
    $father_name,
    $address,
    $guardian_name,
    $nationality,
    $religion,
    $category,
    $dob,
    $local_guardian,
    $institution,
    $division,
    $photo,
    $phone,
    $total_marks,
    $percentage,
    $marks_assamese,
    $marks_english,
    $marks_gm,
    $marks_gsc,
    $marks_ssc,
    $marks_evs,
    $stream,
    $elective1,
    $elective2,
    $elective3,
    $elective4,
    $elective5,
    $elective6
  );

  $stmt->execute();

  echo "<script>alert('Application Submitted Successfully');</script>";
}
?>

<!---------Fee Section------->
<section class="fees-section">

  <h1 class="fees-title">ADMISSION FEES (Session 2026–2027)</h1>

  <!-- a) Admission Fees -->
  <h3 class="fees-subtitle">a) 1st year Admission Fees:</h3>

  <!-- Science -->
  <table class="fees-table">
    <tr>
      <td><strong>1: Science –</strong></td>
      <td>18,000.00</td>
    </tr>
    <tr>
      <td>Silver Jubilee Concession</td>
      <td>1,000.00</td>
    </tr>
    <tr class="total">
      <td>Total due for admission</td>
      <td>17,000.00</td>
    </tr>
  </table>

  <!-- Arts -->
  <table class="fees-table">
    <tr>
      <td><strong>2: Arts –</strong></td>
      <td>13,000.00</td>
    </tr>
    <tr>
      <td>Silver Jubilee Concession</td>
      <td>4,000.00</td>
    </tr>
    <tr class="total">
      <td>Total due for admission</td>
      <td>9,000.00</td>
    </tr>
  </table>

  <!-- Commerce -->
  <table class="fees-table">
    <tr>
      <td><strong>3: Commerce –</strong></td>
      <td>8,000.00</td>
    </tr>
    <tr>
      <td>Silver Jubilee Concession</td>
      <td>1,000.00</td>
    </tr>
    <tr class="total">
      <td>Total due for admission</td>
      <td>7,000.00</td>
    </tr>
  </table>

  <!-- Monthly Fees -->
  <h3 class="fees-subtitle">b) Monthly Fees</h3>

  <p class="fees-note">
    The session fees i.e. tuition fees of 12 months are as under:
  </p>

  <table class="fees-table">
    <tr>
      <td>1</td>
      <td>
        Science @ 1550 per month × 12 months<br>
        Payable in two equal installments (July & Nov.)
      </td>
      <td class="amount">18,600/-</td>
    </tr>

    <tr>
      <td>2</td>
      <td>
        Commerce @ 1300 per month × 12 months<br>
        Payable in two equal installments (July & Nov.)
      </td>
      <td class="amount">15,600/-</td>
    </tr>

    <tr>
      <td>3</td>
      <td>
        Arts @ 1300 per month × 12 months<br>
        Payable in two equal installments (July & Nov.)
      </td>
      <td class="amount">15,600/-</td>
    </tr>
  </table>

  <!-- Exam Fees -->
  <h3 class="fees-subtitle">c) Examination Fees</h3>

  <ul class="fees-list">
    <li>Internal Examination Fees 1000/- (per year)</li>
    <li>
      Annual Examination conducted by DLIEC. Exam fees will be declared later.
    </li>
  </ul>

  <!-- Important Note -->
  <p class="fees-warning">
    NOTE – BEFORE FILLING UP THE ADMISSION FORM PLEASE MAKE A CALL TO VERIFY THE PERCENTAGE AGAINST STREAM SELECTED. 
    PHONE NO 9854711550. AFTER SUBMISSION OF FILL UP FORMS, YOU WILL RECEIVE 
    A CONFIRMATION MESSAGE AND PAY THE ADMISSION FEES TO US THROUGH OUR BANK DETAILS / QR CODE GIVEN BELOW.
  </p>

</section>


<!----- Uniform Section ----->
<section class="uniform-section">

  <h1 class="uniform-title">Uniform for the Students of the Academy</h1>

  <p class="uniform-desc">
    The uniform of the students of RSA are compulsory. No students will be allowed without specific uniform.
    The uniforms are as shown below:
  </p>

  <div class="uniform-box">

    <p><strong>Boy’s:</strong> 1.White shirt with monogram and ash colour trouser.</p>

    <p><strong>Girl’s:</strong> 2.White shirt with monogram and ash colour skirt.</p>

    <p><strong>Tie:</strong> 3.Coffee colour with white crossed.</p>

    <p><strong>Shoe & Sock:</strong> 4.Black shoe and white sock.</p>

    <p><strong>Note:</strong> 5.Relaxation in some special ground.</p>

    <p class="uniform-footer">
      Dresses and copies are supplied by our authorised shop available at academy campus.
    </p>

  </div>

</section>



<!--------- Admission Form  -------->
  <form method="POST" enctype="multipart/form-data">
    <div class="form-container">

      <h2>PREMIER ACADEMY, MANGALDAI</h2>
      <h3>Senior Secondary School (Arts, Commerce & Science)</h3>
      <p style="text-align:center; font-weight:550;">Application for Admission in H.S. First/Second Year</p>

      <div class="photo-box">
        <img id="previewImg" style="display:none;">
        <label for="photoInput" class="upload-label">Click to Upload</label>
        <input type="file" name="photo" id="photoInput" accept="image/*" required>
      </div>

      <div class="section">

        <div class="row">
          <label>1. Full Name (Block Letters)</label>
          <input type="text" name="full_name">
        </div>

        <div class="row">
          <label>2. Mother's Name</label>
          <input type="text" name="mother_name">
        </div>

        <div class="row">
          <label>3. Father's Name</label>
          <input type="text" name="father_name">
        </div>

        <div class="row">
          <label>4. Full Address</label>
          <input type="text" name="address">
        </div>

        <div class="row">
          <label>5. Phone Number</label>
          <input type="text" name="phone">
        </div>

        <div class="row">
          <label>6. Guardian's Name</label>
          <input type="text" name="guardian_name">
        </div>

        <div class="row">
          <label>7. Nationality</label>
          <input type="text" name="nationality">
        </div>

        <div class="row">
          <label>8. Religion</label>
          <input type="text" name="religion">
        </div>

        <div class="row">
          <label>9. SC/ST/OBC</label>
          <select name="category">
            <option value="">Select</option>
            <option>General</option>
            <option>SC</option>
            <option>ST</option>
            <option>OBC</option>
          </select>
        </div>

        <div class="row">
          <label>10. Date of Birth</label>
          <input type="date" name="dob">
        </div>

        <div class="row">
          <label>11. Local Guardian's Name</label>
          <input type="text" name="local_guardian">
        </div>

        <div class="row">
          <label>12. Institution Last Attended</label>
          <input type="text" name="institution">
        </div>

        <div class="row">
          <label>13. H.S.L.C Result (Division)</label>
          <input type="text" name="division">
        </div>

        <div class="row">
          <label>14. Stream</label>
          <select name="stream">
            <option value="">Select</option>
            <option>Atrs</option>
            <option>Commerce</option>
            <option>Science</option>

          </select>
        </div>

      </div>

      <!-- Marks Table -->
      <h3>Marks Obtained in H.S.L.C Exam</h3>

      <table>

        <tr>
          <th>Subjects</th>
          <th>Assamese</th>
          <th>English</th>
          <th>G.M.</th>
          <th>G.Sc.</th>
          <th>S.Sc.</th>
          <th>E.V.S.</th>
          <th>Total</th>
          <th>Division</th>
          <th>%</th>
        </tr>

        <tr>
          <td>Full Marks</td>
          <td>100</td>
          <td>100</td>
          <td>100</td>
          <td>100</td>
          <td>100</td>
          <td>100</td>
          <td>600</td>
          <td>-</td>
          <td>-</td>
        </tr>

        <tr>
          <td>Marks Secured</td>

          <td><input type="number" name="marks_assamese" class="marks"></td>
          <td><input type="number" name="marks_english" class="marks"></td>
          <td><input type="number" name="marks_gm" class="marks"></td>
          <td><input type="number" name="marks_gsc" class="marks"></td>
          <td><input type="number" name="marks_ssc" class="marks"></td>
          <td><input type="number" name="marks_evs" class="marks"></td>

          <td><input type="text" name="total_marks" id="total" readonly></td>

          <td><input type="text" name="division"></td>

          <td><input type="text" name="percentage" id="percentage" readonly></td>

        </tr>

      </table>

      <!-- Subjects -->
      <div class="section">
        <h3>Subjects to be Taken (1st Year)</h3>
        <p><strong>Compulsory:</strong> English, Assamese, Environmental Science</p>
        <p><strong>Elective:</strong> <input type="text" placeholder="Elective 1" name="elective1">
          <input type="text" placeholder="Elective 2" name="elective2">
          <input type="text" placeholder="Elective 3" name="elective3">
        </p>

        <h3>Subjects to be Taken (2nd Year)</h3>
        <p><strong>Compulsory:</strong> English, Assamese</p>
        <p><strong>Elective:</strong> <input type="text" placeholder="Elective 1" name="elective4">
          <input type="text" placeholder="Elective 2" name="elective5">
          <input type="text" placeholder="Elective 3" name="elective6">
        </p>
      </div>
      <div class="text-center mt-4">
        <button type="submit" name="submit" class="btn btn-primary">Submit Application</button>
      </div>
    </div>
  </form>



  <!-- bank-section -->
<section class="bank-section">

  <h1 class="bank-title">BANK ACCOUNT DETAILS</h1>

  <div class="bank-container">

    <!-- Left Content -->
    <div class="bank-details">
      <p class="bankName"><strong>CENTRAL BANK OF INDIA</strong></p>

      <p>Branch: Mangaldai Branch</p>

      <p>Account Name:  Academy Jr. College Mgt. Committee</p>

      <p>Account No: 2190345689</p>

      <p>IFSC: CBIN0283240</p>
    </div>

    <!-- Right QR -->
    <div class="bank-qr">
      <img src="assets/qr.jpg" alt="QR Code">
    </div>
    <!-- Important Note -->
    
  </div>
  <p class="fees-warning">
    <a href="https://wa.me/919854711550" target="_blank">
  NOTE: If you have made any payment, please contact us on WhatsApp at 9854711550.
</a>
  </p>

</section>


  <!-- Footer -->
  <?php require 'include/footer.php';?>

  <!-- js     -->
  <script>
    document.getElementById("photoInput").addEventListener("change", function(event) {

      const file = event.target.files[0];
      if (!file) return;

      const reader = new FileReader();

      reader.onload = function(e) {
        const preview = document.getElementById("previewImg");
        preview.src = e.target.result;
        preview.style.display = "block";
      };

      reader.readAsDataURL(file);
    });
  </script>

  <script>
    const marksInputs = document.querySelectorAll(".marks");

    marksInputs.forEach(input => {
      input.addEventListener("input", calculateMarks);
    });

    function calculateMarks() {

      let total = 0;

      marksInputs.forEach(input => {
        total += Number(input.value);
      });

      document.getElementById("total").value = total;

      let percentage = (total / 600) * 100;

      document.getElementById("percentage").value = percentage.toFixed(2);

    }
  </script>
</body>

</html>