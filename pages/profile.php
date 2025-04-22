<?php
session_start();
include '../db.php';
$isAdmin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
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

    <!-- Link CSS -->
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
          <p class="font-semibold"><?= htmlspecialchars($_SESSION['user']['name']) ?></p>
          <p class="text-sm text-gray-500"><?= htmlspecialchars($_SESSION['user']['email']) ?></p>

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

          <button onclick="loadContent('grafik', this)" id="btn-grafik"
            class="nav-btn">
            Grafik Genre
          </button>

          <?php if ($isAdmin): ?>
            <button onclick="loadContent('collection', this)" id="btn-collection" class="nav-btn">
                Koleksi Buku (Admin)
            </button>
          <?php endif; ?>

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

  <!-- Modal Konfirmasi -->
  <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
  <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
              bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
    <p class="mb-4 text-gray-700">Apakah Anda yakin ingin menghapus buku ini?</p>
    <div class="flex justify-center space-x-4">
      <button id="confirmYes" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Ya</button>
      <button id="confirmNo" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">Batal</button>
    </div>
  </div>
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
      // Ambil dari sessionStorage kalau ada
      const current = sessionStorage.getItem('currentPage') || 'account';
      
      // Ambil tombol aktif
      const activeBtn = document.getElementById(`btn-${current}`);
      
      if (activeBtn) {
        loadContent(current, activeBtn);
      } else {
        // Jika tidak ada tombol aktif, pastikan tombol akun yang pertama
        loadContent('account');
      }
    });
  </script>

  <!-- Link js hapus dan edit buku -->
  <script src="../src/hps_edit.js"></script>

  <!-- Link js navbar -->
  <script src="../src/profile.js"></script>

 

  <script>
  function tambahFormBuku() {
    const container = document.getElementById('formBaruContainer');
    const formId = 'formBaru-' + Date.now();

    const formHTML = `
    <form action="../config/input_buku.php" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded-md shadow-md border">

      <!-- Judul & Detail Lainnya -->
      <div class="flex items-center gap-2">
        <label class="w-24 font-medium">Judul:</label>
        <input type="text" name="judul" class="flex-1 border rounded px-2 py-1" required>
      </div>
      <div class="flex items-center gap-2">
        <label class="w-24 font-medium">Tahun:</label>
        <input type="text" name="tahun" class="flex-1 border rounded px-2 py-1" required>
      </div>
      <div class="flex items-center gap-2">
        <label class="w-24 font-medium">Author:</label>
        <input type="text" name="author" class="flex-1 border rounded px-2 py-1" required>
      </div>
      <div class="flex items-center gap-2">
        <label class="w-24 font-medium">Genre:</label>
        <input type="text" name="genre" class="flex-1 border rounded px-2 py-1" required>
      </div>

      <!-- Cover File Picker -->
      <div class="flex items-center gap-2">
        <label class="w-24 font-medium">Cover Path:</label>
        <input type="file" id="coverPicker" accept="image/*" class="hidden" onchange="updateCoverPath()" />
        <input type="text" id="coverPath" name="cover_path" class="flex-1 border rounded px-2 py-1 bg-gray-50" readonly required>
        <button type="button" onclick="document.getElementById('coverPicker').click()" class="bg-blue-500 text-white px-3 py-1 rounded">Pilih Cover</button>
      </div>

      <!-- PDF File Picker -->
      <div class="flex items-center gap-2 mt-2">
        <label class="w-24 font-medium">PDF Path:</label>
        <input type="file" id="pdfPicker" accept="application/pdf" class="hidden" onchange="updatePDFPath()" />
        <input type="text" id="pdfPath" name="pdf_path" class="flex-1 border rounded px-2 py-1 bg-gray-50" readonly required>
        <button type="button" onclick="document.getElementById('pdfPicker').click()" class="bg-blue-500 text-white px-3 py-1 rounded">Pilih PDF</button>
      </div>

      <!-- Tombol Submit -->
      <div class="text-right pt-4">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md shadow mr-3">
          Simpan Buku
        </button>
        <a href="profile.php" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md shadow">
          Batal
        </a>
      </div>
      </form>

    `;

    container.insertAdjacentHTML('beforeend', formHTML);
  }
  </script>

  <script>
  function updateFileName(inputId, labelId) {
    const input = document.getElementById(inputId);
    const label = document.getElementById(labelId);
    if (input.files.length > 0) {
      label.textContent = input.files[0].name;
    } else {
      label.textContent = "Belum dipilih";
    }
  }

  function updateCoverPath() {
    const file = document.getElementById('coverPicker').files[0];
    if (file) {
      document.getElementById('coverPath').value = file.name;
    }
  }

  function updatePDFPath() {
    const file = document.getElementById('pdfPicker').files[0];
    if (file) {
      document.getElementById('pdfPath').value = file.name;
    }
  }
  </script>

</body>
</html>