<?= $this->extend('layout/template_backend'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Zona Rawan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a href="/tambahzona" class="btn btn-success" style="margin-bottom:5px;">Tambah</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Daerah</th>
                                <th>Jenis Kejahatan</th>
                                <th>Jam Rawan</th>
                                <th>Antisipasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($zonarawan as $row) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['jeniskejahatan']; ?></td>
                                    <td><?= $row['jammulai']; ?> - <?= $row['jamselesai']; ?></td>
                                    <td><?= $row['antisipasi']; ?></td>
                                    <td>
                                        <a href="<?= site_url('/detailzona/' . $row['id']) ?>" class="btn btn-info btn-sm">Detail</a>
                                        <a href="<?= site_url('/editzona/' . $row['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" onclick="confirmDelete('<?= site_url('/Pemetaan/hapuszona/' . $row['id']) ?>')" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

<?= $this->endSection(); ?>