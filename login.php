<?php
session_start();
require_once('function.php');

// Cek jika sudah login
if (isset($_SESSION['id_user'])) {
    header('Location: index.php'); // Redirect ke halaman utama jika sudah login
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah email dan password sesuai
    $query = "SELECT * FROM user WHERE email = '$email'";
    $user = query($query);

    // Cek jika user ditemukan
    if ($user) {
        $user = $user[0]; // Ambil data user pertama

        // Cek password
        if (password_verify($password, $user['password'])) {
            // Simpan id_user ke session
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['tipe'] = $user['tipe'];

            // Redirect berdasarkan tipe user
            if ($user['tipe'] == 'admin') {
                header('Location: index.php'); // Redirect ke dashboard admin
            } else {
                header('Location: index.php'); // Redirect ke halaman utama pengguna
            }
            exit;
        } else {
            $error_message = "Password salah!";
        }
    } else {
        $error_message = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger"><?= $error_message; ?></div>
        <?php endif; ?>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>