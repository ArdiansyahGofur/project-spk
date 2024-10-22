<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alternatif</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background: #007BFF;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            font-size: 24px;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
            background: #007BFF;
            margin: 0;
        }

        .navbar li {
            display: inline;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            display: block;
        }

        .navbar a:hover {
            background: #0056b3;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }

        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #007BFF;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Tautan Edit dan Hapus diubah menjadi tombol */
        table a.button-like {
            display: inline-block;
            padding: 8px 16px;
            background-color: #28a745; /* hijau */
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s;
        }

        table a.button-like:hover {
            background-color: #218838; /* hijau gelap saat hover */
        }

        table a.button-delete {
            display: inline-block;
            padding: 8px 16px;
            background-color: #dc3545; /* merah */
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s;
        }

        table a.button-delete:hover {
            background-color: #c82333; /* merah gelap saat hover */
        }

        /* Memastikan tautan Edit dan Hapus sesuai dengan desain tombol */
        table td a {
            display: inline-block;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <ul class="navbar">
            <li><a href="alternatif.php">Tabel Alternatif</a></li>
            <li><a href="alternatif_tambah.php">Tambah Alternatif</a></li>
        </ul>

        <div class="table-container">
            <!-- Tabel alternatif -->
            <table>
                <thead>
                    <tr>
                        <th>ID Alternatif</th>
                        <th>Nama Alternatif</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'koneksi.php'; // Sertakan file koneksi.php
                    $sql = $koneksi->query("SELECT * FROM tab_alternatif ORDER BY CAST(id_alternatif AS UNSIGNED) ASC"); // Query untuk mengambil data dan diurutkan berdasarkan id_alternatif yang di-cast ke UNSIGNED
                    while ($row = $sql->fetch_assoc()) { // Looping untuk menampilkan data
                    ?>
                    <tr>
                        <td><?php echo $row['id_alternatif']; ?></td>
                        <td><?php echo $row['nama_alternatif']; ?></td>
                        <td>
                            <a href="alternatif_edit.php?id_alternatif=<?php echo $row['id_alternatif']; ?>" class="button-like">Edit</a>
                        </td>
                        <td>
                            <a href="alternatif_hapus.php?id_alternatif=<?php echo $row['id_alternatif']; ?>" class="button-delete">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- Akhir tabel alternatif -->
        </div>
    </div>
</body>
</html>
