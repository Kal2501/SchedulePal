<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/navbar.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <img src="img/Logo.svg" alt="logo-schedulepal" width="185px">
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<a href="create.php">Buat Schedule</a>';
                echo '<a href="schedulefak.php">Schedule Fakultas</a>';
            } else {
                echo '<a href="login.php">Buat Schedule</a>';
                echo '<a href="login.php">Schedule Fakultas</a>';
            }
            ?>
            <?php
            if (isset($_SESSION['user'])) {
                // echo '<a class="profile-mobile" href="profile.php">Profile</a>';
                echo '<a class="profile-mobile" href="logOutTest.php">Profile</a>';//test Navbar sesudah dan sebelum login
            }
            ?>
        </div>
        <!-- <a class="profile-desk" href="profile.php"><img src="" alt=""></a> -->
        <div class="form">
            <?php
            if (!isset($_SESSION['user'])) {
                echo '<a href="./login.php" class="masuk">Masuk</a>';
                echo '<a href="./signup.php" class="daftar">Daftar</a>';
            }
            ?>
        </div>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
</body>
<script src="scripts/navbar.js"></script>

</html>