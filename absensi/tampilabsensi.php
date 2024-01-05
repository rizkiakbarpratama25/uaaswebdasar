<?php
session_start();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    // Pengguna sudah login
    $logoutButton = '<a class="nav-link" href="../auth/logout.php">Log Out</a>';
} else {
    // Pengguna belum login
    $logoutButton = '<a class="nav-link" href="../auth/logout.php">Log in</a>';
}

include '../koneksi.php';
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php include '../komponen/navbar.php'; ?>
<div class="container mt-5">
    <h2>Data Absensi</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Tanggal</th>
                <th>Kehadiran</th>
                <th>Keterangan</th>
                <th>Mata Pelajaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Adjusted SQL query to join with the appropriate columns
            $sql = "SELECT absensi.id_absensi, absensi.id_pengguna, siswa.nama_siswa, absensi.tanggal, absensi.kehadiran, absensi.keterangan, absensi.mata_pelajaran
                    FROM absensi
                    JOIN siswa ON absensi.id_siswa = siswa.id_siswa";

            $result = $conn->query($sql);

            if ($result === false) {
                die("Error: " . $conn->error);
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row["nama_siswa"] . "</td>";
                    echo "<td>" . $row["tanggal"] . "</td>";
                    echo "<td>" . ($row["kehadiran"] ? 'Hadir' : 'Tidak Hadir') . "</td>";
                    echo "<td>" . $row["keterangan"] . "</td>";
                    echo "<td>" . $row["mata_pelajaran"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data absensi.</td></tr>";
            }

            // Tutup koneksi ke database
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Tambahkan script JS Bootstrap dan jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
