<?php
require_once('function.php');
include_once('templates/header.php');

// Ambil data user
$query = "SELECT * FROM user";
$user = query($query);
?>

<div class="main-panel m-5">
    <h2>Daftar User</h2>
    <a href="tambah_user.php" class="btn btn-primary mb-3">Tambah User</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID User</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tipe</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user as $u) : ?>
                <tr>
                    <td><?= $u['id_user']; ?></td>
                    <td><?= $u['nama']; ?></td>
                    <td><?= $u['email']; ?></td>
                    <td><?= ucfirst($u['tipe']); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $u['id_user'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Yakin')" href="delete_user.php?id=<?= $u['id_user'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include_once('templates/footer.php');
?>