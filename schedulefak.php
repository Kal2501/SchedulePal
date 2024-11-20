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


$fakultas_query = "SELECT DISTINCT f.nama_fakultas, f.id_fakultas 
                    FROM schedule s
                    JOIN fakultas f ON s.fakultas = f.id_fakultas";
$fakultas_result = $conn->query($fakultas_query);


$fakultas_list = [];
if ($fakultas_result->num_rows > 0) {
    while ($row = $fakultas_result->fetch_assoc()) {
        $fakultas_list[] = [
            'id' => $row['id_fakultas'],
            'nama' => $row['nama_fakultas']
        ];
    }
}


$fakultas = isset($_GET['fakultas']) ? $_GET['fakultas'] : '';


$total_query = "SELECT COUNT(*) AS total FROM schedule";
if (!empty($fakultas)) {
    $total_query .= " WHERE fakultas = ?";
}
$stmt = $conn->prepare($total_query);
if (!empty($fakultas)) {
    $stmt->bind_param('s', $fakultas);
}
$stmt->execute();
$total_result = $stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_data = $total_row['total'];

// Hitung total halaman
$total_pages = ceil($total_data / $limit);


$sql = "SELECT * FROM schedule";
if (!empty($fakultas)) {
    $sql .= " WHERE fakultas = ?";
}
$sql .= " LIMIT $limit OFFSET $offset";

$stmt = $conn->prepare($sql);
if (!empty($fakultas)) {
    $stmt->bind_param('s', $fakultas);
}
$stmt->execute();
$result = $stmt->get_result();
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

    <?php include 'templates/navbar.php'; ?>

    <div class="content">


        <div>
            <h1>Schedule Fakultas</h1>
        </div>
        <div class="filter">
            <form action="" method="GET">
                <?php foreach ($fakultas_list as $f): ?>
                    <button type="submit" name="fakultas" value="<?= htmlspecialchars($f['id']); ?>">
                        <?= htmlspecialchars($f['nama']); ?>
                    </button>
                <?php endforeach; ?>
                <button type="submit" name="fakultas" value="">Semua Fakultas</button>
            </form>
        </div>

        <?php

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
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
                <?php
            }
        } else {
            echo '<p>Tidak ada acara yang tersedia.</p>';
        }
        ?>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1; ?>&fakultas=<?= htmlspecialchars($fakultas); ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i; ?>&fakultas=<?= htmlspecialchars($fakultas); ?>" <?= $i === $page ? 'class="active"' : ''; ?>><?= $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?= $page + 1; ?>&fakultas=<?= htmlspecialchars($fakultas); ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'templates/footer.php'; ?>
</body>

</html>