<?php
require_once('function.php');

// Cek jika ada ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id_kamar = $_GET['id'];

    // Panggil fungsi deleteKamar untuk menghapus data
    $result = deleteKamar($id_kamar);

    if ($result) {
        echo "<script>
                alert('Data kamar berhasil dihapus!');
                window.location.href = 'kamar.php'; // Redirect ke halaman kamar.php
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data kamar!');
              </script>";
    }
} else {
    // Jika ID tidak ada, redirect ke halaman kamar.php
    echo "<script>
            window.location.href = 'kamar.php'; 
          </script>";
}
