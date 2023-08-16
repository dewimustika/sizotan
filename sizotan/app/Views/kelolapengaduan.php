<?= $this->extend('layout/template_backend'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Pengaduan
            </div>
            <!-- Tambahkan form filter -->
            <div class="panel-body">
                <form action="<?= base_url('Pages/kelolapengaduan'); ?>" method="get">
                    <div class="form-group">
                        <label for="status">Filter Status Konfirmasi:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Semua</option>
                            <option value="Sudah Dikonfirmasi" <?= ($statusFilter === 'Sudah Dikonfirmasi') ? 'selected' : ''; ?>>Sudah Dikonfirmasi</option>
                            <option value="Belum Dikonfirmasi" <?= ($statusFilter === 'Belum Dikonfirmasi') ? 'selected' : ''; ?>>Belum Dikonfirmasi</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <!-- /.panel-body -->
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Nomor Telpon</th>
                                <th>Jenis Pengaduan</th>
                                <th>Waktu kejadian</th>
                                <th>Lokasi Kejadian</th>
                                <th>Foto</th>
                                <th>Deskripsi</th>
                                <th>Status Konfirmasi</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pengaduan as $row) {
                                // Tambahkan kondisi untuk mengecek status pengaduan
                                if ($statusFilter === '' || $row['status'] === $statusFilter) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['no_telp']; ?></td>
                                        <td><?= $row['jenis_pengaduan']; ?></td>
                                        <td><?= $row['waktu_kejadian']; ?></td>
                                        <td><?= $row['lokasi_kejadian']; ?></td>
                                        <td>
                                            <?php if (!empty($row['foto'])) : ?>
                                                <img src="<?= base_url('uploads/' . $row['foto']); ?>" alt="Foto" width="100">
                                            <?php else : ?>
                                                (Tidak ada foto)
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $row['deskripsi_pengaduan']; ?></td>
                                        <td><?= $row['status']; ?></td>
                                        <td>
                                            <a href="https://wa.me/<?= $row['no_telp']; ?>" class="btn btn-success">Konfirmasi Laporan</a>
                                            <a href="#" onclick="confirmUpdate('<?= site_url('Pages/konfirmasipengaduan/' . $row['id']) ?>')" class="btn btn-primary">Rubah Status</a>
                                            <a href="#" onclick="confirmDelete('<?= site_url('Pages/hapuspengaduan/' . $row['id']) ?>')" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                        <td></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
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

    function confirmUpdate(url) {
        Swal.fire({
            title: "Apakah Anda yakin untuk merubah status?",
            text: "Data yang diupdate tidak dapat dikembalikan.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0000FF",
            confirmButtonText: "Ya, Rubah Status!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

<?= $this->endSection(); ?>