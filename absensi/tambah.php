<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSiswa = mysqli_real_escape_string($conn, $_POST["id_siswa"]);
    $tanggal = mysqli_real_escape_string($conn, $_POST["tanggal"]);
    $kehadiran = mysqli_real_escape_string($conn, $_POST["kehadiran"]);
    $keterangan = mysqli_real_escape_string($conn, $_POST["keterangan"]);
    $mataPelajaran = mysqli_real_escape_string($conn, $_POST["mata_pelajaran"]);

    // Perbaiki jumlah kolom yang disertakan dalam pernyataan INSERT INTO dan bind_param
    $stmt = $conn->prepare("INSERT INTO absensi (id_siswa, tanggal, kehadiran, keterangan, mata_pelajaran) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isiss", $idSiswa, $tanggal, $kehadiran, $keterangan, $mataPelajaran);

    if ($stmt->execute()) {
        echo "Data absensi berhasil ditambahkan.";
        header("Location: tampil.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Ambil data dari tabel siswa untuk dropdown
$sqlSiswa = "SELECT id_siswa, nama_siswa FROM siswa";
$resultSiswa = $conn->query($sqlSiswa);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Absensi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Form Tambah Absensi</h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="id_siswa">ID Siswa:</label>
            <select class="form-control" name="id_siswa" required>
                <?php
                while ($rowSiswa = $resultSiswa->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($rowSiswa['id_siswa']) . "'>" . htmlspecialchars($rowSiswa['id_siswa']) . " - " . htmlspecialchars($rowSiswa['nama_siswa']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" name="tanggal" required>
        </div>

        <div class="form-group">
            <label for="kehadiran">Kehadiran:</label>
            <select class="form-control" name="kehadiran" required>
                <option value="1">Hadir</option>
                <option value="0">Tidak Hadir</option>
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea class="form-control" name="keterangan"></textarea>
        </div>

        <div class="form-group">
            <label for="mata_pelajaran">Mata Pelajaran:</label>
            <input type="text" class="form-control" name="mata_pelajaran" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Absensi</button>
        <a href="read.php" class="btn btn-danger">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
