<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grafik Genre Buku</title>
  <!-- Tailwind CDN (kalau kamu pakai Tailwind) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-white text-gray-900">

  <!-- Auth Admin -->
  <?php include '../config/auth_admin.php'; ?>

  <!-- Judul Section -->
  <div class="flex justify-between items-center px-6 py-4">
    <h1 class="text-2xl font-semibold">Grafik Genre 2</h1>
  </div>

  <!-- Chart Container -->
  <div class="max-w-2xl mx-auto bg-gray-100 p-6 rounded shadow mb-10" style="border: 2px solid blue;">
    <h2 class="text-2xl font-semibold mb-4">Statistik Genre Buku</h2>
    <canvas id="genreChart" width="400" height="400"></canvas>
  </div>

</body>
</html>

<!-- Link js Chart -->
<script src="../src/chart.js"></script>