<?php
require_once('function.php');
include_once('templates/header.php');

// Menangani form submission (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_kamar = $_POST['nama_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    
    // Panggil fungsi insertKamar untuk menyimpan data
    $result = insertKamar($nama_kamar, $tipe_kamar, $harga, $deskripsi);
    
    if ($result) {
        echo "<script>
                alert('Data kamar berhasil disimpan!');
                window.location.href = 'kamar.php'; // Redirect ke halaman kamar.php
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan data kamar!');
              </script>";
    }
}
?>

<div class="main-panel m-5">
    <h2>Tambah Kamar</h2>
    <!-- Form untuk memasukkan data kamar -->
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label for="nama_kamar">Nama Kamar:</label>
            <input type="text" class="form-control" id="nama_kamar" name="nama_kamar" required>
        </div>
        <div class="form-group">
            <label for="tipe_kamar">Tipe Kamar:</label>
            <select class="form-control" id="tipe_kamar" name="tipe_kamar" required>
                <option value="single">Single</option>
                <option value="double">Double</option>
                <option value="suite">Suite</option>
            </select>
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?php
include_once('templates/footer.php');
?>
