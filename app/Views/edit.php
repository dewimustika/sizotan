<?= $this->extend('layout/template_backend'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Data Zona Rawan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?= base_url('Pemetaan/edit/' . $zonarawan['id']) ?>" method="post">
                    <div class="form-group">
                        <label>Nama Daerah</label>
                        <input class="form-control" name="nama" value="<?= $zonarawan['nama'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kejahatan</label>
                        <input class="form-control" name="jeniskejahatan" value="<?= $zonarawan['jeniskejahatan'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai Rawan</label>
                        <input class="form-control" name="jammulai" value="<?= $zonarawan['jammulai'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai Rawan</label>
                        <input class="form-control" name="jamselesai" value="<?= $zonarawan['jamselesai'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Antisipasi</label>
                        <textarea class="form-control" rows="3" name="antisipasi"><?= $zonarawan['antisipasi'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>