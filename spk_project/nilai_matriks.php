<?php include 'koneksi.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Matriks</title>
    <style>
        /* Reset some basic styles for better consistency across browsers */
        body, html {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .row {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #007BFF;
        }

        .form {
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

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 16px;
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #007BFF;
            color: white;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
    
</head>
<body>
    <?php include 'header.php';?>
    <script>
        function updateNilaiOptions1() {
            var krit = document.getElementById("krit").value;
            var nilai = document.getElementById("nilai");
            var options;

            // Hapus opsi yang ada
            nilai.innerHTML = '';

            // Definisikan opsi berdasarkan nilai "krit" yang dipilih
            if (krit == "1") {
                options = [
                    {value: "4", text: "Pengangguran"},
                    {value: "3", text: "Petani/Buruh"},
                    {value: "2", text: "Wiraswasta"},
                    {value: "1", text: "Lainnya"}
                ];
            } else if (krit == "2") {
                options = [
                    {value: "4", text: "<4m2"},
                    {value: "3", text: "4-6m2"},
                    {value: "2", text: "7-10m2"},
                    {value: "1", text: ">10m2"}
                ];
            } else if (krit == "3") {
                options = [
                    {value: "4", text: "Tanah"},
                    {value: "3", text: "Kayu/Papan"},
                    {value: "2", text: "Praket/Vinil/Ubin/Semen"},
                    {value: "1", text: "Marmer/Granit/Keramik"}
                ];
            } else if (krit == "4") {
                options = [
                    {value: "4", text: "Anyaman Bambu/Bambu"},
                    {value: "3", text: "Kayu"},
                    {value: "2", text: "Plasteran"},
                    {value: "1", text: "Tembok"}
                ];
            } else if (krit == "5") {
                options = [
                    {value: "4", text: "Air Hujan"},
                    {value: "3", text: "Air Sungai/Danau/Waduk"},
                    {value: "2", text: "Sumur"},
                    {value: "1", text: "Leding Meteran"}
                ];
            // Kurung kurawal tidak diperlukan di sini
            } else if (krit == "6") {
                options = [
                    {value: "4", text: "Bukan Listrik"},
                    {value: "3", text: "Listrik non PLN"},
                    {value: "2", text: "Listrik PLN"}
                ];
            } else {
                options = [
                    {value: "4", text: "4"},
                    {value: "3", text: "3"},
                    {value: "2", text: "2"},
                    {value: "1", text: "1"}
                ];
            }

            // Tambahkan opsi baru
            options.forEach(function(option) {
                var opt = document.createElement("option");
                opt.value = option.value;
                opt.text = option.text;
                nilai.add(opt);
            });
        }

        // Validasi form sebelum submit (opsional)
        function validateForm() {
            var alter = document.getElementById("alter").value;
            var krit = document.getElementById("krit").value;
            var nilai = document.getElementById("nilai").value;

            if (alter === "" || krit === "" || nilai === "") {
                alert("Silakan isi semua field.");
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="row">
            <div>
                <div class="section-title">Nilai Matriks</div>

                <!-- Form pengisian -->
                <div class="row">
                    <div>
                        <form class="form" action="tambah_nilai_matriks.php" method="post" onsubmit="return validateForm()">
                            <div class="form-group">
                                <select class="form-control" name="alter" id="alter">
                                    <option value="">Nama Alternatif</option>
                                    <?php
                                    $nama = $koneksi->query('SELECT * FROM tab_alternatif ORDER BY CAST(id_alternatif AS UNSIGNED) ASC');
                                    while ($datalter = $nama->fetch_array()) {
                                        echo "<option value=\"$datalter[id_alternatif]\">$datalter[nama_alternatif]</option>\n";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="krit" id="krit" onchange="updateNilaiOptions1()">
                                    <option value="">Nama Kriteria</option>
                                    <?php
                                    $krit = $koneksi->query('SELECT * FROM tab_kriteria ORDER BY CAST(id_kriteria AS UNSIGNED) ASC');
                                    while ($datakrit = $krit->fetch_array()) {
                                        echo "<option value=\"$datakrit[id_kriteria]\">$datakrit[nama_kriteria]</option>\n";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="nilai" id="nilai">
                                    <option value="">Nilai</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Proses</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Tabel alternatif -->
            <div>
                <div class="section-title">Tabel Alternatif</div>
                <table>
                    <thead>
                        <tr>
                            <th>ID Alternatif</th>
                            <th>Nama Alternatif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = $koneksi->query("SELECT * FROM tab_alternatif ORDER BY CAST(id_alternatif AS UNSIGNED) ASC"); // Query untuk mengambil data dan diurutkan berdasarkan id_alternatif yang di-cast ke UNSIGNED
                        while ($row = $sql->fetch_array()) {
                            echo "<tr><td align=\"center\">".$row[0]."</td>";
                            echo "<td align=\"left\">".$row[1]."</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Tabel kriteria -->
            <div>
                <div class="section-title">Tabel Kriteria</div>
                <table>
                    <thead>
                        <tr>
                            <th>ID Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = $koneksi->query('SELECT * FROM tab_kriteria');
                        while ($row = $sql->fetch_array()) {
                            echo "<tr><td align=\"center\">".$row[0]."</td>";
                            echo "<td align=\"left\">".$row[1]."</td>";
                            echo "<td align=\"left\">".$row[2]."</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
        <div>
    <div class="section-title">Tabel Pemberian Nilai</div>
    <?php
    // Query SQL dengan mengurutkan berdasarkan id_alternatif
    $sql = $koneksi->query("SELECT * FROM tab_topsis
        JOIN tab_alternatif ON tab_topsis.id_alternatif=tab_alternatif.id_alternatif
        JOIN tab_kriteria ON tab_topsis.id_kriteria=tab_kriteria.id_kriteria
        ORDER BY CAST(tab_alternatif.id_alternatif AS UNSIGNED) ASC, CAST(tab_kriteria.id_kriteria AS UNSIGNED) ASC"); // Mengkonversi VARCHAR ke UNSIGNED INT untuk pengurutan
    ?>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>ALTERNATIF</th>
                <th>KRITERIA</th>
                <th>NILAI</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=1;
            while ($row = $sql->fetch_array())
            {
                echo "<tr><td align=\"center\">".$no."</td>";
                echo "<td align=\"left\">".$row['nama_alternatif']."</td>";
                echo "<td align=\"left\">".$row['nama_kriteria']."</td>";
                echo "<td align=\"left\">".$row['nilai']."</td></tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

        </div>
    </div>
</body>
</html>
