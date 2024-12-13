<?php
session_start(); // Mulai session
require_once('function.php');
require_once('koneksi.php');
include_once('templates/header.php');

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location.href = 'login.php'; // Redirect ke halaman login
          </script>";
    exit;
}

// Ambil data booking
$query = "SELECT b.id_booking, b.tanggal_checkin, b.tanggal_checkout, b.status, k.nama_kamar, u.nama 
          FROM booking b
          JOIN kamar k ON b.id_kamar = k.id_kamar
          JOIN user u ON b.id_user = u.id_user
          WHERE b.id_user = {$_SESSION['id_user']}";
$booking = query($query);

// Proses perubahan status booking
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id_booking = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'accept') {
        $status = 'confirmed';
    } elseif ($action == 'cancel') {
        $status = 'cancelled';
    }

    // Update status booking
    $updateQuery = "UPDATE booking SET status = '$status' WHERE id_booking = $id_booking";
    $updateResult = mysqli_query($koneksi, $updateQuery);

    if ($updateResult) {
        echo "<script>
                alert('Status booking berhasil diperbarui!');
                window.location.href = 'booking.php'; // Redirect ke halaman booking
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui status booking!');
              </script>";
    }
}
?>

<div class="main-panel m-5">
    <a href="tambah_booking.php" class="btn btn-primary">Tambah Booking</a>
    <h2>Daftar Booking</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Booking</th>
                <th>Nama Pengguna</th>
                <th>Nama Kamar</th>
                <th>Tanggal Check-In</th>
                <th>Tanggal Check-Out</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($booking as $b) : ?>
                <tr>
                    <td><?= $b['id_booking']; ?></td>
                    <td><?= $b['nama']; ?></td> <!-- Mengganti 'username' dengan 'nama' -->
                    <td><?= $b['nama_kamar']; ?></td>
                    <td><?= $b['tanggal_checkin']; ?></td>
                    <td><?= $b['tanggal_checkout']; ?></td>
                    <td><?= ucfirst($b['status']); ?></td>
                    <td>
                        <?php if ($b['status'] == 'pending') : ?>
                            <a href="booking.php?action=accept&id=<?= $b['id_booking']; ?>" class="btn btn-success">Accept Payment</a>
                            <a href="booking.php?action=cancel&id=<?= $b['id_booking']; ?>" class="btn btn-danger">Cancel</a>
                        <?php elseif ($b['status'] == 'confirmed') : ?>
                            <span class="btn btn-success disabled">Confirmed</span>
                        <?php elseif ($b['status'] == 'cancelled') : ?>
                            <span class="btn btn-danger disabled">Cancelled</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include_once('templates/footer.php');
?>