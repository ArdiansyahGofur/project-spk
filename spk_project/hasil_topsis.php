<?php
    include 'koneksi.php';

    $tampil = $koneksi->query("SELECT b.nama_alternatif, c.nama_kriteria, a.nilai, c.bobot, c.status
    FROM tab_topsis a
    JOIN tab_alternatif b ON a.id_alternatif = b.id_alternatif
    JOIN tab_kriteria c ON a.id_kriteria = c.id_kriteria
    ORDER BY CAST(b.id_alternatif AS UNSIGNED) ASC, CAST(c.id_kriteria AS UNSIGNED) ASC");



    $data      =array();
    $kriterias =array();
    $bobot     =array();
    $nilai_kuadrat =array();
    $status=array();

    if ($tampil) {
    while($row=$tampil->fetch_object()){
        if(!isset($data[$row->nama_alternatif])){
        $data[$row->nama_alternatif]=array();
        }
        if(!isset($data[$row->nama_alternatif][$row->nama_kriteria])){
        $data[$row->nama_alternatif][$row->nama_kriteria]=array();
        }
        if(!isset($nilai_kuadrat[$row->nama_kriteria])){
        $nilai_kuadrat[$row->nama_kriteria]=0;
        }
        $bobot[$row->nama_kriteria]=$row->bobot;
        $data[$row->nama_alternatif][$row->nama_kriteria]=$row->nilai;
        $nilai_kuadrat[$row->nama_kriteria]+=pow($row->nilai,2);
        $kriterias[]=$row->nama_kriteria;
        $status[$row->nama_kriteria]=$row->status;
    }
    }

    $kriteria     =array_unique($kriterias);
    $jml_kriteria =count($kriteria);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hasil Topsis</title>
        <style>
           /* Reset default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 20px;
}

.container {
    width: 100%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.row {
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th {
    padding: 10px;
    text-align: center;
    background-color: #007BFF; /* Warna latar belakang untuk th */
    color: #fff; /* Warna teks untuk th */
}

td {
    padding: 10px;
    text-align: center;
}

tbody tr:nth-child(even) {
    background-color: #f1f1f1;
}

tbody tr:hover {
    background-color: #ccc;
}

/* Custom styles for specific tables */
.container table {
    margin-bottom: 40px;
}

.container h3 {
    text-align: center;
    margin-bottom: 20px;
}

/* Responsiveness for smaller screens */
@media screen and (max-width: 768px) {
    table {
        font-size: 14px;
    }

    th, td {
        padding: 8px;
    }
}

/* Styling for specific elements */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #007BFF;
}

.subtitle {
    font-size: 18px;
    font-weight: bold;
    color: #007BFF;
    margin-bottom: 10px;
}

/* Styling untuk default */
th.default {
    background-color: transparent !important; /* Hapus latar belakang khusus untuk kolom Alternatif */
    color: black; /* Warna teks hitam untuk kolom Alternatif */
}

        </style>
    </head>
    <body>
        <?php include 'header.php' ?>

            <!--tabel-tabel-->
        <div class="container"> <!--container-->
        <div class="row">
            <div>
            <div>
                <div>
                Evaluation Matrix (x<sub>ij</sub>)
                </div>
                <div>
                <table>
                    <thead>
                    <tr>
                        <th rowspan='3'>No</th>
                        <th rowspan='3'>Alternatif</th>
                        <th rowspan='3'>Nama</th>
                        <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                    </tr>
                    <tr>
                        <?php
                        foreach($kriteria as $k)
                        echo "<th>$k</th>\n";
                        ?>
                    </tr>
                    <tr>
                        <?php
                        for($n=1;$n<=$jml_kriteria;$n++)
                        echo "<th>C$n</th>";
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    foreach($data as $nama=>$krit){
                        echo "<tr>
                        <td>".(++$i)."</td>
                        <th class = 'default'>A$i</th>
                        <td>$nama</td>";
                        foreach($kriteria as $k){
                        echo "<td align='center'>$krit[$k]</td>";
                        }
                        echo "</tr>\n";
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div>
            <div>
                <div>
                Rating Kinerja Ternormalisasi (r<sub>ij</sub>)
                </div>
                <div>
                <table>
                    <thead>
                    <tr>
                        <th rowspan='3'>No</th>
                        <th rowspan='3'>Alternatif</th>
                        <th rowspan='3'>Nama</th>
                        <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                    </tr>
                    <tr>
                        <?php
                        foreach($kriteria as $k)
                        echo "<th>$k</th>\n";
                        ?>
                    </tr>
                    <tr>
                        <?php
                        for($n=1;$n<=$jml_kriteria;$n++)
                        echo "<th>C$n</th>";
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    foreach($data as $nama=>$krit){
                        echo "<tr>
                        <td>".(++$i)."</td>
                        <th class = 'default'>A{$i}</th>
                        <td>{$nama}</td>";
                        foreach($kriteria as $k){
                        echo 
                        "<td align='center'>".round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4).
                        "</td>";
                        }
                        echo
                        "</tr>\n";
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div>
            <div>
                <div">
                Rating Bobot Ternormalisasi(y<sub>ij</sub>)
                </div>
                <div>
                <table>
                    <thead>
                    <tr>
                        <th rowspan='3'>No</th>
                        <th rowspan='3'>Alternatif</th>
                        <th rowspan='3'>Nama</th>
                        <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                    </tr>
                    <tr>
                        <?php
                        foreach($kriteria as $k)
                        echo "<th>$k</th>\n";
                        ?>
                    </tr>
                    <tr>
                        <?php
                        for($n=1;$n<=$jml_kriteria;$n++)
                        echo "<th>C$n</th>";
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    $y=array();
                    foreach($data as $nama=>$krit){
                        echo "<tr>
                        <td>".(++$i)."</td>
                        <th class = 'default'>A{$i}</th>
                        <td>{$nama}</td>";
                        foreach($kriteria as $k){
                        $y[$k][$i-1]=round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4)*$bobot[$k];
                        echo "<td align='center'>".$y[$k][$i-1]."</td>";
                        }
                        echo
                        "</tr>\n";
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div>
            <div>
                <div>
                Solusi Ideal positif (A<sup>+</sup>)
                </div>
                <div>
                <table>
                    <thead>
                    <tr>
                        <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                    </tr>
                    <tr>
                        <?php
                        foreach($kriteria as $k)
                        echo "<th>$k</th>\n";
                        ?>
                    </tr>
                    <tr>
                        <?php
                        for($n=1;$n<=$jml_kriteria;$n++)
                        echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        $yplus=array();
                        foreach($kriteria as $k){
                        $yplus[$k]=($status[$k]=='Cost'?max($y[$k]):min($y[$k]));
                        
                        echo "<th class = 'default'>$yplus[$k]</th>";

                        }
                        ?>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div>
            <div>
                <div>
                Solusi Ideal negatif (A<sup>-</sup>)
                </div>
                <div>
                <table>
                    <thead>
                    <tr>
                        <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                    </tr>
                    <tr>
                        <?php
                        foreach($kriteria as $k)
                        echo "<th>{$k}</th>\n";
                        ?>
                    </tr>
                    <tr>
                        <?php
                        for($n=1;$n<=$jml_kriteria;$n++)
                        echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        $ymin=array();
                        foreach($kriteria as $k){
                        $ymin[$k]=($status[$k]=='Benefit'?max($y[$k]):min($y[$k]));
                        echo "<th class = 'default'>{$ymin[$k]}</th>";
                        }

                        ?>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div>
            <div>
                <div>
                Jarak positif (D<sub>i</sub><sup>+</sup>)
                </div>
                <div>
                <table>
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        <th>Nama</th>
                        <th>D<suo>+</sup></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    $dplus=array();
                    foreach($data as $nama=>$krit){
                        echo "<tr>
                        <td>".(++$i)."</td>
                        <th class = 'default'>A{$i}</th>
                        <td>{$nama}</td>";
                        foreach($kriteria as $k){
                        if(!isset($dplus[$i-1])) $dplus[$i-1]=0;
                        $dplus[$i-1]+=pow($yplus[$k]-$y[$k][$i-1],2);
                        }
                        echo "<td>".round(sqrt($dplus[$i-1]),4)."</td>
                        </tr>\n";
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div>
            <div>
                <div>
                Jarak negatif (D<sub>i</sub><sup>-</sup>)
                </div>
                <div>
                <table>
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        <th>Nama</th>
                        <th>D<suo>-</sup></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    $dmin=array();
                    foreach($data as $nama=>$krit){
                        echo "<tr>
                        <td>".(++$i)."</td>
                        <th class = 'default'>A{$i}</th>
                        <td>{$nama}</td>";
                        foreach($kriteria as $k){
                        if(!isset($dmin[$i-1]))$dmin[$i-1]=0;
                        $dmin[$i-1]+=pow($ymin[$k]-$y[$k][$i-1],2);
                        }
                        echo "<td>".round(sqrt($dmin[$i-1]),4)."</td>

                        </tr>\n";
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div>
            <div>
                <div>
                Nilai Preferensi(V<sub>i</sub>)
                </div>
                <div>
                <table>
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        <th>Nama</th>
                        <th>V<sub>i</sub></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                            $i=0;
                            $V=array();
                            $Y=array();
                            $Z=array();                        
                            $hasilakhir=array();
                            

                            foreach ($data as $nama => $krit) {
                                echo "<tr>
                                <td>".(++$i)."</td>
                                <th class = 'default'>A{$i}</th>
                                <td>{$nama}</td>";             
                        foreach($kriteria as $k){
                        $V[$i-1]=round(sqrt($dmin[$i-1]),4)/(round(sqrt($dmin[$i-1]),4)+round(sqrt($dplus[$i-1]),4));
                        }
                        echo "<td>{$V[$i-1]}</td></tr>\n";
                    }
                    ?>
                    </tbody>
                </table>
                <br>
                Nilai Urut
                <br>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>V<sub>i</sub></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 0;
                        $V = array();
                        
                        // Menghitung nilai V dan menyimpannya dalam array asosiatif
                        foreach ($data as $nama => $krit) {
                            $V[$nama] = round(sqrt($dmin[$i]), 4) / (round(sqrt($dmin[$i]), 4) + round(sqrt($dplus[$i]), 4));
                            $i++;
                        }

                        // Mengurutkan data berdasarkan nilai V dari yang terbesar ke yang terkecil
                        arsort($V);

                        $i = 0;
                        foreach ($V as $nama => $nilai) {
                            echo "<tr>
                                <td>" . (++$i) . "</td>
                                <td>{$nama}</td>
                                <td>{$nilai}</td>
                            </tr>\n";
                        }
                        ?>
                    </tbody>
                </table>

                </div>
            </div>
            </div>
        </div>
        </div> <!--container-->
    </body>
</html>