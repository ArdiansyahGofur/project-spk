<?php 
    include 'koneksi.php' ;

    //pemberian kode id secara otomatis
    $carikode = $koneksi->query("SELECT id_alternatif FROM tab_alternatif") or die(mysqli_error());
    $datakode = $carikode->fetch_array();
    $jumlah_data = mysqli_num_rows($carikode);

    if ($datakode) {
    $nilaikode = substr($jumlah_data, 1);
    $kode = (int) $nilaikode;
    $kode = $jumlah_data + 1;
    $kode_otomatis = str_pad($kode, 0, STR_PAD_LEFT);
    } else {
    $kode_otomatis = "1";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kriteria</title>
    <style>
        /* Reset basic styles for better consistency across browsers */
        
        body, h1, ul, li, a, input, select, form, div {
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background: #007BFF;
            color: #fff;
            width: 100%;
            padding: 10px 0;
            text-align: center;
            font-size: 24px;
        }

        .container {
            width: 80%;
            max-width: 800px;
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
            margin: 0 0 20px;
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

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-control {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-control:focus {
            border-color: #007BFF;
            outline: none;
        }

        .btn {
            padding: 10px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <!-- <?php include 'header.php' ?> -->

    <div class="container">
        <ul class="navbar">
            <li><a href="alternatif.php">Tabel Alternatif</a></li>
            <li><a href="alternatif_tambah.php">Tambah Alternatif</a></li>
        </ul>

        <h2>Tambah Kriteria</h2>

        <!--form alternatif-->
        <form class="form" action="tambah_alternatif.php" method="post">
            <div class="form-group">
                <input class="form-control" type="text" name="id_alter" value="<?php echo $kode_otomatis ?>" readonly>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="nm_alter" placeholder="Nama Alternatif" required>
            </div>
            <div class="form-group">
                <input class="btn btn-success" type="submit" name="simpan" value="Tambah">
            </div>
        </form>
        <!--form alternatif-->
    </div>
</body>
</html>
