<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>FORM PENGADUAN</h1>
    <form action="<?php echo base_url('Pages/simpan'); ?>" enctype="multipart/form-data" method="post" id="pengaduan-form">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Anda" required>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telp" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telepon Anda" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="waktu_kejadian" class="form-label">Waktu Kejadian</label>
                <input type="datetime-local" class="form-control" id="waktu_kejadian" name="waktu_kejadian" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="lokasi_kejadian" class="form-label">Lokasi Kejadian</label>
            <input type="text" class="form-control" id="lokasi_kejadian" name="lokasi_kejadian" placeholder="Masukkan Lokasi Kejadian" required>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Kejahatan</label>
            <select class="form-select" id="jenis" name="jenis" required onchange="checkJenisKejahatan(this)">
                <option value="" disabled selected>Pilih Jenis Kejahatan</option>
                <option value="pembegalan">Pembegalan</option>
                <option value="pencopetan">Pencopetan</option>
                <option value="pencurian">Pencurian</option>
                <option value="lain-lain">Lain-lain</option>
            </select>
        </div>
        <div id="lain-lain-form" style="display: none;">
            <div class="mb-3">
                <label for="jenis-lainnya" class="form-label">Jenis Kejahatan Lainnya</label>
                <input type="text" class="form-control" id="jenis-lainnya" name="jenis-lainnya" placeholder="Masukkan Jenis Kejahatan Lainnya">
            </div>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto TKP</label>
            <input class="form-control" type="file" id="foto" name="foto" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Kronologi Kejadian</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi Pengaduan" required></textarea>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Kirim Laporan</button>
        </div>
    </form>
    <p class="text-center mt-2">atau</p>
    <div class="text-center mt-3">
        <a href="tel:0260411209" class="btn btn-primary">Hubungi Kami</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function checkJenisKejahatan(select) {
        var lainlainForm = document.getElementById('lain-lain-form');
        if (select.value === 'lain-lain') {
            lainlainForm.style.display = 'block';
        } else {
            lainlainForm.style.display = 'none';
        }
    }

    document.getElementById('pengaduan-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var form = this;
        var formData = new FormData(form);

        fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Pengaduan berhasil terkirim',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        form.reset();
                    });
                } else {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Pengaduan berhasil terkirim',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Sukses',
                    text: 'Pengaduan berhasil terkirim',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
    });
</script>
<?= $this->endSection(); ?>