<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_id'])) {
    $reviewId = trim($_POST['review_id']);
    
    $reviewsFile = 'reviews.json';
    $reviews = file_exists($reviewsFile) ? json_decode(file_get_contents($reviewsFile), true) : [];

    $filteredReviews = array_filter($reviews, function($review) use ($reviewId) {
        return $review['review_id'] != $reviewId;
    });

    if (count($reviews) !== count($filteredReviews)) {
        file_put_contents($reviewsFile, json_encode(array_values($filteredReviews)));
        echo "Review deleted successfully.";
    } else {
        echo "Review not found.";
    }
} else {
    echo "Invalid request.";
}
?>
