<?php
include 'include/connection.php';
include 'include/function.php';

session_start();
$user = $_SESSION['user'];
if (!isset($user)) {
    header('Location: login.php');
}

$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$fakultas = isset($_GET['fakultas']) ? $_GET['fakultas'] : '';

$daftar_fakultas = ambilDaftarFakultas($conn);
$total_data = hitungTotalData($conn, $fakultas);
$total_pages = ceil($total_data / $limit);
$jadwal = ambilschedule($conn, $fakultas, $limit, $offset);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/schedulefak.css">
    <title>Schedule Fakultas</title>
</head>

<body>
    <?php require 'templates/navbar.php'; ?>

    <div class="content">
        <div>
            <h1>Jadwal Fakultas</h1>
        </div>
        <div class="filter">
            <form action="" method="GET">
                <?php foreach ($daftar_fakultas as $f): ?>
                    <div>
                        <button type="submit" name="fakultas" value="<?= htmlspecialchars($f['id']); ?>">
                            <img src="<?= $f['logo'] ? 'icons_fakultas/' . htmlspecialchars($f['logo']) : 'icons_fakultas/engineering.png' ?>"
                                alt="" width="25px"><?= htmlspecialchars($f['nama']); ?>
                        </button>
                    </div>
                <?php endforeach; ?>
                <button type="submit" name="fakultas" value="">Semua Fakultas</button>
            </form>
        </div>


        <?php if ($jadwal->num_rows > 0): ?>
            <?php while ($row = $jadwal->fetch_assoc()): ?>
                <div class="card">
                    <div class="left">
                        <h2><?= htmlspecialchars($row["judul_acara"]); ?></h2>
                        <p><?= htmlspecialchars($row["deskripsi"]); ?></p>
                        <p><?= htmlspecialchars($row["lokasi"]); ?></p>
                    </div>
                    <div class="right">
                        <p><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="000000">
                                <path
                                    d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Zm280 240q-17 0-28.5-11.5T440-440q0-17 11.5-28.5T480-480q17 0 28.5 11.5T520-440q0 17-11.5 28.5T480-400Zm-160 0q-17 0-28.5-11.5T280-440q0-17 11.5-28.5T320-480q17 0 28.5 11.5T360-440q0 17-11.5 28.5T320-400Zm320 0q-17 0-28.5-11.5T600-440q0-17 11.5-28.5T640-480q17 0 28.5 11.5T680-440q0 17-11.5 28.5T640-400ZM480-240q-17 0-28.5-11.5T440-280q0-17 11.5-28.5T480-320q17 0 28.5 11.5T520-280q0 17-11.5 28.5T480-240Zm-160 0q-17 0-28.5-11.5T280-280q0-17 11.5-28.5T320-320q17 0 28.5 11.5T360-280q0 17-11.5 28.5T320-240Zm320 0q-17 0-28.5-11.5T600-280q0-17 11.5-28.5T640-320q17 0 28.5 11.5T680-280q0 17-11.5 28.5T640-240Z" />
                            </svg>
                            <?= htmlspecialchars(date("m/d/Y", strtotime($row["tanggal"]))); ?>
                        </p>
                        <p> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="00000">
                                <path
                                    d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z" />
                            </svg><?= htmlspecialchars(date("H:i", strtotime($row["waktu"]))); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada acara yang tersedia.</p>
        <?php endif; ?>

        <div class="bottom-container">
            <p>Showing <?= $offset + 1 ?>-<?= min($offset + $limit, $total_data) ?> of <?= $total_data ?></p>
            <div class="pagination">
                <?php tampilkanHalaman($page, $total_pages, $fakultas); ?>
            </div>
        </div>
    </div>

    <?php
    require 'templates/footer.php';
    ?>
</body>

</html>