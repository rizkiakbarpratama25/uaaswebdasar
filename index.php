<?php
session_start();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    // Pengguna sudah login
    $loginButton = '<a class="nav-link" href="auth/logout.php">Log Out</a>';
} else {
    // Pengguna belum login
    $loginButton = '<a class="nav-link" href="auth/login.php">Log In</a>';
}

// Check if the user is an admin
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Website Ini</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Warna background */
        }

        .navbar {
            background-color: #007bff; /* Warna navbar */
        }

        .navbar-brand {
            color: #ffffff; /* Warna teks navbar brand */
        }

        .navbar-nav .nav-link {
            color: #ffffff; /* Warna teks navbar link */
        }

        .jumbotron {
            background: none;
            color: #ffffff;
            text-align: center;
            padding: 100px 0;
            margin-bottom: 0;
            position: relative; /* Tambahkan property position */
        }

        .jumbotron img {
            width: 100%;
            height: 610px;
            position: absolute; /* Tambahkan property position */
            top: 0; /* Tambahkan property top */
            left: 0; /* Tambahkan property left */
        }

        .jumbotron h1 {
            position: absolute; /* Tambahkan property position */
            top: 50%; /* Tambahkan property top */
            left: 50%; /* Tambahkan property left */
            transform: translate(-50%, -50%); /* Tambahkan property transform */
            margin: 0; /* Tambahkan property margin */
        }

        footer {
            background-color: #007bff; /* Warna footer */
            color: #ffffff; /* Warna teks footer */
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Sekolah Bumigora</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="absensi/tampilabsensi.php">Absensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="siswa/tampilsiswa.php">Siswa</a>
                </li>
                <!-- Dropdown -->
                <?php if ($isAdmin) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CRUD
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="absensi/tampil.php">Absensi</a>
                            <a class="dropdown-item" href="pengguna/tampil.php">Pengguna</a>
                            <a class="dropdown-item" href="siswa/tampil.php">Siswa</a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php echo $loginButton; ?>
            </ul>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron">
        <?php $pathToSchoolImage = 'gambar3.jpg'; ?>
        <img src="<?php echo $pathToSchoolImage; ?>" alt="Gambar Depan" class="img-fluid">
        <h1 class="display-4">Selamat Datang di website kami</h1>
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Sekolah Bumigora. All rights reserved.</p>
    </footer>

    <!-- Tambahkan script JS Bootstrap dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
