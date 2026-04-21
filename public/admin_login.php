<?php

require_once "../admin/db.php";
date_default_timezone_set("Asia/Kolkata");

/* ================= HANDLE POST ================= */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {

  $action = $_POST["action"];

  /* CREATE */
  if ($action === "create") {

    $name = trim($_POST["adminName"]);
    $phone = trim($_POST["phone"]);
    $password = md5($_POST["password"]);

    if (empty($name) || empty($phone) || empty($password)) {
      echo "Fill All Inputs!";
      exit;
    }

    $stmt = $conn->prepare("INSERT INTO admin_users(name,phone,password,role) VALUES(?,?,?,?)");
    $role = "admin";
    $stmt->bind_param("ssss", $name, $phone, $password, $role);

    echo $stmt->execute() ? "success" : "error";
    exit;
  }

  /* LOGIN */
  if ($action === "login") {

  $phone = trim($_POST["phone"]);
  $password = md5($_POST["password"]);

  $stmt = $conn->prepare("SELECT id, name, password FROM admin_users WHERE phone=?");
  $stmt->bind_param("s", $phone);
  $stmt->execute();
  $res = $stmt->get_result();

  if ($row = $res->fetch_assoc()) {

    if ($password === $row["password"]) {

      // ✅ Direct login (no OTP)
     
      $_SESSION["admin"] = [
  "id" => $row["id"],
  "name" => $row["name"]
];

      echo "success";

    } else {
      echo "invalid_password";
    }

  } else {
    echo "user_not_found";
  }

  exit;
}

  
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Premier Senior Secondary School</title>
 <!-----favicon---->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico?v=1">

  <!-----css---->
  <link rel="stylesheet" href="admin_login.css">

  <!-----bootstrap---->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <div class="card-container">

    <!-- LOGIN CARD -->
    <div id="loginCard" class="card p-4" style="width:380px">

      <h4 class="text-center mb-3">Admin Login</h4>

      <input type="tel" id="loginphone" class="form-control mb-2" placeholder="Phone Number">
      <input type="password" id="loginPassword" class="form-control mb-2" placeholder="Password">

      <button class="btn btn-primary w-100 mb-2" onclick="login()">Login</button>



      <p class="text-center">
        <a href="#" onclick="showForgot()">Forgot Password?</a>
      </p>


      <hr>

      <button class="btn btn-outline-dark w-100" onclick="showCreate()">
        Create Admin
      </button>

    </div>
  
    <!-- FORGOT CARD -->
    <div id="forgotCard" class="card p-4 d-none" style="width:380px">

      <h4 class="text-center mb-3">Forgot Password</h4>

      <input type="tel" id="forgotphone" class="form-control mb-2" placeholder="Phone Number">

      <button id="sendOtpBtn" class="btn btn-warning w-100 mb-2" onclick="sendForgotOTP()">
        Send OTP
      </button>

      <!-- 👇 HIDDEN SECTION -->
      <div id="resetSection" class="d-none">

        <div class="otp-container">
          <input type="text" maxlength="1" class="otp-input">
          <input type="text" maxlength="1" class="otp-input">
          <input type="text" maxlength="1" class="otp-input">
          <input type="text" maxlength="1" class="otp-input">
          <input type="text" maxlength="1" class="otp-input">
          <input type="text" maxlength="1" class="otp-input">
        </div>

        <input type="hidden" id="forgotOtp">

        <input type="password" id="resetPasswordField" class="form-control mb-2" placeholder="New Password">

        <div class="d-flex justify-content-between align-items-center mt-2">
  <p id="timer" class="text-muted mb-0"></p>

  <button id="resendBtn" class="btn btn-link p-0 " onclick="resendOTP()">
    Resend OTP
  </button>
</div>

        <!-- ✅ MESSAGE DISPLAY -->
        <div id="message" class="text-center mb-2 text-danger"></div>

        <button id="resendBtn" class="btn btn-secondary w-100 mb-2 d-none" onclick="resendOTP()">
          Resend OTP
        </button>

        <button class="btn btn-success w-100 mb-2" onclick="resetPassword()">
          Reset Password
        </button>

      </div>
      <p class="text-center">
        <a href="#" onclick="showLogin()">Back to Login</a>
      </p>

    </div>


  </div>

  <!------Create Account----->
  <div id="createCard" class="card p-4 d-none" style="width:380px">

    <h4 class="text-center mb-3">Create Admin</h4>

    <input type="text" id="adminName" class="form-control mb-2" placeholder="Name">

    <input type="tel" id="createphone" class="form-control mb-2" placeholder="Phone Number">

    <input type="password" id="createPassword" class="form-control mb-2" placeholder="Password">

    <button class="btn btn-success w-100 mb-2" onclick="createAccount()">
      Create Account
    </button>

    <p class="text-center">
      <a href="#" onclick="showLogin()">Back to Login</a>
    </p>

  </div>

  </div>





  <!-- custom JS -->
  <script src="../js/admin_auth.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>