<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Daftar Pengaduan</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pengadu</th>
                        <th scope="col">No. Telpon</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pengaduan as $p) : ?>
                        <tr>
                            <th scope="row">1</th>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['no_telp']; ?></td>
                            <td><a href="" class="btn btn-success">Detail</a> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>