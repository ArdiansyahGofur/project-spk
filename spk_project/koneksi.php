<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "project-spk";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
  echo "Belum Konek";
} else {
  //echo "Sudah Konek";
}
 ?>
