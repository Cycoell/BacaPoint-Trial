<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user'])) {
  die("Belum login. Session user_id tidak ditemukan."); // Tambahan debug
}

$user_id = $_SESSION['user_id'];

// Cek nilainya
echo "User ID dari session: $user_id<br>"; // Debug, nanti bisa dihapus

$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");

if (!$query) {
  die("Query error: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($query);

if (!$user) {
  die("User tidak ditemukan di database.");
}
?>


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
    <p><span class="text-sm text-gray-500 block">Nama Lengkap</span><?= htmlspecialchars($user['name']) ?></p>
    <p><span class="text-sm text-gray-500 block">Email</span><?= htmlspecialchars($user['email']) ?></p>
    <p><span class="text-sm text-gray-500 block">Kata Sandi</span><?= htmlspecialchars($user['password']) ?></p>
    <p><span class="text-sm text-gray-500 block">Jenis Kelamin</span><?= htmlspecialchars($user['jenis_kelamin']) ?></p>
    <p><span class="text-sm text-gray-500 block">Tanggal Lahir</span><?= htmlspecialchars($user['tanggal_lahir']) ?: '<a href="#" class="text-blue-600 text-sm underline">Pilih Tanggal Lahir</a>' ?></p>
    <p><span class="text-sm text-gray-500 block">Nomor Telepon</span><?= htmlspecialchars($user['nomor_telepon']) ?: '<a href="#" class="text-blue-600 text-sm underline">Masukkan Nomor Telepon</a>' ?></p>
  </div>
</div>
