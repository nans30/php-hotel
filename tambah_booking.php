<?php
session_start(); // Mulai session
require_once('function.php');
include_once('templates/header.php');

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location.href = 'login.php'; // Redirect ke halaman login
          </script>";
    exit;
}

// Ambil daftar kamar untuk dropdown
$query = "SELECT * FROM kamar";
$kamar = query($query);

// Proses booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_SESSION['id_user']; // Ambil id_user dari session
    $id_kamar = $_POST['id_kamar'];
    $tanggal_checkin = $_POST['tanggal_checkin'];
    $tanggal_checkout = $_POST['tanggal_checkout'];

    // Fungsi untuk memasukkan data booking
    $result = insertBooking($id_user, $id_kamar, $tanggal_checkin, $tanggal_checkout);

    if ($result) {
        echo "<script>
                alert('Booking berhasil!');
                window.location.href = 'booking.php'; // Redirect ke halaman booking
              </script>";
    } else {
        echo "<script>
                alert('Gagal melakukan booking!');
              </script>";
    }
}
?>

<div class="main-panel m-5">
    <h2>Tambah Booking</h2>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <!-- ID User disembunyikan, karena diambil dari session -->
        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">

        <div class="form-group">
            <label for="id_kamar">Pilih Kamar:</label>
            <select class="form-control" id="id_kamar" name="id_kamar" required>
                <option value="">Pilih Kamar</option>
                <?php foreach ($kamar as $k) : ?>
                    <option value="<?= $k['id_kamar']; ?>"><?= $k['nama_kamar']; ?> - Rp <?= number_format($k['harga'], 2, ',', '.'); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_checkin">Tanggal Check-In:</label>
            <input type="date" class="form-control" id="tanggal_checkin" name="tanggal_checkin" required>
        </div>
        <div class="form-group">
            <label for="tanggal_checkout">Tanggal Check-Out:</label>
            <input type="date" class="form-control" id="tanggal_checkout" name="tanggal_checkout" required>
        </div>
        <button type="submit" class="btn btn-primary">Booking</button>
    </form>
</div>

<?php
include_once('templates/footer.php');
?>