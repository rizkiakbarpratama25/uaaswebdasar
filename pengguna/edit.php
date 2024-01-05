<?php
// Include file koneksi.php
include '../koneksi.php';
session_start();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    // Pengguna sudah login
    $loginButton = '<a class="nav-link" href="../auth/logout.php">Log Out</a>';
} else {
    // Pengguna belum login
    $loginButton = '<a class="nav-link" href="../auth/login.php">Log In</a>';
}

// Cek apakah ada parameter id_pengguna yang dikirimkan melalui URL
if (isset($_GET['id_pengguna'])) {
    $idPengguna = mysqli_real_escape_string($conn, $_GET['id_pengguna']);

    // Ambil data pengguna berdasarkan id_pengguna
    $sqlGetData = "SELECT * FROM pengguna WHERE id_pengguna = $idPengguna";
    $resultGetData = $conn->query($sqlGetData);

    if ($resultGetData->num_rows > 0) {
        $dataPengguna = $resultGetData->fetch_assoc();

        // Lakukan proses update jika formulir dikirimkan
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = mysqli_real_escape_string($conn, $_POST["username"]);
            $password = mysqli_real_escape_string($conn, sha1(htmlspecialchars($_POST["txtpassword"])));
            $namaDepan = mysqli_real_escape_string($conn, $_POST["nama_depan"]);
            $namaBelakang = mysqli_real_escape_string($conn, $_POST["nama_belakang"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $role = mysqli_real_escape_string($conn, $_POST["role"]);

            // Query SQL untuk memperbarui data pengguna
            $sqlUpdate = "UPDATE pengguna SET username='$username', password='$password', nama_depan='$namaDepan', nama_belakang='$namaBelakang', email='$email', role='$role' WHERE id_pengguna=$idPengguna";

            if ($conn->query($sqlUpdate) === TRUE) {
                echo "Data pengguna berhasil diperbarui.";
                header("Location: tampil.php");
                exit();
            } else {
                echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
            }
        }

        // Tutup koneksi ke database
        $conn->close();
    } else {
        echo "Data pengguna tidak ditemukan.";
    }
} else {
    echo "Parameter id_pengguna tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Form Edit Pengguna</h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" value="<?php echo $dataPengguna['username']; ?>" required>
        </div>

        <div class="form-group">
            <label for="txtpassword">Password:</label>
            <input type="password" class="form-control" name="txtpassword">
        </div>

        <div class="form-group">
            <label for="nama_depan">Nama Depan:</label>
            <input type="text" class="form-control" name="nama_depan" value="<?php echo $dataPengguna['nama_depan']; ?>" required>
        </div>

        <div class="form-group">
            <label for="nama_belakang">Nama Belakang:</label>
            <input type="text" class="form-control" name="nama_belakang" value="<?php echo $dataPengguna['nama_belakang']; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $dataPengguna['email']; ?>" required>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" name="role" required>
                <option value="admin" <?php echo ($dataPengguna['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="siswa" <?php echo ($dataPengguna['role'] == 'siswa') ? 'selected' : ''; ?>>Siswa</option>
            </select>
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
