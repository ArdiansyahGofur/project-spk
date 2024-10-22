<?php

    include 'koneksi.php';

    if (isset($_POST['simpan'])) {
      $id_alter   = $_POST['id_alter'];
      $alternatif = $_POST['nm_alter'];

      $sql    = "SELECT * FROM tab_alternatif";
      $tambah = $koneksi->query($sql);

      if ($row = $tambah->fetch_row()) {
        $masuk = "INSERT INTO tab_alternatif VALUES ('".$id_alter."','".$alternatif."')";
        $buat  = $koneksi->query($masuk);

        echo "<script>alert('Input Data Berhasil') </script>";
        echo "<script>window.location.href = \"alternatif.php\" </script>";
      }
    }

     ?>