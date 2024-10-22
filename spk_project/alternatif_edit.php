<?php 
    include 'koneksi.php';

    $id_alter   = $_GET['id_alternatif'];
    $alternatif = $koneksi->query("SELECT * FROM tab_alternatif WHERE id_alternatif = '".$id_alter."'");

    while ($row = $alternatif->fetch_row())
    {
        $nama  = $row[1];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alternatif</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <!-- <?php //include 'header.php' ?> -->

    <div class="container">
        <h2>Edit Alternatif</h2>

        <form class="form" action="edit_alternatif.php" method="post">
            <div class="form-group">
                <input class="form-control" type="text" name="id_alternatif" value= "<?php echo $_GET['id_alternatif']; ?>" readonly>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="nama_alternatif" value= "<?php echo $nama; ?>" >
            </div>
            <div class="form-group">
                <a href="alternatif.php"><button type="button" class="btn btn-danger">Batal</button></a>
                <button type="submit" class="btn btn-success">Ubah</button>
            </div>
        </form>
    </div>
</body>
</html>
