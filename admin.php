<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
<header>
    <a href="#" class="logo">LOGO</a>
    <nav>
        <ul class="navbar-menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">Synopsis</a></li>
            <li><a href="#">About The Author</a></li>
            <li><a href="#">Gallery</a></li>
            <li><a href="#">Pre-Order</a></li>
            <li><a href="#">Reviews</a></li>
            <?php if (isset($_SESSION['valid'])): ?>
                    <li><a href="admin.php" class="admin-dashboard"><i class='bx bxs-id-card'></i> Admin Dashboard</a></li>
                <li><a href="logout.php"><i class='bx bx-log-out'></i> Log Out</a></li>
            <?php else: ?>
                <li><a href="login.php"><i class='bx bxs-user'></i></a></li>
            <?php endif; ?>
        </ul>
        <button class="dropdown-btn" onclick="toggleDropdown()">☰</button>
        <div class="dropdown-menu">
            <a href="#">Home</a>
            <a href="#">Synopsis</a>
            <a href="#">About The Author</a>
            <a href="#">Gallery</a>
            <a href="#">Pre-Order</a>
            <a href="#">Reviews</a>
            <?php if (isset($_SESSION['valid'])): ?>
                    <a href="admin.php" class="admin-dashboard"><i class='bx bxs-id-card'></i> Admin Dashboard</a>
                <a href="logout.php"><i class='bx bx-log-out'></i> Log Out</a>
            <?php else: ?>
                <a href="login.php"><i class='bx bxs-user'></i></a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main>
    <div class="main-box top">
        <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $_SESSION['username']; ?></b></p>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>

    <div class="admin-section">
        <h2>Manage Reviews</h2>
        <form action="delete_review.php" method="post">
            <label for="review-id">Review ID:</label>
            <input type="text" id="review-id" name="review_id" placeholder="Enter Review ID to delete" required>
            <button type="submit">Delete Review</button>
        </form>
        <hr>
    </div>

    <div class="admin-section">
        <h2>Manage Gallery</h2>
        <form action="add_image.php" method="post" enctype="multipart/form-data">
            <label for="new-image">Upload New Image:</label>
            <input type="file" id="new-image" name="new_image" accept="image/*" required>
            <button type="submit">Add Image</button>
        </form>
        <hr>
        <form action="delete_image.php" method="post">
            <label for="image-id">Image File Name:</label>
            <input type="text" id="image-id" name="image_id" placeholder="Enter Image File Name to delete" required>
            <button type="submit">Delete Image</button>
        </form>
    </div>
</main>
<script src="script.js"></script>
</body>
</html>
