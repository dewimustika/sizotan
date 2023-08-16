<?= $this->extend('layout/template_backend'); ?>

<?= $this->section('content'); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        Detail Zona Rawan
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <th>Nama Daerah</th>
                <td><?= $zona['nama']; ?></td>
            </tr>
            <tr>
                <th>Latitude</th>
                <td><?= $zona['latitude']; ?></td>
            </tr>
            <tr>
                <th>Longitude</th>
                <td><?= $zona['longitude']; ?></td>
            </tr>
            <tr>
                <th>Radius</th>
                <td><?= $zona['radius']; ?></td>
            </tr>
            <tr>
                <th>Jenis Kejahatan</th>
                <td><?= $zona['jeniskejahatan']; ?></td>
            </tr>
            <tr>
                <th>Jam Mulai Rawan</th>
                <td><?= $zona['jammulai']; ?></td>
            </tr>
            <tr>
                <th>Jam Selesai Rawan</th>
                <td><?= $zona['jamselesai']; ?></td>
            </tr>
            <tr>
                <th>Antisipasi</th>
                <td><?= $zona['antisipasi']; ?></td>
            </tr>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>