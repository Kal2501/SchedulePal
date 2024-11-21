<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/profile.css">
    <title>Document</title>
</head>

<body>
    <?php
    require 'templates/navbar.php';
    ?>
    <div class="content">
        <h1>Profile</h1>
        <div class="profile">
            <div class="profile-info">
                <label for="profile-pic"><img src=".\profile\default.svg" alt=""></label>
                <input type="file" name="profile-pic" id="profile-pic">
                <div>
                    <h2>Username</h2>
                    <p>NIM</p>
                    <p>Fakultas</p>
                </div>
            </div>
            <a class="logout-button" href="home.php?logOut=true">Logout</a>
        </div>
        <h1>Schedule yang Anda Buat</h1>
        <div class="card">
            <div class="left">
                <h2>Judul Acara</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia eum ratione vitae illum earum
                    exercitationem? Vero aspernatur est unde ipsam.</p>
                <p>Lokasi</p>
            </div>
            <div class="right">
                <div>
                    <p>Tanggal</p>
                    <p>Waktu</p>
                </div>
                <div>
                    <a class="edit" href="">Edit</a>
                    <a class="delete" href="">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    require 'templates/footer.php';
    ?>
</body>

</html>