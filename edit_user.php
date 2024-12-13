<?php
require_once('function.php');
include_once('templates/header.php');

// Cek jika ada ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Ambil data user berdasarkan ID
    $query = "SELECT * FROM user WHERE id_user = $id_user";
    $user = query($query);

    if (empty($user)) {
        echo "<script>
                alert('Data user tidak ditemukan!');
                window.location.href = 'user.php'; // Redirect ke halaman user.php
              </script>";
        exit;
    }
    $user = $user[0]; // Ambil data user pertama
}

// Proses Update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Password kosongkan jika tidak ingin mengubah
    $tipe = $_POST['tipe'];

    // Panggil fungsi untuk memperbarui data user
    $result = updateUser($id_user, $nama, $email, $password, $tipe);

    if ($result) {
        echo "<script>
                alert('Data user berhasil diperbarui!');
                window.location.href = 'user.php'; // Redirect ke halaman user.php
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data user!');
              </script>";
    }
}
?>

<div class="main-panel m-5">
    <h2>Edit User</h2>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
        </div>
        <div class="form-group">
            <label for="tipe">Tipe:</label>
            <select class="form-control" id="tipe" name="tipe" required>
                <option value="admin" <?= $user['tipe'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="pelanggan" <?= $user['tipe'] == 'pelanggan' ? 'selected' : ''; ?>>Pelanggan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui User</button>
    </form>
</div>

<?php
include_once('templates/footer.php');
?>