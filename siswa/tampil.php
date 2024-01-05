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
include '../koneksi.php';
$no = 1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<?php include '../komponen/navbar.php'; ?>
<div class="container mt-5">
    <h2>Data Siswa</h2>
    <a href="tambah.php" class="btn btn-success mb-2">Tambah Siswa</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM siswa";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row["nama_siswa"] . "</td>";
                    echo "<td>" . $row["kelas"] . "</td>";
                    echo "<td>" . $row["jurusan"] . "</td>";
                    echo "<td>" . $row["tanggal_lahir"] . "</td>";
                    echo "<td>" . $row["alamat"] . "</td>";
                    echo "<td>
                        <a href='edit.php?id_siswa=" . $row['id_siswa'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='hapus.php?id_siswa=" . $row['id_siswa'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data?\")'>Hapus</a>
                    </td>"; // Tombol edit dan hapus
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data siswa.</td></tr>";
            }

            // Tutup koneksi ke database
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Tambahkan script JS Bootstrap dan jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
