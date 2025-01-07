<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body { margin: 0; }
        .jumbotron-bg { 
            background-image: url('https://fkom.uniku.ac.id/wp-content/uploads/2023/01/Header-Home.jpg');
            background-size: cover;
            background-position: center;
            color: white;
        }
    </style>
</head>
<body>
    <header class="jumbotron-bg text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Selamat Datang di Website Kami</h1>
            <p class="lead">Ini adalah contoh jumbotron dengan latar belakang gambar di bagian atas halaman.</p>
        </div>
    </header>

    <div class="container-fluid my-4">
        <div class="row">
            <aside class="col-md-2 p-0">
                <nav class="nav flex-column bg-light p-3 m-0">
                    <a class="nav-link" href="?menu=home">Home</a>
                    <a class="nav-link" href="?menu=alumni">Alumni</a>
                    <a class="nav-link" href="?menu=bursa_kerja">Bursa Kerja</a>
                    <a class="nav-link" href="?menu=pencaharian_alumni">Cari Alumni</a>
                </nav>
            </aside>
            <main class="col-md-10">
                <article>
                    <?php
                    extract($_GET);
                    if (isset($menu)){ 
                        if ($menu == "home") {@include "Latihan_09_home.php";}
                        elseif ($menu == "about") {@include "Latihan_09_about.php";}
                        elseif ($menu == "alumni") {@include "Latihan_09_ralumni.php";}
                        elseif ($menu == "calumni") {@include "Latihan_09_calumni.php";}
                        else if($menu == "ualumni") {
                            @include "Latihan_09_alumni.php";
                        } 
                        elseif ($menu == "buku_tamu") {
                            @include "Latihan_09_buku_tamu.php"; // Menambahkan Buku Tamu
                        }
                        elseif ($menu == "bursa_kerja"){
                            @include "Latihan_09_bursa_kerja.php";
                        }
                        elseif ($menu == "pencaharian_alumni"){
                            @include "Latihan_09_pencaharian_alumni";
                        }
                    } else {
                        @include "Latihan_09_home.php";
                    }
                    ?>
                </article>
            </main>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 Website Kami. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>