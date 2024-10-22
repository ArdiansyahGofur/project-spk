<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Header</title>
        <style>
            /* Reset some basic styles for better consistency across browsers */
            body, h1, ul, li, a {
                margin: 0;
                padding: 0;
                text-decoration: none;
                list-style: none;
                color: inherit;
            }

            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }

            nav {
                background-color: #007BFF;
                color: #fff;
                padding: 10px 0;
            }

            nav > div {
                display: flex;
                justify-content: space-between;
                align-items: center;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            nav a {
                color: #fff;
                font-size: 24px;
                font-weight: bold;
            }

            nav ul {
                display: flex;
                gap: 20px;
            }

            nav ul li a {
                color: #fff;
                font-size: 18px;
                padding: 10px 15px;
                transition: background 0.3s;
            }

            nav ul li a:hover {
                background-color: #0056b3;
                border-radius: 5px;
            }

            @media (max-width: 768px) {
                nav > div {
                    flex-direction: column;
                    align-items: flex-start;
                }

                nav ul {
                    flex-direction: column;
                    width: 100%;
                    margin-top: 10px;
                }

                nav ul li {
                    width: 100%;
                }

                nav ul li a {
                    display: block;
                    width: 100%;
                    text-align: center;
                }
            }
        </style>
    </head>
    <body>
        <nav>
            <div>
                <div>
                    <a href="#">Sistem Pendukung Keputusan Metode TOPSIS</a>
                </div>
                <div>
                    <ul>
                        <li>
                            <a href="kriteria.php">Kriteria</a>
                        </li>
                        <li>
                            <a href="alternatif.php">Alternatif</a>
                        </li>
                        <li>
                            <a href="nilai_matriks.php">Nilai Matriks</a>
                        </li>
                        <li>
                            <a href="hasil_topsis.php">Hasil Topsis</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>
