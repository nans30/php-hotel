<?php
include_once('templates/header.php');
require_once('function.php');

// Cek jika ada ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id_kamar = $_GET['id'];

    // Ambil data kamar berdasarkan ID
    $query = "SELECT * FROM kamar WHERE id_kamar = $id_kamar";
    $kamar = query($query);

    // Jika data kamar tidak ditemukan
    if (empty($kamar)) {
        echo "<script>
                alert('Data kamar tidak ditemukan!');
                window.location.href = 'kamar.php'; // Redirect ke halaman kamar.php
              </script>";
        exit;
    }
    $kamar = $kamar[0]; // Ambil data kamar pertama
}

// Proses Update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan id_kamar ada saat form disubmit
    if (isset($_POST['id_kamar'])) {
        $id_kamar = $_POST['id_kamar'];
    }

    $nama_kamar = $_POST['nama_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Panggil fungsi updateKamar untuk memperbarui data
    $result = updateKamar($id_kamar, $nama_kamar, $tipe_kamar, $harga, $deskripsi);

    if ($result) {
        echo "<script>
                alert('Data kamar berhasil diperbarui!');
                window.location.href = 'kamar.php'; // Redirect ke halaman kamar.php
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data kamar!');
              </script>";
    }
}

?>

<div class="main-panel m-5">
    <h2>Edit Kamar</h2>
    <!-- Form untuk mengedit data kamar -->
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="id_kamar" value="<?= $kamar['id_kamar']; ?>"> <!-- Add hidden field for id_kamar -->
        <div class="form-group">
            <label for="nama_kamar">Nama Kamar:</label>
            <input type="text" class="form-control" id="nama_kamar" name="nama_kamar" value="<?= $kamar['nama_kamar']; ?>" required>
        </div>
        <div class="form-group">
            <label for="tipe_kamar">Tipe Kamar:</label>
            <select class="form-control" id="tipe_kamar" name="tipe_kamar" required>
                <option value="single" <?= $kamar['tipe_kamar'] == 'single' ? 'selected' : ''; ?>>Single</option>
                <option value="double" <?= $kamar['tipe_kamar'] == 'double' ? 'selected' : ''; ?>>Double</option>
                <option value="suite" <?= $kamar['tipe_kamar'] == 'suite' ? 'selected' : ''; ?>>Suite</option>
            </select>
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?= $kamar['harga']; ?>" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= $kamar['deskripsi']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>

</div>

<?php
include_once('templates/footer.php');
?>