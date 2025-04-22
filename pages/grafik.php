<?php
// Koneksi ke database
include('../db.php');

// Query untuk menghitung jumlah buku per genre
$query = "SELECT genre, COUNT(*) AS total_buku FROM book_list GROUP BY genre";
$result = mysqli_query($conn, $query);

$genres = [];
$counts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $genres[] = $row['genre'];
    $counts[] = $row['total_buku'];
}

?>


<!-- Auth Admin -->
<?php include '../config/auth_admin.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- Judul Section -->
<div class="flex justify-between items-center px-6 py-4">
  <h1 class="text-2xl font-semibold">Grafik Genre</h1>
</div>


<!-- grafik.php -->
<div class="bg-white p-6 rounded shadow container mx-auto">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Statistik Buku Berdasarkan Genre</h2>
  <!-- Tempat grafik akan digambar -->
<div id="grafik-container">
    <canvas id="genreChart"></canvas>
</div>

</div>

<script>
  function loadContent(page) {
    fetch(`${page}.php`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('main-content').innerHTML = html;

            // Jalankan script untuk grafik setelah konten dimuat
            if (page === 'grafik') {
                loadChart();
            }
        })
        .catch(error => {
    console.error('Error:', error);
    document.getElementById('main-content').innerHTML = '<p class="text-red-500">Gagal memuat konten. Cek konsol untuk error lebih lanjut.</p>';
});

}

function loadChart() {
    var ctx = document.getElementById('genreChart').getContext('2d');
    var genreChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($genres); ?>,
            datasets: [{
                label: 'Jumlah Buku',
                data: <?php echo json_encode($counts); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


</script>

