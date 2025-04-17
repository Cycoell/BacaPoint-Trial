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


<!-- Buku Section -->
<div class="flex justify-between items-center px-6 py-4">
  <h1 class="text-2xl font-semibold">Koleksi Buku</h1>
  <a href="input_buku.php" class="bg-gray-200 px-4 py-2 rounded">Input</a>
</div>

<!-- Card Buku -->
<div class="px-6 space-y-4 pb-10">
  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <form action="../config/update_buku.php" method="POST" class="flex bg-gray-100 p-4 rounded-md border border-blue-400 shadow items-center space-x-4" id="form-<?= $row['id'] ?>">
      <!-- Cover -->
      <div class="w-20 h-auto bg-gray-300 rounded-md overflow-hidden">
        <?php if (!empty($row['cover_path'])) { ?>
          <img src="../<?= htmlspecialchars($row['cover_path']) ?>" class="object-cover w-full h-full rounded-md">
        <?php } ?>
      </div>

      <!-- Detail -->
      <div class="flex-1 space-y-2 text-sm">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <div class="flex items-center gap-2">
          <label class="w-24 font-medium">Judul:</label>
          <input type="text" name="judul" value="<?= $row['judul'] ?>" class="flex-1 border rounded px-2 py-1 bg-transparent" readonly data-original="<?= htmlspecialchars($row['judul']) ?>">
        </div>
        <div class="flex items-center gap-2">
          <label class="w-24 font-medium">Tahun:</label>
          <input type="text" name="tahun" value="<?= $row['tahun'] ?>" class="flex-1 border rounded px-2 py-1 bg-transparent" readonly data-original="<?= htmlspecialchars($row['tahun']) ?>">
        </div>
        <div class="flex items-center gap-2">
          <label class="w-24 font-medium">Author:</label>
          <input type="text" name="author" value="<?= $row['author'] ?>" class="flex-1 border rounded px-2 py-1 bg-transparent" readonly data-original="<?= htmlspecialchars($row['author']) ?>">
        </div>
        <div class="flex items-center gap-2">
          <label class="w-24 font-medium">Genre:</label>
          <input type="text" name="genre" value="<?= $row['genre'] ?>" class="flex-1 border rounded px-2 py-1 bg-transparent" readonly data-original="<?= htmlspecialchars($row['genre']) ?>">
        </div>

        <!-- Tombol Simpan & Batal -->
        <div class="space-x-2 mt-2 hidden" id="buttons-<?= $row['id'] ?>">
          <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Simpan</button>
          <button type="button" onclick="cancelEdit(<?= $row['id'] ?>)" class="bg-gray-300 px-3 py-1 rounded">Batal</button>
        </div>
      </div>

      <!-- Tombol Aksi -->
      <div class="flex flex-col space-y-2" id="actions-<?= $row['id'] ?>">
        <button type="button" onclick="enableEdit(<?= $row['id'] ?>)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded">Edit</button>
        <button  type="button" onclick="hapusBuku(<?= $row['id'] ?>)" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded">Hapus</button>
      </div>
    </form>
  <?php } ?>
</div>

