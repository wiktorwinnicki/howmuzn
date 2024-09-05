<?php
session_start();
include("php/config.php");

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND Password='$password'") or die("Error Occurred.");
    $row = mysqli_fetch_assoc($result);

    if (is_array($row) && !empty($row)) {
        $_SESSION['valid'] = $row['Email'];
        $_SESSION['username'] = $row['Username'];
        $_SESSION['id'] = $row['Id'];

        if ($_SESSION['username'] === 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
    } else {
        echo "<div class='message'>
        <p>Wrong Username Or Password!</p>
        </div> <br>";
        echo "<a href='login.php'><button class ='btn'>Login Now</button>";
    }
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

    <div class="login-container">
        <div class="box form-box">
            <h3 id="login-header">Login</h3>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>

                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now!</a>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
<?php } ?>
