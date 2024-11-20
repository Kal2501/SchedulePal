<?php
include 'connection.php';

function logOut()
{
  session_start();
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit();
}

function deleteFakultas($id, $conn)
{
  $sql = "DELETE FROM fakultas WHERE id_fakultas ='$id'";
  mysqli_query($conn, $sql);
  return;
}

function editFakultas($id, $nama, $conn)
{
  $sql = "UPDATE fakultas SET nama_fakultas='$nama' WHERE id_fakultas='$id'";
  if (isset($id, $nama)) {
    mysqli_query($conn, $sql);
    return ["message" => "Fakultas berhasil diupdate"];
  } else {
    return ["message" => "Data tidak lengkap"];
  }

}

function tambahFakultas($nama, $conn)
{
  // $sql = "SELECT * FROM fakultas WHERE id_fakultas='$id'";
  // $hasil = mysqli_query($conn, $sql);
  // if (isset(mysqli_fetch_assoc($hasil)['id_fakultas'])) {
  //   return ["message" => "Fakultas sudah ada"];
  // } else {
  $sql = "INSERT INTO fakultas (nama_fakultas) VALUES ('$nama')";
  mysqli_query(mysql: $conn, query: $sql);
  return ["message" => "Fakultas berhasil ditambahkan"];
  // }
}

function login($conn, $username, $password)
{
  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows === 0) {
    return [
      "status" => false,
      "message" => "username not found!"
    ];
  }
  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);

  if (!password_verify($password, $user['password'])) {
    return [
      "status" => false,
      "message" => "Password is incorrect!"
    ];
  }

  return [
    "status" => true,
    "message" => "Successfully logged in!",
    "NIM" => $user['NIM'],
    "username" => $user['username'],
    "role" => $user['role'],
    "fakultas" => $user['fakultas'],
  ];
}

function hitungJumlahFakultas($conn)
{
  $sql = "SELECT COUNT(*) AS jumlah FROM fakultas";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['jumlah'];
}

function requestSchedule($id_acara = null, $status = null, $conn = null)
{
  if ($id_acara !== null && $status !== null && $conn !== null) {
    $query = "UPDATE schedule SET status = ? WHERE id_acara = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id_acara);

    if ($stmt->execute()) {
      $stmt->close();
      return $status = "Diterima";
    }
    $stmt->close();
    return $status = "Ditolak";
  }
}
function jumlahScheduleSetuju($conn)
{
  $sql = "SELECT COUNT(status) FROM schedule WHERE status='Diterima'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['COUNT(status)'];
}

function jumlahScheduleTolak($conn)
{
  $sql = "SELECT COUNT(status) FROM schedule WHERE status='Ditolak'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['COUNT(status)'];
}

function tambahSchedule($conn, $judul_acara, $deskripsi, $waktu, $tanggal, $lokasi, $nim, $fakultas)
{
  $sql = "INSERT INTO schedule (judul_acara, deskripsi, waktu, tanggal, lokasi, status, nim, fakultas) VALUES ('$judul_acara', '$deskripsi', '$waktu', '$tanggal', '$lokasi', 'Tunggu', '$nim', '$fakultas')";
  $result = mysqli_query($conn, $sql);
  return;
}

function fotoProfile($conn, $NIM)
{
  $sql = "SELECT foto FROM users WHERE NIM = '$NIM'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['foto'];
}
?>