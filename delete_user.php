<?php
require_once('function.php');

// Cek jika ada ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Panggil fungsi untuk menghapus user
    $result = deleteUser($id_user);

    if ($result) {
        echo "<script>
                alert('Data user berhasil dihapus!');
                window.location.href = 'user.php'; // Redirect ke halaman user.php
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus user!');
              </script>";
    }
}
