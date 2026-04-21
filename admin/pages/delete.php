<?php
require_once "../db.php";

$id = $_POST['id'];
$type = $_POST['type'];

if($type == "admission"){
    $stmt = $conn->prepare("DELETE FROM admissions WHERE id=?");
}

elseif($type == "faculty"){
    $stmt = $conn->prepare("DELETE FROM faculty WHERE id=?");
}
elseif($type == "gallery"){
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
}
elseif($type == "testimonials"){
    $stmt = $conn->prepare("DELETE FROM testimonials WHERE id=?");
}

else{
    die("Invalid request");
}

$stmt->bind_param("i",$id);
$stmt->execute();

echo "Record Deleted";
?>