<?php
//koneksi
session_start();
include("koneksi.php");

// Pastikan data yang diperlukan telah dikirimkan melalui form sebelum mengeksekusi perintah INSERT
if(isset($_POST['alter'], $_POST['krit'], $_POST['nilai'])) {
    $alternatif = $_POST['alter'];
    $kriteria   = $_POST['krit'];
    $poin       = $_POST['nilai'];

    // Pastikan data yang akan ditambahkan belum ada di tabel
    $cek_data = $koneksi->query("SELECT * FROM tab_topsis WHERE id_alternatif = '$alternatif' AND id_kriteria = '$kriteria'");
    if($cek_data->num_rows == 0) {
        // Jika data belum ada, lakukan penambahan data
        $masuk = "INSERT INTO tab_topsis (id_alternatif, id_kriteria, nilai) VALUES ('$alternatif','$kriteria','$poin')";
        $buat  = $koneksi->query($masuk);

        if($buat) {
            echo "<script>alert('Input Data Berhasil') </script>";
            echo "<script>window.location.href = \"nilai_matriks.php\" </script>";
        } else {
            echo "<script>alert('Gagal menambahkan data')</script>";
            echo "<script>window.location.href = \"nilai_matriks.php\" </script>";
        }
    } else {
        // Jika data sudah ada, tampilkan pesan kesalahan
        echo "<script>alert('Data sudah ada')</script>";
        echo "<script>window.location.href = \"nilai_matriks.php\" </script>";
    }
} else {
    // Jika data yang diperlukan tidak dikirimkan, tampilkan pesan kesalahan
    echo "<script>alert('Data tidak lengkap')</script>";
    echo "<script>window.location.href = \"nilai_matriks.php\" </script>";
}
?>
