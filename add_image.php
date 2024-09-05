<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['new_image'])) {
    $uploadDir = 'images/gallery/';
    $uploadFile = $uploadDir . basename($_FILES['new_image']['name']);

    if (move_uploaded_file($_FILES['new_image']['tmp_name'], $uploadFile)) {
        echo "Image uploaded successfully.";
    } else {
        echo "Failed to upload image.";
    }
}
?>
