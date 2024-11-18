<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/edcre.css">
    <title>Document</title>
</head>

<body>
    <?php
    require 'templates/navbar.php';
    ?>
    <form action="">
        <h1>Buat Schedule</h1>
        <h2>Details</h2>
        <input type="text" placeholder="Judul Acara" required>
        <input type="text" placeholder="Deskripsi Acara" required>
        <input type="text" placeholder="Lokasi">
        <h2>Tanggal dan Waktu</h2>
        <input type="date" placeholder="Tanggal">
        <input type="time" name="" id="">
        <input type="button" value="Buat">
    </form>
    <?php
    require 'templates/footer.php';
    ?>
</body>

</html>