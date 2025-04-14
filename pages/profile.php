<?php
session_start();
include '../db.php';
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
      <!-- <nav class="space-y-2 text-sm"> -->
        <button onclick="loadContent('account')" class="block w-full text-left text-gray-800 hover:font-semibold">Akun</button>
        <button onclick="loadContent('develop')" class="block w-full text-left text-gray-800 hover:font-semibold">Transaksi</button>
        <button onclick="loadContent('develop')" class="block w-full text-left text-gray-800 hover:font-semibold">Wishlist</button>
        <button onclick="loadContent('develop')" class="block w-full text-left text-gray-800 hover:font-semibold">Grafik Genre</button>
        <button onclick="loadContent('collection')" class="block w-full text-left text-gray-800 hover:font-semibold">Koleksi Buku</button>
        <a href="../config/logout.php" class="block text-red-500 hover:font-bold">Logout</a>
      </nav>
    </aside>

    <!-- Konten Dinamis -->
    <main id="main-content" class="w-3/4 p-8">
      <!-- Konten akan dimuat di sini -->
    </main>
  </div>

    <!-- Profile Content -->
    <!-- <main class="w-3/4 p-8">
      <h2 class="text-xl font-semibold mb-6">Akun</h2>
      <div class="flex items-start space-x-10">
        <div class="flex flex-col items-center space-y-3">
          <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M5.121 17.804A4.992 4.992 0 017 13h10a4.992 4.992 0 011.879 4.804M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </div>
          <button class="border px-4 py-1 rounded hover:bg-gray-100 text-sm">Ubah Foto Profil</button>
        </div>
        <div class="space-y-4">
          <h3 class="font-semibold text-lg">Pengaturan Profil</h3>
          <div>
            <p class="text-sm text-gray-500">Nama Lengkap</p>
            <p>Ujang Syahronda</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Email</p>
            <p>ujangronda786@gmail.com</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Kata Sandi</p>
            <p>●●●●●●●</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Jenis Kelamin</p>
            <p>Pria</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Tanggal Lahir</p>
            <a href="#" class="text-blue-600 text-sm underline">Pilih Tanggal Lahir</a>
          </div>
          <div>
            <p class="text-sm text-gray-500">Nomor Telepon</p>
            <a href="#" class="text-blue-600 text-sm underline">Masukkan Nomor Telepon</a>
          </div>
        </div>
      </div>
    </main> -->
  <!-- </div> -->

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

</body>
</html>