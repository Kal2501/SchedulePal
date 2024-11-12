<?php
include 'connection.php';
$id_acara = $_GET['id'];
$status = $_GET['status'];
requestSchedule($id_acara, $status, $conn);
header("Location: requests.php");
?>