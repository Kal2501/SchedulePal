<?php
include 'include/connection.php';
include 'include/function.php';

session_start();
$user = $_SESSION['user'];
if (!isset($user)) {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $scheduleBaru = $_POST;
    tambahSchedule($conn, $scheduleBaru['judul'], $scheduleBaru['deskripsi'], $scheduleBaru['waktu'], $scheduleBaru['tanggal'], $scheduleBaru['lokasi'], $user['NIM'], $user['fakultas']);
    // $conn, $judul_acara, $deskripsi_acara, $waktu_acara, $tanggal_acara, $lokasi_acara, $nim, $fakultas
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/edcre.css">
    <title>Document</title>
</head>

<body>
    <?php
    require 'templates/navbar.php';
    ?>
    <form action="" method="POST">
        <h1>Buat Schedule</h1>
        <h2>Details</h2>
        <input type="text" placeholder="Judul Acara" name="judul">
        <input type="text" placeholder="Deskripsi Acara" name="deskripsi">
        <input type="text" placeholder="Lokasi" name="lokasi">
        <h2>Tanggal dan Waktu</h2>
        <input type="date" placeholder="Tanggal" name="tanggal">
        <input type="time" name="waktu" id="">
        <input type="submit" value="Buat">
    </form>
    <?php
    require 'templates/footer.php';
    ?>
</body>

</html>