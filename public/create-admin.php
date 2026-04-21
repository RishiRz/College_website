<?php
require_once "../admin/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit;
}

$email = trim($_POST["email"]);
$password = $_POST["password"];

if (!$email || !$password) {
    echo "invalid";
    exit;
}

$check = $conn->prepare("SELECT id FROM admin_users WHERE email=?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "exists";
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admin_users (email, password) VALUES (?,?)");
$stmt->bind_param("ss", $email, $hashed);

echo $stmt->execute() ? "success" : "error";
