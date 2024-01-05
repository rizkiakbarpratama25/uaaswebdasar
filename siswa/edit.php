<?php
// File: edit.php

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

// Cek apakah ada parameter id_siswa yang dikirimkan melalui URL
if (isset($_GET['id_siswa'])) {
    $idSiswa = $_GET['id_siswa'];

    // Ambil data siswa berdasarkan id_siswa
    $sqlGetData = "SELECT * FROM siswa WHERE id_siswa = $idSiswa";
    $resultGetData = $conn->query($sqlGetData);

    if ($resultGetData->num_rows > 0) {
        $dataSiswa = $resultGetData->fetch_assoc();

        // Lakukan proses update jika formulir dikirimkan
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $namaSiswa = mysqli_real_escape_string($conn, $_POST["nama_siswa"]);
            $kelas = mysqli_real_escape_string($conn, $_POST["kelas"]);
            $jurusan = mysqli_real_escape_string($conn, $_POST["jurusan"]);
            $tanggalLahir = mysqli_real_escape_string($conn, $_POST["tanggal_lahir"]);
            $alamat = mysqli_real_escape_string($conn, $_POST["alamat"]);

            // Query SQL untuk memperbarui data siswa
            $sqlUpdate = "UPDATE siswa SET nama_siswa='$namaSiswa', kelas='$kelas', jurusan='$jurusan', tanggal_lahir='$tanggalLahir', alamat='$alamat' WHERE id_siswa=$idSiswa";

            if ($conn->query($sqlUpdate) === TRUE) {
                echo "Data siswa berhasil diperbarui.";
                header("Location: tampil.php");
                exit();
            } else {
                echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
            }
        }

        // Tutup koneksi ke database
        $conn->close();
    } else {
        echo "Data siswa tidak ditemukan.";
    }
} else {
    echo "Parameter id_siswa tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Form Edit Siswa</h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="nama_siswa">Nama Siswa:</label>
            <input type="text" class="form-control" name="nama_siswa" value="<?php echo $dataSiswa['nama_siswa']; ?>" required>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas:</label>
            <input type="text" class="form-control" name="kelas" value="<?php echo $dataSiswa['kelas']; ?>" required>
        </div>

        <div class="form-group">
            <label for="jurusan">Jurusan:</label>
            <input type="text" class="form-control" name="jurusan" value="<?php echo $dataSiswa['jurusan']; ?>" required>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $dataSiswa['tanggal_lahir']; ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" name="alamat" required><?php echo $dataSiswa['alamat']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="tampil.php" class="btn btn-danger">Cancel</a>

    </form>
</div>

<!-- Tambahkan script JS Bootstrap dan jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
