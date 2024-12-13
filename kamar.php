    <?php
    require_once('function.php');
    include_once('templates/header.php');

    $query = "SELECT * FROM kamar";
    $kamar = query($query);
    ?>

    <div class="main-panel m-5">
        <h2>Daftar Kamar</h2>

        <a href="tambah_kamar.php" class="btn btn-primary">Tambah Kamar</a>

        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID Kamar</th>
                    <th>Nama Kamar</th>
                    <th>Tipe Kamar</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kamar as $k) : ?>
                    <tr>
                        <td><?= $k['id_kamar']; ?></td>
                        <td><?= $k['nama_kamar']; ?></td>
                        <td><?= ucfirst($k['tipe_kamar']); ?></td>
                        <td>Rp <?= number_format($k['harga'], 2, ',', '.'); ?></td>
                        <td><?= $k['deskripsi']; ?></td>
                        <td><a href="edit_kamar.php?id=<?= $k['id_kamar'] ?>" class="btn btn-primary">Edit</a>
                            <a onclick="return confirm('Yakin ?')" href="delete_kamar.php?id=<?= $k['id_kamar'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php
    include_once('templates/footer.php');
    ?>