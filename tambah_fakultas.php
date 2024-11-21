<?php
include 'include/connection.php';
include 'include/function.php';

session_start();
$user = $_SESSION['user'];
if (!isset($user)) {
    header('Location: login.php');
}

if (isset($_POST['id']) && isset($_POST['nama'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $hasil = tambahFakultas($id, $nama, $conn);
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
    <title>Tambah Data Fakultas</title>
</head>

<body>
    <?php
    require 'templates/sidebar.php';
    ?>
    <div class="content">
        <div class="header">
            <h1>Tambah Fakultas</h1>
            <a href="fakultas.php">
                <button>Kembali</button>
            </a>
        </div>
        <form action="" method="post" class="form-input">
            <input type="number" min="1" max="99999" placeholder="ID Fakultas" name="id">
            <input type="text" placeholder="Nama Fakultas" name="nama" required>
            <button>Tambah</button>
        </form>
    </div>
</body>

</html>