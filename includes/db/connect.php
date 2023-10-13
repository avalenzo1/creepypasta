<?php
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  $servername = "localhost";
  $username = "chicity";
  $password = "1xPOS@#sqlD#!@%";

  $conn = new mysqli($servername, $username, $password);
  $conn->set_charset("utf8mb4");
  $conn->select_db("calumet");

  if ($conn->connect_error) {
    die("Connection failed: {$conn->connect_error}");
  }
?>