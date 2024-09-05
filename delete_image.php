<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_id'])) {
    $imageId = basename($_POST['image_id']);
    $imageFile = 'images/gallery/' . $imageId;

    if (file_exists($imageFile)) {
        unlink($imageFile);
        echo "Image deleted successfully.";
    } else {
        echo "Image not found.";
    }
}
?>
