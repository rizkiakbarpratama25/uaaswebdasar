<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add Tailwind CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Your other CSS files and styles can be added here -->
</head>

<body>

    <?php

    // Periksa apakah pengguna sudah login
    if (isset($_SESSION['username'])) {
        // Pengguna sudah login
        $logoutButton = '<a class="nav-link" href="../auth/logout.php">Log Out</a>';
    } else {
        // Pengguna belum login
        $logoutButton = '<a class="nav-link" href="../auth/logout.php">Log out</a>';
    }
    // Check if the user is an admin
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Sekolah Bumigora</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../absensi/tampilabsensi.php">Absensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../siswa/tampilsiswa.php">Siswa</a>
                </li>
                <!-- Dropdown -->
                <?php if ($isAdmin) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CRUD
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../absensi/tampil.php">Absensi</a>
                            <a class="dropdown-item" href="../pengguna/tampil.php">Pengguna</a>
                            <a class="dropdown-item" href="../siswa/tampil.php">Siswa</a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php echo $logoutButton; ?>
            </ul>
        </div>
    </nav>

    <!-- Add Bootstrap JS and Popper.js (required for some Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Your other JavaScript files and scripts can be added here -->
</body>

</html>
