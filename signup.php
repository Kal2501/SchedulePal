<?php
require "include/connection.php";
// Variabel untuk menyimpan pesan error
$error = "";

// Query untuk mengambil data fakultas
$queryFakultas = "SELECT * FROM fakultas";
$resultFakultas = mysqli_query($conn, $queryFakultas);

if (isset($_POST["register"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $id_fakultas = mysqli_real_escape_string($conn, $_POST["fakultas"]);
    $NIM = mysqli_real_escape_string($conn, $_POST["NIM"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = "user";

    // Cek apakah username sudah digunakan
    $checkUsername = "SELECT * FROM users WHERE username = '$username'";
    $checkUsernameResult = mysqli_query($conn, $checkUsername);

    // Cek apakah NIM sudah digunakan
    $checkNim = "SELECT * FROM users WHERE NIM = '$NIM'";
    $checkNimResult = mysqli_query($conn, $checkNim);

    if (mysqli_num_rows($checkUsernameResult) > 0) {
        $error = "Username sudah digunakan! Silakan gunakan username lain.";
    } elseif (mysqli_num_rows($checkNimResult) > 0) {
        $error = "NIM sudah terdaftar! Silakan periksa kembali NIM Anda.";
    } else {
        // Jika username dan NIM belum digunakan, lanjutkan proses registrasi
        $query = "INSERT INTO users (username, fakultas, nim, password, role) 
                VALUES ('$username', '$id_fakultas', '$NIM', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            echo "
            <script>
            alert('Registrasi berhasil!');
            document.location.href = 'login.php';
            </script>";
        } else {
            echo "
            <script>
            alert('Registrasi gagal!');
            document.location.href = 'signup.php';
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>Daftar</title>
</head>

<body>
    <form action="" method="POST">
        <svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="35px" fill="#8B5CF6">
            <path
                d="M80 0v-160h800V0H80Zm160-320h56l312-311-29-29-28-28-311 312v56Zm-80 80v-170l448-447q11-11 25.5-17t30.5-6q16 0 31 6t27 18l55 56q12 11 17.5 26t5.5 31q0 15-5.5 29.5T777-687L330-240H160Zm560-504-56-56 56 56ZM608-631l-29-29-28-28 57 57Z" />
        </svg>
        <h1>Daftar</h1>

        <?php if (!empty($error)) { ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php } ?>
        <input type="text" name="username" placeholder="Username" required autocomplete="off">

        <select name="fakultas" class="option-fakultas" required>
            <option value="" selected disabled>Fakultas</option>
            <?php while ($row = mysqli_fetch_assoc($resultFakultas)) { ?>
                <option value="<?php echo $row['id_fakultas']; ?>"><?php echo $row['nama_fakultas']; ?></option>
            <?php } ?>
        </select>

        <input type="number" name="NIM" placeholder="NIM" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register">Daftar</button>

        <p>Sudah punya akun? <a href="login.php">Masuk disini</a></p>
    </form>
</body>

</html>