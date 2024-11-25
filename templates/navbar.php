<?PHP
include 'include/connection.php';

if (isset($user['NIM'])) {
    $fotoProfile = fotoProfile($conn, $user['NIM']);
    $nilai = $fotoProfile ? './profile/' . htmlspecialchars($fotoProfile) : ".\profile\default.svg";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>Document</title>
</head>

<body>
    <nav>
        <img src="img/Logo.svg" alt="logo-schedulepal" width="185px">
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <!-- <a href="logOutTest.php">logOut</a> test -->
            <?php
            if (isset($_SESSION['user'])) {
                echo '<a href="create.php">Buat Schedule</a>';
                echo '<a href="schedulefak.php">Schedule Fakultas</a>';
                echo '<a class="profile-mobile" href="profile.php">Profile</a>';
            } else {
                echo '<a href="login.php">Buat Schedule</a>';
                echo '<a href="login.php">Schedule Fakultas</a>';
                echo '<a class="profile-mobile" href="login.php">Profile</a>';
            }
            ?>
        </div>
        <div class="form">
            <?php
            if (!isset($_SESSION['user'])) {
                echo '<a href="./login.php" class="masuk">Masuk</a>';
                echo '<a href="./signup.php" class="daftar">Daftar</a>';
            }
            ?>
        </div>
        <?php
        if (isset($_SESSION['user'])) {
            echo '<a class="profile-desk" href="profile.php"><img src="' . $nilai . '" alt=""></a>';
        }
        ?>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
</body>
<script src="scripts/navbar.js"></script>

</html>