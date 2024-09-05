<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['valid'])) {
        $username = $_SESSION['username'];
        $rating = intval($_POST['rating']);
        $text = trim($_POST['text']);

        $reviewsFile = 'reviews.json';
        if (file_exists($reviewsFile)) {
            $reviewsJson = file_get_contents($reviewsFile);
            $reviews = json_decode($reviewsJson, true);
            if (!is_array($reviews)) {
                $reviews = [];
            }
        } else {
            $reviews = [];
        }

        foreach ($reviews as $review) {
            if ($review['username'] === $username) {
                echo json_encode(['status' => 'error', 'message' => 'You have already posted a review.']);
                exit();
            }
        }

        $reviewId = count($reviews) + 1;
        $reviews[] = [
            'review_id' => $reviewId,
            'username' => $username,
            'rating' => $rating,
            'text' => $text
        ];

        file_put_contents($reviewsFile, json_encode($reviews));

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    }
}
?>
