<?php
include 'include/connection.php';

$perpage = 5;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $perpage;


$query = "SELECT fakultas.nama_fakultas, schedule.judul_acara, schedule.deskripsi, schedule.lokasi, 
                    schedule.waktu, schedule.tanggal, schedule.status 
            FROM schedule 
            JOIN fakultas ON schedule.fakultas = fakultas.id_fakultas
            LIMIT $perpage OFFSET $offset";
$result = $conn->query($query);

$totalitemsquery = $conn->query("SELECT COUNT(*) as total FROM schedule");
$totalitems = $totalitemsquery->fetch_assoc()['total'];
$totalpages = ceil($totalitems / $perpage);

$schedules = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/table.css">
    <title>Document</title>
</head>

<body>
    <?php
    require 'templates/sidebar.php';
    ?>
    <div class="content">
        <div class="header">
            <h1>User Schedule</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Fakultas</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Waktu</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $schedules->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['nama_fakultas'] ?></td>
                        <td><?= $row['judul_acara'] ?></td>
                        <td><?= $row['deskripsi'] ?></td>
                        <td><?= $row['lokasi'] ?></td>
                        <td><?= $row['waktu'] ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td class="<?php
                        echo $row['status'] === 'Diterima' ? 'status-true' :
                            ($row['status'] === 'Ditolak' ? 'status-false' : 'status-pending');
                        ?>">
                            <?= $row['status'] ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="bottom-container">
            <p>Showing <?= $offset + 1 ?>-<?= min($offset + $perpage, $totalitems) ?> of <?= $totalitems ?></p>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>">
                        <button type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m14 7l-5 5l5 5" />
                            </svg>
                        </button>
                    </a>
                <?php endif; ?>

                <p>Page <?= $page ?> of <?= $totalpages ?></p>
                <?php if ($page < $totalpages): ?>
                    <a href="?page=<?= $page + 1 ?>">
                        <button type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                <g transform="translate(24 0) scale(-1 1)">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m14 7l-5 5l5 5" />
                                </g>
                            </svg>
                        </button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>