<?php
session_start();
$user = $_SESSION['user'];
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include 'include/connection.php';
include 'include/function.php';

$id_acara = $_GET['id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = [
        // 'judul_acara' => $_POST['judul_acara'],
        'deskripsi' => $_POST['deskripsi'],
        'lokasi' => $_POST['lokasi'],
        'tanggal' => $_POST['tanggal'],
        'waktu' => $_POST['waktu']
    ];
    updateschedule($conn, $id_acara, $formData);
}

$schedule = ambilidschedule($conn, $id_acara);


// if (!$schedule) {
//     gagalupdate("Schedule tidak ditemukan!");
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/edcre.css">
    <title>Edit Schedule</title>
</head>

<body>
    <?php
    require 'templates/navbar.php';
    ?>

    <form method="POST" action="">
        <h1>Ubah Schedule</h1>
        <h2>Details</h2>
        <p class="prev-judul"><?= htmlspecialchars($schedule['judul_acara']); ?></p>
        <!-- <input type="text" name="judul_acara" value="" required> -->

        <input type="text" name="deskripsi" placeholder="Deskripsi Acara"
            value="<?= htmlspecialchars($schedule['deskripsi']); ?>" required>

        <input type="text" name="lokasi" placeholder="Lokasi" value="<?= htmlspecialchars($schedule['lokasi']); ?>"
            required>

        <h2>Tanggal dan Waktu</h2>
        <input type="date" name="tanggal" value="<?= htmlspecialchars($schedule['tanggal']); ?>" required>

        <input type="time" name="waktu" value="<?= htmlspecialchars($schedule['waktu']); ?>" required>

        <input type="submit" value="Ubah">
    </form>

    <?php
    require 'templates/footer.php';
    ?>
</body>

</html>