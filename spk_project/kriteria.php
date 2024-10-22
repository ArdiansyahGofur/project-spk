<?php include 'koneksi.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kriteria</title>
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
    <?php include 'header.php'?>

    <div class="container">
        <ul class="navbar">
            <li><a href="kriteria.php">Tabel Kriteria</a></li>
            <li><a href="kriteria_tambah.php">Tambah Kriteria</a></li>
        </ul>

        <div class="table-container">
            <!-- Tab panes -->
            <div>
                <!--tabel kriteria-->
                <table>
                    <thead>
                        <tr>
                            <th>ID Kriteria</th>
                            <th>Nama Kriteria</th>  
                            <th>Bobot</th>
                            <th>Status</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = $koneksi->query('SELECT * FROM tab_kriteria');
                        while ($row = $sql->fetch_array()) {
                        ?>
                        <tr>
                            <td><?php echo $row[0] ?></td>
                            <td><?php echo $row[1] ?></td>
                            <td><?php echo $row[2] ?></td>
                            <td><?php echo $row[3] ?></td>
                            <td>
                                <a href="kriteria_edit.php?id_kriteria=<?php echo $row['id_kriteria'] ?>" class="button-like">Edit</a>
                            </td>
                            <td>
                                <a href="kriteria_hapus.php?id_kriteria=<?php echo $row['id_kriteria'] ?>" class="button-like">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!--tabel kriteria-->
            </div>
        </div>
    </div>
</body>
</html>
