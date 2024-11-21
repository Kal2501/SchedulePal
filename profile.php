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
                        <div class="date-times">
                            <p><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                    fill="000000">
                                    <path
                                        d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Zm280 240q-17 0-28.5-11.5T440-440q0-17 11.5-28.5T480-480q17 0 28.5 11.5T520-440q0 17-11.5 28.5T480-400Zm-160 0q-17 0-28.5-11.5T280-440q0-17 11.5-28.5T320-480q17 0 28.5 11.5T360-440q0 17-11.5 28.5T320-400Zm320 0q-17 0-28.5-11.5T600-440q0-17 11.5-28.5T640-480q17 0 28.5 11.5T680-440q0 17-11.5 28.5T640-400ZM480-240q-17 0-28.5-11.5T440-280q0-17 11.5-28.5T480-320q17 0 28.5 11.5T520-280q0 17-11.5 28.5T480-240Zm-160 0q-17 0-28.5-11.5T280-280q0-17 11.5-28.5T320-320q17 0 28.5 11.5T360-280q0 17-11.5 28.5T320-240Zm320 0q-17 0-28.5-11.5T600-280q0-17 11.5-28.5T640-320q17 0 28.5 11.5T680-280q0 17-11.5 28.5T640-240Z" />
                                </svg><?php echo htmlspecialchars(date('d-m-Y', strtotime($schedule['tanggal']))); ?></p>
                            <p><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                    fill="00000">
                                    <path
                                        d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z" />
                                </svg><?php echo htmlspecialchars(date('H:i', strtotime($schedule['waktu']))); ?></p>
                        </div>
                        <div class="aksi">
                            <a class="edit" href="edit.php?id=<?php echo $schedule['id_acara']; ?>">Edit</a>
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