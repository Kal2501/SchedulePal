<?php
include 'include/connection.php';
include 'include/function.php';

session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $result = login($conn, $username, $password);
    if ($result['status']) {
        $_SESSION['user'] = $result;
        if ($result['role'] == 'admin') {
            header('Location: home.php');
        } else {
            header('Location: index.php');
        }
    } else {
        echo "<script>alert('" . $result['message'] . "')</script>";
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
    <title>Login</title>
</head>

<body>
    <form action="" method="POST">
        <svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="35px" fill="#8B5CF6">
            <path
                d="M440-440q17 0 28.5-11.5T480-480q0-17-11.5-28.5T440-520q-17 0-28.5 11.5T400-480q0 17 11.5 28.5T440-440ZM280-120v-80l240-40v-445q0-15-9-27t-23-14l-208-34v-80l220 36q44 8 72 41t28 77v512l-320 54Zm-160 0v-80h80v-560q0-34 23.5-57t56.5-23h400q34 0 57 23t23 57v560h80v80H120Zm160-80h400v-560H280v560Z" />
        </svg>
        <h1>Welcome</h1>
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <button>Login</button>
        <p>Belum punya akun?<a href="signup.php">Daftar disini</a></p>
    </form>
</body>

</html>