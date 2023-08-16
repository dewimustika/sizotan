<?= $this->extend('layout/template_backend'); ?>
<?= $this->section('content'); ?>

<!-- Bagian Form -->
<div class="col-lg-5">
    <div class="panel panel-default">
        <div class="panel-heading">
            Tambah Data
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <form action="<?php echo base_url('Pemetaan/simpan'); ?>" method="post" class="">
                <div class="form-group">
                    <label>Nama Daerah</label>
                    <input class="form-control" name="nama" required>
                </div>
                <div class="form-group">
                    <label>Latitude</label>
                    <input class="form-control" name="latitude" id="latitude" required>
                </div>
                <div class="form-group">
                    <label>Longitude</label>
                    <input class="form-control" name="longitude" id="longitude" required>
                </div>
                <div class="form-group">
                    <label>Radius</label>
                    <input class="form-control" name="radius" required>
                </div>
                <div class="form-group">
                    <label>Jam Mulai Rawan</label>
                    <input class="form-control timepicker" name="jammulai" required>
                </div>
                <div class="form-group">
                    <label>Jam Selesai Rawan</label>
                    <input class="form-control timepicker" name="jamselesai" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kejahatan</label>
                    <select class="form-control" name="jeniskejahatan" id="jenisKejahatan">
                        <option value="Pembegalan">Pembegalan</option>
                        <option value="Pencopetan">Pencopetan</option>
                        <option value="Pencurian">Pencurian</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group" id="jenisKejahatanLainnya" style="display: none;">
                    <label>Jenis Kejahatan Lainnya</label>
                    <input class="form-control" name="jeniskejahatanLainnya">
                </div>

                <div class="form-group">
                    <label>Antisipasi</label>
                    <textarea class="form-control" rows="3" name="antisipasi"></textarea>
                </div>
                <button type="submit" class="btn btn-primary col-md-3">Simpan</button>
            </form>
        </div>
    </div>
</div>

<!-- Bagian GIS-->
<div class="col-lg-7">
    <div class="panel panel-default">
        <div class="panel-heading">
            Maps
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="map"></div>

            <script>
                // Inisialisasi peta
                var map = L.map('map').setView([-6.570741134441208, 107.75940279287664], 13);

                // Tambahkan tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                // Deklarasikan variabel untuk menyimpan nilai latitude dan longitude
                var latitudeInput = document.getElementById('latitude');
                var longitudeInput = document.getElementById('longitude');

                // Deklarasikan variabel global untuk menyimpan marker
                var marker;

                // Tambahkan event listener click pada peta
                map.on('click', function(e) {
                    // Hapus marker sebelumnya jika ada
                    if (marker) {
                        marker.removeFrom(map);
                    }

                    // Ambil koordinat latitude dan longitude dari event
                    var latitude = e.latlng.lat.toFixed(6);
                    var longitude = e.latlng.lng.toFixed(6);

                    // Isi nilai latitude dan longitude ke dalam form
                    latitudeInput.value = latitude;
                    longitudeInput.value = longitude;

                    // Tambahkan marker ke peta menggunakan koordinat yang diklik
                    marker = L.marker([latitude, longitude]).addTo(map);

                    // Tambahkan popup ke marker
                    marker.bindPopup("Koordinat: " + latitude + ", " + longitude).openPopup();
                });


                // Menggunakan data zona rawan untuk menampilkan marker di peta
                <?php foreach ($zonarawan as $row) : ?>
                    var nama = "<?= $row['nama']; ?>";
                    var latitude = <?= $row['latitude']; ?>;
                    var longitude = <?= $row['longitude']; ?>;
                    var jeniskejahatan = "<?= $row['jeniskejahatan']; ?>";
                    var jammulai = "<?= $row['jammulai']; ?>";
                    var jamselesai = "<?= $row['jamselesai']; ?>";
                    var antisipasi = "<?= $row['antisipasi']; ?>";

                    // Buat circle layer menggunakan koordinat zona rawan
                    var circle = L.circle([latitude, longitude], {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.5,
                        radius: <?= $row['radius']; ?> // Ambil radius dari kolom 'radius' di tabel
                    }).addTo(map);

                    // Tambahkan tooltip ke circle layer
                    circle.bindTooltip(nama + "<br>Daerah Rawan " + jeniskejahatan + "<br> Jam rawan mulai " + jammulai + " - " + jamselesai + "<br> Antisipasi ketika melewati area ini adalah ").openTooltip();
                <?php endforeach; ?>
            </script>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Show/hide jenisKejahatanLainnya based on the selected option
        $('#jenisKejahatan').change(function() {
            if ($(this).val() === 'Lainnya') {
                $('#jenisKejahatanLainnya').show();
            } else {
                $('#jenisKejahatanLainnya').hide();
            }
        });

        $('.timepicker').timepicker({
            showMeridian: false,
            minuteStep: 1,
            defaultTime: false,
            showSeconds: true,
            showInputs: false,
            disableFocus: true
        });

        // Make the timepicker fields draggable
        $('.timepicker').draggable();
    })
</script>


<?= $this->endSection(); ?>