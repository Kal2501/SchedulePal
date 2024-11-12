<?php
include 'include/connection.php';
include 'include/function.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id_acara = $_GET['id'];
    $status = $_GET['status'];
    requestSchedule($id_acara, $status, $conn);
    header("Location: requests.php");
    exit();
}
$perpage = 5;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $perpage;

$query = "SELECT users.NIM, fakultas.nama_fakultas, schedule.judul_acara, schedule.deskripsi, schedule.lokasi, schedule.waktu, schedule.tanggal, schedule.id_acara 
              FROM schedule 
              JOIN users ON schedule.NIM = users.NIM 
              JOIN fakultas ON users.fakultas = fakultas.id_fakultas 
              where schedule.status ='Tunggu' LIMIT $perpage OFFSET $offset";
$result = $conn->query($query);

$totalitemsquery = $conn->query("SELECT COUNT(*) as total FROM schedule");
$totalitems = $totalitemsquery->fetch_assoc()['total'];
$totalpages = ceil($totalitems / $perpage);
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
            <h1>Requests</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Fakultas</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Waktu</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['NIM'] ?></td>
                        <td><?= $row['nama_fakultas'] ?></td>
                        <td><?= $row['judul_acara'] ?></td>
                        <td><?= $row['deskripsi'] ?></td>
                        <td><?= $row['lokasi'] ?></td>
                        <td><?= $row['waktu'] ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td>
                            <a href="requests.php?id=<?php echo $row['id_acara']; ?>&status=Diterima">
                                <button><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#4ADE80">
                                        <path
                                            d="m424-312 282-282-56-56-226 226-114-114-56 56 170 170ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Z" />
                                    </svg></button>
                            </a>
                            <a href="requests.php?id=<?php echo $row['id_acara']; ?>&status=Ditolak">
                                <button><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#EF4444">
                                        <path
                                            d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Z" />
                                    </svg></button>
                            </a>
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