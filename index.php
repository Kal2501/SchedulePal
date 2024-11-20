<?php
session_start();
?>
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
            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#F5F3FF">
                <path
                    d="M479-17q-112 0-216-63T96-224v127H14v-274h274v82H151q51 72 143 130.5T479-100q76 0 144.5-29T744-208q52-50 83.5-118.5T860-474h83q-1 96-38.5 179.5T803.5-149q-63.5 62-147 97T479-17Zm-34-176v-50q-41-10-74.5-39T317-362l62-21q11 40 40 62t68 22q41 0 64-17.5t23-47.5q0-30-22.5-51T472-460q-69-27-102-58.5T337-602q0-44 28-76.5t82-41.5v-46h67v46q39 6 66 26t46 62l-59 27q-15-30-37.5-44T478-663q-34 0-54 15.5T404-606q0 30 24.5 49t81.5 43q71 29 101 63.5t30 86.5q0 28-9 49.5t-26 37Q589-262 565.5-253T512-241v48h-67ZM17-486q0-93 36.5-176.5t99-145.5q62.5-62 147-98.5T480-943q112 0 217 63.5T863-736v-127h83v274H672v-82h137q-54-75-147-132t-182-57q-76 0-144.5 29T215-752q-52 50-83.5 118.5T99-486H17Z" />
            </svg>
            <p>Akses gratis<br>cukup daftar</p>
        </div>
        <div class="card">
            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#F5F3FF">
                <path
                    d="M476.06-95Q315-95 203.8-207.43 92.59-319.85 94-481h94q1.15 121.3 84.01 206.65Q354.86-189 476-189q122 0 208-86.32t86-209.5Q770-605 683.63-688 597.25-771 476-771q-60 0-113.5 24.5T268-680h84v73H123v-227h71v95q55-59 127.5-93T476-866q80 0 150.5 30.5t123.74 82.51q53.24 52.01 83.5 121.5Q864-562 864-482q0 80-30.26 150.49-30.26 70.49-83.5 123Q697-156 626.5-125.5 556-95 476.06-95ZM600-311 446-463v-220h71v189l135 131-52 52Z" />
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