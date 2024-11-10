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

function deleteFakultas($id, $idx, $conn)
{
  $sql = "DELETE FROM fakultas WHERE id ='$id'";
  mysqli_query($conn, $sql);
  return ["message" => "Fakultas berhasil dihapus"];
}

function editFakultas($id, $nama, $idx, $conn)
{
  $sql = "UPDATE fakultas SET id_fakultas='$id', nama_fakultas='$nama' WHERE id='$idx'";
  if (isset($id, $nama)) {
    mysqli_query($conn, $sql);
    return ["message" => "Fakultas berhasil diupdate"];
  } else {
    return ["message" => "Data tidak lengkap"];
  }

}

function tambahFakultas($id, $nama, $conn)
{
  $sql = "SELECT * FROM fakultas WHERE id_fakultas='$id'";
  $hasil = mysqli_query($conn, $sql);
  if (isset(mysqli_fetch_assoc($hasil)['id_fakultas'])) {
    return ["message" => "Fakultas sudah ada"];
  } else {
    $sql = "INSERT INTO fakultas (id_fakultas, nama_fakultas) VALUES ('$id', '$nama')";
    mysqli_query($conn, $sql);
    return ["message" => "Fakultas berhasil ditambahkan"];
  }
}

?>