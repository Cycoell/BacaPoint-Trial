<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Auth Admin -->
<?php include '../config/auth_admin.php'; ?>

<!-- Judul Section -->
<div class="flex justify-between items-center px-6 py-4">
  <h1 class="text-2xl font-semibold">Grafik Genre</h1>
</div>

<!-- Chart Container -->
<div class="max-w-2xl mx-auto bg-gray-100 p-6 rounded shadow mb-10" style="border: 2px solid blue;">
  <h2 class="text-2xl font-semibold mb-4">Statistik Genre Buku</h2>
  <canvas id="genreChart" width="400" height="400"></canvas>
</div>

<!-- Link js Chart -->
<script src="../src/chart.js"></script>