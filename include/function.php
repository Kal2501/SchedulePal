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
?>