<?php
session_start();
include '../db.php';
$activePage = 'akun'; // 👈 ini untuk tandai halaman aktif
?>

<?php
  $current_page = basename($_SERVER['PHP_SELF']); // Ambil nama file saat ini
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
    <div class="flex max-w-7xl mx-auto mt-6 bg-white shadow-sm rounded-md overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-1/4 border-r p-6 bg-gray-50">
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
        <nav class="space-y-2 text-sm">
          <a href="profile.php"
             class="block px-3 py-2 rounded-l-lg
             <?= $current_page == 'profile.php' ? 'border-l-4 border-green-500 bg-green-100 font-semibold text-green-700' : 'text-gray-800 hover:font-semibold' ?>">
             Akun
          </a>
          <a href="wishlist.php"
             class="block px-3 py-2 rounded-l-lg
             <?= $current_page == 'wishlist.php' ? 'border-l-4 border-green-500 bg-green-100 font-semibold text-green-700' : 'text-gray-800 hover:font-semibold' ?>">
             Wishlist
          </a>
          <a href="transaksi.php"
             class="block px-3 py-2 rounded-l-lg
             <?= $current_page == 'transaksi.php' ? 'border-l-4 border-green-500 bg-green-100 font-semibold text-green-700' : 'text-gray-800 hover:font-semibold' ?>">
             Transaksi
          </a>
          <a href="grafik.php"
             class="block px-3 py-2 rounded-l-lg
             <?= $current_page == 'grafik.php' ? 'border-l-4 border-green-500 bg-green-100 font-semibold text-green-700' : 'text-gray-800 hover:font-semibold' ?>">
             Grafik Genre
          </a>
          <a href="../config/logout.php"
             class="block text-red-500 hover:font-bold px-3 py-2">
             Logout
          </a>
        </nav>

    </aside>

    <!-- Profile Content -->
    <main class="w-3/4 p-8">
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
    </main>
  </div>

</body>
</html>
