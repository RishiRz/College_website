<?php
require_once "../admin/db.php";
$phone = $_POST["phone"] ?? '';

$otp = rand(100000, 999999);
$expire = date("Y-m-d H:i:s", strtotime("+5 minutes"));

$stmt = $conn->prepare("UPDATE admin_users SET otp_code=?, otp_expire=? WHERE phone=?");
$stmt->bind_param("sss", $otp, $expire, $phone);
$stmt->execute();

echo "OTP sent";
?>