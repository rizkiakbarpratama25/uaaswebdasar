<?php
session_start();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    // Pengguna sudah login
    $loginButton = '<a class="nav-link" href="../auth/logout.php">Log Out</a>';
} else {
    // Pengguna belum login
    $loginButton = '<a class="nav-link" href="../auth/login.php">Log In</a>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Pengguna</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<?php include '../komponen/navbar.php'; ?>

<div class="container mt-4">
    <h2>Daftar Pengguna</h2>

    <!-- Tombol Tambah Data -->
    <a href="../pengguna/tambah.php" class="btn btn-primary mb-3">Tambah Data</a>

    <!-- Tabel untuk menampilkan daftar pengguna -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Depan</th>
                <th>Nama Belakang</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th> <!-- Kolom baru untuk menampilkan tombol aksi -->
            </tr>
        </thead>
        <tbody>
        <?php
        // Include file koneksi.php
        include '../koneksi.php';
        $no = 1;

        // Query SQL untuk mengambil data dari tabel pengguna
        $sql = "SELECT id_pengguna, username, nama_depan, nama_belakang, email, role FROM pengguna";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["nama_depan"] . "</td>";
                echo "<td>" . $row["nama_belakang"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["role"] . "</td>";
                echo "<td>
                    <a href='../pengguna/edit.php?id_pengguna=" . $row['id_pengguna'] . "' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='../pengguna/hapus.php?id_pengguna=" . $row['id_pengguna'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data?')\">Hapus</a>
                </td>"; // Tombol edit dan hapus
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data pengguna.</td></tr>";
        }

        // Tutup koneksi ke database
        $conn->close();
        ?>
        </tbody>
    </table>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
