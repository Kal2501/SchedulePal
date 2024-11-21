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
    if ($id_acara !== null && $status !== null && $conn !== null) {
        $query = "UPDATE schedule SET status = ? WHERE id_acara = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $status, $id_acara);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }
}
function jumlahScheduleSetuju($conn)
{
  $sql = "SELECT COUNT(status) FROM schedule WHERE status='true'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['COUNT(status)'];
}

function jumlahScheduleTolak($conn)
{
  $sql = "SELECT COUNT(status) FROM schedule WHERE status='False'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['COUNT(status)'];
}

function getUserProfile($conn, $NIM) {
    $sql = "SELECT u.NIM, u.username, u.foto, f.nama_fakultas 
            FROM users u 
            JOIN fakultas f ON u.fakultas = f.id_fakultas 
            WHERE u.NIM = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $NIM);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

function getUserSchedules($conn, $NIM) {
    $sql = "SELECT * FROM schedule WHERE NIM = ? ORDER BY tanggal DESC, waktu DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $NIM);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $schedules = [];
    while ($row = $result->fetch_assoc()) {
        $schedules[] = $row;
    }
    return $schedules;
}

function updateProfilePicture($conn, $NIM, $file) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowedTypes)) {
        return ["status" => false, "message" => "Invalid file type. Only JPG, PNG, and GIF are allowed."];
    }
    
    if ($file['size'] > $maxFileSize) {
        return ["status" => false, "message" => "File is too large. Maximum size is 5MB."];
    }
    
    $fileName = $NIM . '_' . time() . '_' . basename($file['name']);
    $uploadPath = 'profile/' . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        $sql = "UPDATE users SET foto = ? WHERE NIM = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $fileName, $NIM);
        
        if ($stmt->execute()) {
            return ["status" => true, "message" => "Profile picture updated successfully"];
        }
    }
    
    return ["status" => false, "message" => "Failed to update profile picture"];
}

function deleteSchedule($conn, $id_acara, $NIM) {
    $sql = "DELETE FROM schedule WHERE id_acara = ? AND NIM = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_acara, $NIM);
    
    if ($stmt->execute()) {
        return ["status" => true, "message" => "Schedule deleted successfully"];
    }
    return ["status" => false, "message" => "Failed to delete schedule"];
}
?>
