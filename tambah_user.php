<?php
require_once('function.php');
include_once('templates/header.php');

// Proses untuk menambah user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tipe = $_POST['tipe'];

    // Panggil fungsi untuk menambah user
    $result = addUser($nama, $email, $password, $tipe);

    if ($result) {
        echo "<script>
                alert('User berhasil ditambahkan!');
                window.location.href = 'user.php'; // Redirect ke halaman user.php
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan user!');
              </script>";
    }
}
?>

<div class="main-panel m-5">
    <h2>Tambah User</h2>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="tipe">Tipe:</label>
            <select class="form-control" id="tipe" name="tipe" required>
                <option value="admin">Admin</option>
                <option value="pelanggan" selected>Pelanggan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah User</button>
    </form>
</div>

<?php
include_once('templates/footer.php');
?>