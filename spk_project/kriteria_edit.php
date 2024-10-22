<?php 
    include 'koneksi.php';

    $id_krit  = $_GET['id_kriteria'];
    $kriteria = $koneksi->query("SELECT * FROM tab_kriteria WHERE id_kriteria = '$id_krit' ");

    while ($row = $kriteria->fetch_row()) {
        $nama_kriteria  = $row[1];
        $bobot = $row[2];
        $status = $row[3];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kriteria</title>
    <style>
        /* Reset some basic styles for better consistency across browsers */
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
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
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
            width: 100%; /* Menyesuaikan lebar input dengan container */
            box-sizing: border-box; /* Memastikan padding tidak menambah lebar input */
        }

        .form-control:focus {
            border-color: #007BFF;
            outline: none;
        }

        select.form-control {
            appearance: none; /* Remove default arrow in select */
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%; /* Menyesuaikan lebar select dengan container */
            box-sizing: border-box; /* Memastikan padding tidak menambah lebar select */
            background-image: linear-gradient(45deg, transparent 50%, #007BFF 50%),
                              linear-gradient(135deg, #007BFF 50%, transparent 50%);
            background-position: calc(100% - 20px) calc(1em + 2px),
                                  calc(100% - 15px) calc(1em + 2px);
            background-size: 5px 5px, 5px 5px;
            background-repeat: no-repeat;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px; /* Jarak antara tombol dengan form */
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none; /* Hapus underline pada link */
            text-align: center; /* Memastikan teks berada di tengah tombol */
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <!-- <?php include 'header.php' ?> -->

    <div class="container">
        <h2>Edit Kriteria</h2>

        <form action="edit_kriteria.php" method="post">
            <div class="form-group">
                <label>ID Kriteria</label>
                <input class="form-control" type="text" name="id_kriteria" value="<?php echo $_GET['id_kriteria']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Nama Kriteria</label>
                <input class="form-control" type="text" name="nama_kriteria" value="<?php echo $nama_kriteria; ?>" placeholder="Nama Kriteria" required>
            </div>
            <div class="form-group">
                <label>Bobot</label>
                <input class="form-control" type="text" name="bobot" value="<?php echo $bobot; ?>" placeholder="Bobot" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" required>
                    <option value="" disabled>Select status</option>
                    <option value="Cost" <?php if ($status == "Cost") echo "selected"; ?>>Cost</option>
                    <option value="Benefit" <?php if ($status == "Benefit") echo "selected"; ?>>Benefit</option>
                </select>
            </div>
            <div class="btn-group">
                <a href="kriteria.php" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-success">Ubah</button>
            </div>
        </form>
    </div>
</body>
</html>
