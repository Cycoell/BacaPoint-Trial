<?php
session_start();
include '../db.php';
$activePage = 'akun'; // 👈 ini untuk tandai halaman aktif
?>

<!-- profile.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Bacapoint</title>
    
    <!--Link Icon  -->
    <?php include '../library/icon.php'; ?>
    <link href="../css/styles.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800">

<!--LINK HEADER  -->
<?php include '../library/header.php'; ?>
<!--LINK HEADER  -->

<!-- Main Content -->
    <!-- <div class="flex max-w-7xl mx-auto mt-6 bg-white shadow-sm rounded-md overflow-hidden"> -->
    <div class="flex max-w-7xl mx-auto mt-8 bg-white shadow rounded overflow-hidden min-h-[600px]">
    
    <!-- Sidebar Navigasi -->
    <aside class="w-1/4 bg-gray-50 p-6 border-r">
      <div class="mb-6">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M5.121 17.804A4.992 4.992 0 017 13h10a4.992 4.992 0 011.879 4.804M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </div>
          <div>
            <p class="font-semibold">Ujang Ronda</p>
            <p class="text-sm text-gray-500">ujangronda786@gmail.com</p>
          </div>
        </div>
        </div>
        <nav class="space-y-3 text-sm">
          <button onclick="loadContent('account', this)" id="btn-account"
            class="nav-btn">
            Akun
          </button>

          <button onclick="loadContent('develop', this)" id="btn-transaksi"
            class="nav-btn">
            Transaksi
          </button>

          <button onclick="loadContent('develop', this)" id="btn-wishlist"
            class="nav-btn">
            Wishlist
          </button>

          <button onclick="loadContent('develop', this)" id="btn-grafik"
            class="nav-btn">
            Grafik Genre
          </button>

          <button onclick="loadContent('collection', this)" id="btn-collection"
            class="nav-btn">
            Koleksi Buku
          </button>

          <a href="../config/logout.php"
            class="block text-red-500 hover:font-bold px-3 py-2">
            Logout
          </a>
        </nav>


    </aside>

    <!-- Konten Dinamis -->
    <main id="main-content" class="w-3/4 p-8">
      <!-- Konten akan dimuat di sini -->
    </main>
  </div>

  <script>
    // Fungsi untuk memuat konten berdasarkan nama file (tanpa .php)
    function loadContent(page) {
      fetch(`${page}.php`)  // ← Ganti di sini
        .then(response => response.text())
        .then(html => {
          document.getElementById('main-content').innerHTML = html;
        })
        .catch(error => {
          document.getElementById('main-content').innerHTML = '<p class="text-red-500">Gagal memuat konten.</p>';
        });
    }

    // Saat halaman pertama kali dibuka, langsung tampilkan "Profile"
    document.addEventListener('DOMContentLoaded', function () {
      loadContent('account');
    });
  </script>

<script src="../src/nav.js"></script>

</body>
</html>