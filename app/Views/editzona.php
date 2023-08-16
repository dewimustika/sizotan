<?= $this->extend('layout/template_backend'); ?>
<?= $this->section('content'); ?>

<!-- Bagian Form -->
<div class="col-lg-5">
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Data
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <form action="<?= base_url('Pemetaan/editzona/' . $zonarawan['id']) ?>" method="post">
                <div class="form-group">
                    <label>Nama Daerah</label>
                    <input class="form-control" name="nama" value="<?= $zonarawan['nama'] ?>">
                </div>
                <div class="form-group">
                    <label>Latitude</label>
                    <input class="form-control" name="latitude" id="latitude" value="<?= $zonarawan['latitude'] ?>">
                </div>
                <div class="form-group">
                    <label>Longitude</label>
                    <input class="form-control" name="longitude" id="longitude" value="<?= $zonarawan['longitude'] ?>">
                </div>
                <div class="form-group">
                    <label>Radius</label>
                    <input class="form-control" name="radius" value="<?= $zonarawan['radius'] ?>">
                </div>
                <div class="form-group">
                    <label>Jam Mulai Rawan</label>
                    <input class="form-control timepicker" name="jammulai" value="<?= $zonarawan['jammulai'] ?>">
                </div>
                <div class="form-group">
                    <label>Jam Selesai Rawan</label>
                    <input class="form-control timepicker" name="jamselesai" value="<?= $zonarawan['jamselesai'] ?>">
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
                    <input class="form-control" name="jenisKejahatan">
                </div>

                <div class="form-group">
                    <label>Antisipasi</label>
                    <textarea class="form-control" rows="3" name="antisipasi"><?= $zonarawan['antisipasi'] ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary col-md-3">Update</button>
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
                var map = L.map('map').setView([<?= $zonarawan['latitude'] ?>, <?= $zonarawan['longitude'] ?>], 13);

                // Tambahkan tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                // Deklarasikan variabel untuk menyimpan nilai latitude dan longitude
                var latitudeInput = document.getElementById('latitude');
                var longitudeInput = document.getElementById('longitude');

                // Deklarasikan variabel global untuk menyimpan marker
                var marker;

                // Tambahkan event listener click.
                map.on('click', function(e) {
                    // Hapus marker jika sudah ada sebelumnya
                    if (marker) {
                        map.removeLayer(marker);
                    }

                    // Tambahkan marker baru
                    marker = L.marker(e.latlng).addTo(map);

                    // Update nilai latitude dan longitude pada input
                    latitudeInput.value = e.latlng.lat;
                    longitudeInput.value = e.latlng.lng;
                });

                // Tambahkan marker awal
                marker = L.marker([<?= $zonarawan['latitude'] ?>, <?= $zonarawan['longitude'] ?>]).addTo(map);

                // Tambahkan event listener dragend pada marker
                marker.on('dragend', function(e) {
                    // Update nilai latitude dan longitude pada input
                    latitudeInput.value = e.target.getLatLng().lat;
                    longitudeInput.value = e.target.getLatLng().lng;
                });
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