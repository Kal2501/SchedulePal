<?php
include 'include/connection.php';
include 'include/function.php';

session_start();
$user = $_SESSION['user'];
if (!isset($user)) {
    header('Location: login.php');
}

$id = $_GET['id'];
$sql = "SELECT nama_fakultas from fakultas where id_fakultas = '$id'";
$hasil = $conn->query($sql);
$namaFakultas = [];
$namaFakultas = $hasil->fetch_assoc();
// var_dump($namaFakultas);
$namaBaru;

if (isset($_POST['value'])) {
    $namaBaru = $_POST['value'];
    $hasil = editFakultas($id, $namaBaru, $conn);
    echo "<script>alert('" . $hasil['message'] . "')</script>";
    echo "<script>window.location.href='fakultas.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/input.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>Edit Fakultas</title>
</head>

<body>
    <?php
    require 'templates/sidebar.php';
    ?>
    <div class="content">
        <div class="header">
            <h1>Ubah Fakultas</h1>
            <a href="fakultas.php">
                <button class="kembali">Kembali</button>
            </a>
        </div>
        <form action="" method="post" class="form-input">
            <p>ID Fakultas : <?= $id ?></p>
            <input type="text" placeholder="<?= $namaFakultas['nama_fakultas'] ?>" name="value" required>
            <button>Ubah</button>
        </form>
    </div>
</body>

</html>