<?php
include 'connection.php';

function logOut()
{
  session_start();
  session_unset();
  session_destroy();
  header("Location: index.php");
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
    "foto" => $user['foto'],
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
  echo "<script>alert('Berhasil menambahkan acara');</script>";
  return;
}

function fotoProfile($conn, $NIM)
{
  $sql = "SELECT foto FROM users WHERE NIM = '$NIM'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['foto'];
}
function ambilDaftarFakultas($conn)
{
  $query = "SELECT DISTINCT f.nama_fakultas, f.id_fakultas, f.logo 
            FROM schedule s
            JOIN fakultas f ON s.fakultas = f.id_fakultas
            WHERE s.status='Diterima'";
  $result = $conn->query($query);

  $daftar_fakultas = [];
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $daftar_fakultas[] = [
        'id' => $row['id_fakultas'],
        'nama' => $row['nama_fakultas'],
        'logo' => $row['logo']
      ];
    }
  }
  return $daftar_fakultas;
}

function hitungTotalData($conn, $fakultas)
{
  $query = "SELECT COUNT(*) AS total FROM schedule WHERE status='Diterima'";
  if (!empty($fakultas)) {
    $query .= " AND fakultas = ?";
  }
  $stmt = $conn->prepare($query);
  if (!empty($fakultas)) {
    $stmt->bind_param('s', $fakultas);
  }
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result ? $result->fetch_assoc() : null;
  return $row ? $row['total'] : 0;
}

function ambilschedule($conn, $fakultas, $limit, $offset)
{
  $query = "SELECT * FROM schedule WHERE status='Diterima'";
  if (!empty($fakultas)) {
    $query .= " AND fakultas = ?";
  }
  $query .= " LIMIT ? OFFSET ?";

  $stmt = $conn->prepare($query);
  if (!empty($fakultas)) {
    $stmt->bind_param('sii', $fakultas, $limit, $offset);
  } else {
    $stmt->bind_param('ii', $limit, $offset);
  }
  $stmt->execute();
  return $stmt->get_result();
}

function tampilkanHalaman($page, $total_pages, $fakultas)
{
  $fakultas_encoded = htmlspecialchars($fakultas);

  if ($page > 1) {
    echo '<a href="?page=' . ($page - 1) . '&fakultas=' . $fakultas_encoded . '">';
    echo '<button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m14 7l-5 5l5 5" />
                            </svg></button></a>';
  }

  echo '<p>Page ' . htmlspecialchars($page) . ' of ' . htmlspecialchars($total_pages) . '</p>';

  if ($page < $total_pages) {
    echo '<a href="?page=' . ($page + 1) . '&fakultas=' . $fakultas_encoded . '">';
    echo '<button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                <g transform="translate(24 0) scale(-1 1)">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m14 7l-5 5l5 5" />
                                </g>
                            </svg></button></a>';
  }
}

function updateProfilePicture($conn, $NIM, $file)
{
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

function deleteSchedule($conn, $id_acara, $NIM)
{
  $sql = "DELETE FROM schedule WHERE id_acara = ? AND NIM = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $id_acara, $NIM);

  if ($stmt->execute()) {
    return ["status" => true, "message" => "Schedule deleted successfully"];
  }
  return ["status" => false, "message" => "Failed to delete schedule"];
}

function getUserProfile($conn, $NIM)
{
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

function getUserSchedulesWithLimit($conn, $NIM, $limit, $offset) {
  $sql = "SELECT * FROM schedule WHERE NIM = ? ORDER BY tanggal ASC, waktu DESC LIMIT ? OFFSET ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iii", $NIM, $limit, $offset);
  $stmt->execute();
  $result = $stmt->get_result();

  $schedules = [];
  while ($row = $result->fetch_assoc()) {
      $schedules[] = $row;
  }
  return $schedules;
}

function ambilidschedule($conn, $id_acara)
{
  $query = "SELECT * FROM schedule WHERE id_acara = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $id_acara);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

function updateschedule($conn, $id_acara, $data)
{
  $query = "UPDATE schedule SET 
            -- judul_acara = ?, 
            deskripsi = ?, 
            lokasi = ?, 
            tanggal = ?, 
            waktu = ? 
            WHERE id_acara = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param(
    "sssss",
    // $data['judul_acara'],
    $data['deskripsi'],
    $data['lokasi'],
    $data['tanggal'],
    $data['waktu'],
    $id_acara
  );

  if ($stmt->execute()) {
    echo "<script>
              alert('Jadwal berhasil diubah!');
              window.location.href = 'profile.php';
            </script>";
  } else {
    echo "Error: " . $stmt->error;
  }
}

function countUserSchedules($conn, $NIM) {
  $sql = "SELECT COUNT(*) AS total FROM schedule WHERE NIM = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $NIM);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  return $row['total'];
}

function tampilkanHalamanuser($page, $total_pages)
{

    // Tombol Previous
    if ($page > 1) {
        echo '<a href="?page=' . ($page - 1) . '&fakultas=' . '">';
        echo '<button type="button" class="btn-pagination prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="m14 7l-5 5l5 5" />
                </svg>
              </button>
              </a>';
    }
    echo '<p class="pagination-info">Page ' . htmlspecialchars($page) . ' of ' . htmlspecialchars($total_pages) . '</p>';

    if ($page < $total_pages) {
        echo '<a href="?page=' . ($page + 1) . '&fakultas=' .'">';
        echo '<button type="button" class="btn-pagination next">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                    <g transform="translate(24 0) scale(-1 1)">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m14 7l-5 5l5 5" />
                    </g>
                </svg>
              </button>
              </a>';
    }
}

function gagalupdate($pesan)
{
  echo "<script>
          alert('$pesan');
          window.location.href = 'profile.php';
        </script>";
  exit;
}
?>
