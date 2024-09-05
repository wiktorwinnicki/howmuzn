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

        <div class="login-container">
            <div class="box form-box">

            <?php
            
            include("php/config.php");
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

             $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

             if(mysqli_num_rows($verify_query) !=0 ){
                echo "<div class='message'>
                            <p>This Email is used.</p>
                       </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class ='btn'>Go Back</button>";
             }
             else{

                mysqli_query($con,"INSERT INTO users(Username,Email,Password) VALUES('$username','$email','$password')") or die("Error Occured");

                echo "<div class='message'>
                        <p>User Registered Succesfully!</p>
                      </div> <br>";
                echo "<a href='login.php'><button class ='btn'>Login Now</button>";

             }

            }else{
            
            ?>
                <h3 id="login-header">Sign Up<h3>            
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Register" required>
                    </div>

                    <div class="links">
                        Already have an account? <a href="login.php">Log in Now!</a>
                    </div>
                </form>
            </div>
            <?php } ?>
        </div>
        <script src="script.js"></script>
    </body>
</html>