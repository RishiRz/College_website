<?php
require_once "../db.php";

$id = $_POST['id'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE admissions SET status=? WHERE id=?");
$stmt->bind_param("si",$status,$id);

$stmt->execute();

echo "Status Updated Successfully";
?>