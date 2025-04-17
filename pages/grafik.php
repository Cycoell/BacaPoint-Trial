<?php
include '../db.php'; // Sesuaikan dengan file koneksi kamu

// Query ambil data buku dari database
$sql = "SELECT * FROM book_list"; // Ganti 'book_list' dengan nama tabel bukumu jika berbeda
$result = mysqli_query($conn, $sql);

// Cek jika terjadi error query
if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!-- Auth Admin -->
<?php include '../config/auth_admin.php'; ?>


<!-- Judul Section -->
<div class="flex justify-between items-center px-6 py-4">
  <h1 class="text-2xl font-semibold">Grafik Genre</h1>
</div>