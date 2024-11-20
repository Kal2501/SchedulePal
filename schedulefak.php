<?php
include 'include/connection.php'; 
include 'include/function.php';

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
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
        <div class="filter">
            <form action="" method="GET">
                <?php foreach ($daftar_fakultas as $f): ?>
                    <button type="submit" name="fakultas" value="<?= htmlspecialchars($f['id']); ?>">
                        <?= htmlspecialchars($f['nama']); ?>
                    </button>
                <?php endforeach; ?>
                <button type="submit" name="fakultas" value="">Semua Fakultas</button>
            </form>
        </div>

        <div>
            <h1>Jadwal Fakultas</h1>
        </div>

        <?php if ($jadwal->num_rows > 0): ?>
            <?php while ($row = $jadwal->fetch_assoc()): ?>
                <div class="card">
                    <div>
                        <h2><?= htmlspecialchars($row["judul_acara"]); ?></h2>
                        <p><?= htmlspecialchars($row["deskripsi"]); ?></p>
                        <p><?= htmlspecialchars($row["lokasi"]); ?></p>
                    </div>
                    <div>
                        <p><?= htmlspecialchars(date("m/d/Y", strtotime($row["tanggal"]))); ?></p>
                        <p><?= htmlspecialchars(date("H:i", strtotime($row["waktu"]))); ?></p>
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
