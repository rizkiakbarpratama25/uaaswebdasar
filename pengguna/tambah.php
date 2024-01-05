<?php
// File: tambah.php

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["txtpassword"]); // Tidak perlu menggunakan sha1 disini
    $namaDepan = mysqli_real_escape_string($conn, $_POST["nama_depan"]);
    $namaBelakang = mysqli_real_escape_string($conn, $_POST["nama_belakang"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $role = mysqli_real_escape_string($conn, $_POST["role"]);

    // Hash password menggunakan sha1 (temporary for backward compatibility)
    $hashedPassword = sha1($password);

    // Query SQL untuk memasukkan data ke dalam tabel
    $sql = "INSERT INTO pengguna (username, password, nama_depan, nama_belakang, email, role) 
            VALUES ('$username', '$hashedPassword', '$namaDepan', '$namaBelakang', '$email', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Data pengguna berhasil ditambahkan.";
        header("Location: tampil.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi ke database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Form Tambah Pengguna</h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="form-group">
            <label for="txtpassword">Password:</label>
            <input type="password" class="form-control" name="txtpassword" required>
        </div>

        <div class="form-group">
            <label for="nama_depan">Nama Depan:</label>
            <input type="text" class="form-control" name="nama_depan" required>
        </div>

        <div class="form-group">
            <label for="nama_belakang">Nama Belakang:</label>
            <input type="text" class="form-control" name="nama_belakang" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" name="role" required>
                <option value="admin">Admin</option>
                <option value="siswa">Siswa</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
        <a href="tampil.php" class="btn btn-danger">Cancel</a>
        
    </form>
</div>

<!-- Tambahkan script JS Bootstrap dan jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
