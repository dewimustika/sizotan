<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="rectangle">
    <center> Klik pada zona rawan untuk menampilkan deskripsi </center>
</div>
<div class="col py-3">
    <div id="map"></div>
    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-6.571706, 107.758756], 15);

        // Tambahkan tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Menggunakan data zona rawan untuk menampilkan marker di peta
        <?php foreach ($zonarawan as $row) : ?>
            var circleData = {
                nama: "<?= $row['nama']; ?>",
                jeniskejahatan: "<?= $row['jeniskejahatan']; ?>",
                jammulai: "<?= $row['jammulai']; ?>",
                jamselesai: "<?= $row['jamselesai']; ?>",
                antisipasi: "<?= $row['antisipasi']; ?>"
            };

            // Buat circle layer menggunakan koordinat zona rawan
            var circle = L.circle([<?= $row['latitude']; ?>, <?= $row['longitude']; ?>], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: <?= $row['radius']; ?>
            }).addTo(map);

            // Tambahkan tooltip ke circle layer
            circle.bindTooltip(circleData.nama).openTooltip();

            // Tambahkan event listener untuk mengubah deskripsi saat lingkaran diklik
            circle.on('click', (function(data) {
                return function() {
                    var rectangle = document.querySelector('.rectangle');
                    rectangle.innerHTML = data.nama + "<br>Daerah Rawan " + data.jeniskejahatan + "<br>Mulai pukul: " + data.jammulai + " - " + data.jamselesai + "<br> Antisipasi:  " + data.antisipasi;
                };
            })(circleData));
        <?php endforeach; ?>
    </script>
</div>
<?= $this->endSection(); ?>