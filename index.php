<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/home.css">
    <title>Document</title>
</head>

<body>
    <?php
    require 'templates/navbar.php';
    ?>
    <div class="content">
        <div>
            <h1>Temukan <b>schedule</b> <br> fakultas anda disini</h1>
            <a href="signup.php">Daftar dan Coba</a>
        </div>
        <img src="img/undraw_team_up_re_84ok.svg" alt="">
    </div>
    <div class="card-container">
        <div class="card">
            <svg xmlns="http://www.w3.org/2000/svg" height="75px" viewBox="0 -960 960 960" width="75px" fill="#F5F3FF">
                <path
                    d="m612-550 141-142-28-28-113 113-57-57-28 29 85 85ZM120-160v-80h480v80H120Zm520-280q-83 0-141.5-58.5T440-640q0-83 58.5-141.5T640-840q83 0 141.5 58.5T840-640q0 83-58.5 141.5T640-440Zm-520-40v-80h252q7 22 16 42t22 38H120Zm0 160v-80h376q23 14 49 23.5t55 13.5v43H120Z" />
            </svg>
            <p>Schedule apa saja<br>di fakultas anda</p>
        </div>
        <div class="card">
            <svg xmlns="http://www.w3.org/2000/svg" height="75px" viewBox="0 -960 960 960" width="75px" fill="#F5F3FF">
                <path
                    d="m612-550 141-142-28-28-113 113-57-57-28 29 85 85ZM120-160v-80h480v80H120Zm520-280q-83 0-141.5-58.5T440-640q0-83 58.5-141.5T640-840q83 0 141.5 58.5T840-640q0 83-58.5 141.5T640-440Zm-520-40v-80h252q7 22 16 42t22 38H120Zm0 160v-80h376q23 14 49 23.5t55 13.5v43H120Z" />
            </svg>
            <p>Akses gratis<br>cukup daftar</p>
        </div>
        <div class="card">
            <svg xmlns="http://www.w3.org/2000/svg" height="75px" viewBox="0 -960 960 960" width="75px" fill="#F5F3FF">
                <path
                    d="m612-550 141-142-28-28-113 113-57-57-28 29 85 85ZM120-160v-80h480v80H120Zm520-280q-83 0-141.5-58.5T440-640q0-83 58.5-141.5T640-840q83 0 141.5 58.5T840-640q0 83-58.5 141.5T640-440Zm-520-40v-80h252q7 22 16 42t22 38H120Zm0 160v-80h376q23 14 49 23.5t55 13.5v43H120Z" />
            </svg>
            <p>Riwayat kegiatan<br>fakultas anda</p>
        </div>
    </div>
    <div class="content-bottom">
        <img src="img/web-logo.png" alt="">
        <div>
            <h1>About Dev</h1>
            <p>Svelte adalah kelompok yang dibuat untuk membangun sebuah website schedule berbasis desktop. Website
                SchedulePal ini dibangun atas dasar kepedulian kami terhadap mahasiswa-mahasiswa Universitas Mulawarman
            </p>
        </div>
    </div>
    <?php
    require 'templates/footer.php';
    ?>
</body>

</html>