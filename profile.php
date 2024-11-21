<?php
include 'include/connection.php';
include 'include/function.php';

session_start();
$user = $_SESSION['user'];
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$NIM = $_SESSION['user']['NIM'];
if (isset($_FILES['profile-pic'])) {
    $result = updateProfilePicture($conn, $NIM, $_FILES['profile-pic']);
    echo "<script>alert('" . $result['message'] . "')</script>";
}

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $result = deleteSchedule($conn, $_GET['id'], $NIM);
    echo "<script>alert('" . $result['message'] . "')</script>";
}

$profile = getUserProfile($conn, $NIM);
$schedules = getUserSchedules($conn, $NIM);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/profile.css">
    <title>Profile</title>
</head>

<body>
    <?php
    require 'templates/navbar.php';
    ?>
    <div class="content">
        <h1>Profile</h1>
        <div class="profile">
            <div class="profile-info">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="profile-pic">
                        <img src="<?php echo $profile['foto'] ? 'profile/' . htmlspecialchars($profile['foto']) : './profile/default.svg'; ?>"
                            alt="Profile Picture">
                    </label>
                    <input type="file" name="profile-pic" id="profile-pic" accept="image/*"
                        onchange="this.form.submit()">
                    <div>
                        <h2><?php echo htmlspecialchars($profile['username']); ?></h2>
                        <p><?php echo htmlspecialchars($profile['NIM']); ?></p>
                        <p><?php echo htmlspecialchars($profile['nama_fakultas']); ?></p>
                    </div>
                </form>
            </div>
            <a class="logout-button" href="home.php?logOut=true">Logout</a>
        </div>
        <h1>Schedule yang Anda Buat</h1>
        <?php if (empty($schedules)): ?>
            <p>Anda belum membuat schedule apapun.</p>
        <?php else: ?>
            <?php foreach ($schedules as $schedule): ?>
                <div class="card">
                    <div class="left">
                        <h2><?php echo htmlspecialchars($schedule['judul_acara']); ?></h2>
                        <p><?php echo htmlspecialchars($schedule['deskripsi']); ?></p>
                        <p><?php echo htmlspecialchars($schedule['lokasi']); ?></p>
                    </div>
                    <div class="right">
                        <div>
                            <p><?php echo htmlspecialchars(date('d-m-Y', strtotime($schedule['tanggal']))); ?></p>
                            <p><?php echo htmlspecialchars(date('H:i', strtotime($schedule['waktu']))); ?></p>
                        </div>
                        <div>
                            <a class="edit" href="edit_schedule.php?id=<?php echo $schedule['id_acara']; ?>">Edit</a>
                            <a class="delete" href="profile.php?delete=1&id=<?php echo $schedule['id_acara']; ?>"
                                onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php
    require 'templates/footer.php';
    ?>
</body>

</html>