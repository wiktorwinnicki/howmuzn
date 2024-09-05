<?php
session_start();

$galleryDir = 'images/gallery/';
$images = glob($galleryDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

$reviewsFile = 'reviews.json';
$reviews = file_exists($reviewsFile) ? json_decode(file_get_contents($reviewsFile), true) : [];

$isAdmin = isset($_SESSION['valid']) && $_SESSION['username'] === 'admin';
$username = $_SESSION['username'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBSITE NAME</title>
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
                <?php if ($isAdmin): ?>
                    <li><a href="admin.php" class="admin-dashboard"><i class='bx bxs-id-card'></i> Admin Dashboard</a></li>
                <?php endif; ?>
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
                <?php if ($isAdmin): ?>
                    <a href="admin.php" class="admin-dashboard"><i class='bx bxs-id-card'></i> Admin Dashboard</a>
                <?php endif; ?>
                <a href="logout.php"><i class='bx bx-log-out'></i> Log Out</a>
            <?php else: ?>
                <a href="login.php"><i class='bx bxs-user'></i></a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<section>
    <img src="images/Behind.png" id="behind">
    <h2 id="text">How Muzn Found Her Voice...</h2>
    <a href="#" id="btn">Pre-order Now!</a>
    <img src="images/Front.png" id="front">   
</section>

<div class="synopsis">
    <img src="images/Behind2.png" id="behind">
    <div class="synopsis-content"> 
        <div class="box">
            <h2>How Muzn Found Her Voice...</h2>
            <p>The story’s main character, Muzn, is a young girl living near the Strait of Hormuz and has a fear of public speaking because of her stutter. All Muzn wants is to hide and not speak, but her grandmother and butterfly sidekick Sama never allow her to give up and in fact take her on a journey that changes her perspective forever.</p>
        </div>
    </div>
    <img src="images/Front2.png" id="front">
</div>

<div class="about">
    <img src="images/Clouds2.png" id="clouds2">
    <img src="images/Clouds2.png" id="clouds2Copy">
    <div class="box">
        <h2>About The Authors...</h2>
        <p>Both authors have occupied spaces where female role models who look like them are seldom found.<br> This only magnified the challenges they faced as they navigated through a system that brought out their strengths but also questioned their confidence at times.<br> It dawned on them that it is a manifestation of something bigger, the lack of stories that represent women from their background and culture, stories that embolden them to action, and stories they can carry and reassure themselves when in self-doubt.<br> The belief that self-confidence starts early encouraged both authors to realise that more children books from their culture need to address issues of self-confidence, empowerment and courage.<br> They hope this story serves as inspiration for the next generation of leaders.</p>
    </div>          
    <div class="card-container">
        <div class="card">
            <div class="cover">
               <img src="images/BookFront.png" alt="">
               <img src="images/BookBack.png" alt="">
            </div>
            <div class="content">
                <h2>About The Authors</h2>
                <h3>Fatma Al Manji</h3>
                <p>Omani environment researcher, water scientist, anti-racism activist and travel enthusiast. Fatma Al-Manji has long focused on how she could incorporate her knowledge on water remediation and analytical skills in developing sustainable models to combat climate change in the Middle East. She has published scientific articles in journals related to water management sciences at Wageningen University and research.</p>
                <h3>Rumaitha Al-Busaidi</h3>
                <p>Omani scientist, activist, and athlete Rumaitha Al Busaidi empowers Arab women to step into spaces previously denied to them—whether it’s a football field, volcano summit, or the front line of the battle against climate change. Back in May 2021, Rumaitha debuted her TED talk that has garnered over 1.2 million views worldwide where she looks at why women are more likely to be impacted and displaced by climate catastrophes.</p>
            </div>
        </div>
    </div>
</div>

<div class="gallery" <?php if(empty($images)) echo 'style="display:none;"'; ?>>
    <div class="container">
        <h2>Images from our book!</h2>
        <div class="image-container">
            <?php foreach ($images as $image): ?>
                <div class="image">
                    <img src="<?php echo $image; ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="popup-image">
            <span>&times;</span>
            <img src="" alt="">
        </div>
    </div>
</div>
<div class="preorder">
    <div class="box">
        <h2>Pre-Order Now!</h2>
        <p>Pre-Order the book now using our publishers dedicated website to be the first one to explore the adventures of Muzn!</p>
        <a href="https://www.austinmacauley.com/book/how-muzn-found-her-voice" id="btn">Pre-order Now!</a>
        <a href="https://www.austinmacauley.com/book/how-muzn-found-her-voice" id="btn">Pre-order for GCC!</a>
    </div>
    <div class="circle"></div>
    <div class="book">
            <div class="front-cover">
                <div class="front-page"></div>
            </div>
            <div class="back-cover">
            </div>
    </div>
</div>

<div class="reviews">
    <?php if (isset($_SESSION['valid'])): ?>
    <div class="review-container">
        <div class="box">
            <h3>Rate and Review</h3>
            <div class="stars">
                <i class="star" data-rating="1">&#9733;</i>
                <i class="star" data-rating="2">&#9733;</i>
                <i class="star" data-rating="3">&#9733;</i>
                <i class="star" data-rating="4">&#9733;</i>
                <i class="star" data-rating="5">&#9733;</i>
            </div>
            <textarea id="review-text" placeholder="Write your review here..."></textarea>
            <button id="submit-review">Submit Review</button>
        </div>
    </div>
    <?php else: ?>
    <div class="login-message">
        <p>Please <a href="login.php">log in</a> to submit a review.</p>
    </div>
    <?php endif; ?>

    <div class="user-reviews">
        <h3>User Reviews</h3>
        <div id="review-list">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <div class="review-box">
                            <p><strong><?php echo htmlspecialchars($review['username']); ?>:</strong></p>
                            <div class="stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="star non-interactive <?php echo $i <= $review['rating'] ? 'selected' : ''; ?>" data-rating="<?php echo $i; ?>">&#9733;</i>
                                <?php endfor; ?>
                            </div>
                            <?php if ($isAdmin): ?>
                                <p><small><strong>Review ID:</strong> <?php echo htmlspecialchars($review['review_id']); ?></small></p>
                            <?php endif; ?>
                            <p><?php echo htmlspecialchars($review['text']); ?></p>
                            <?php if ($isAdmin): ?>
                                <button class="delete-review-btn" data-review-id="<?php echo $review['review_id']; ?>">Delete</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No reviews yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>


<script src="script.js"></script>
</body>
</html>
