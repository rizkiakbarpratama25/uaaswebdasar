<?php
session_start();

include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id_pengguna, username, password, role FROM pengguna WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_pengguna = $row["id_pengguna"];
        $storedPassword = $row["password"];
        $userRole = $row["role"];

        // Check password using sha1 (temporary for backward compatibility)
        if (sha1($password) == $storedPassword) {
            $_SESSION['username'] = $username; // Save session

            // Save role in the session
            $_SESSION['role'] = $userRole;

            // Redirect based on the user's role
            if ($userRole == 'admin') {
                header("Location: ../index.php");
            } elseif ($userRole == 'siswa') {
                header("Location: ../index.php");
            } else {
                // Handle other roles as needed
                header("Location: ../index.php");
            }
            exit();
        } else {
            $errorMessage = "Password salah. Silakan coba lagi.";
        }
    } else {
        $errorMessage = "Username tidak ditemukan. Silakan coba lagi.";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body class="container mt-5">

<h2 class="mb-4">Form Login</h2>

<?php if (isset($errorMessage)) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage; ?>
    </div>
<?php endif; ?>

<form method="post" action="">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" required>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
</form>

</body>
</html>
