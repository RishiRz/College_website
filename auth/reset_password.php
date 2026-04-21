<?php
require_once "../admin/db.php";

$phone = $_POST['phone'];
$otp = $_POST['otp'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// verify OTP
$result = $conn->query("SELECT * FROM admin WHERE phone='$phone' AND otp_code='$otp'");

if ($result->num_rows > 0) {

  $conn->query("UPDATE admin SET password='$password', otp_code=NULL WHERE phone='$phone'");

  echo "Password reset successful";

} else {
  echo "Invalid OTP";
}
?>