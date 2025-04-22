<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user']['id'])) {
  die("Belum login. Session user_id tidak ditemukan.");
}

$user_id = $_SESSION['user']['id'];

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

<!-- Profil yang bisa dilihat -->
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
    <p>
      <span class="text-sm text-gray-500 block">Kata Sandi</span>
      <?= str_repeat('*', 10) ?> <!-- tampil 10 bintang -->
      <button onclick="togglePassDisplay(this)" class="ml-2 text-blue-500 text-sm underline">Lihat</button>
    </p>
    <p><span class="text-sm text-gray-500 block">Jenis Kelamin</span><?= htmlspecialchars($user['jenis_kelamin']) ?></p>
    <p><span class="text-sm text-gray-500 block">Tanggal Lahir</span><?= htmlspecialchars($user['tanggal_lahir']) ?: '<a href="#" class="text-blue-600 text-sm underline">Pilih Tanggal Lahir</a>' ?></p>
    <p><span class="text-sm text-gray-500 block">Nomor Telepon</span><?= htmlspecialchars($user['nomor_telepon']) ?: '<a href="#" class="text-blue-600 text-sm underline">Masukkan Nomor Telepon</a>' ?></p>
  </div>
</div>

<!-- Tombol Edit untuk Menampilkan Form -->
<button id="editButton" class="border px-4 py-1 rounded hover:bg-gray-100 text-sm">Edit Profil</button>


<form id="editForm" style="display:none;">
  <!-- Form untuk mengedit data pengguna -->
  <label>Nama Lengkap:</label>
  <input type="text" value="<?= htmlspecialchars($user['name']) ?>"><br>

  <label>Email:</label>
  <input type="email" value="<?= htmlspecialchars($user['email']) ?>"><br>

  <label>Jenis Kelamin:</label>
  <select>
    <option value="L" <?= $user['jenis_kelamin'] === 'L' ? 'selected' : '' ?>>Laki-laki</option>
    <option value="P" <?= $user['jenis_kelamin'] === 'P' ? 'selected' : '' ?>>Perempuan</option>
  </select><br>

  <label>Tanggal Lahir:</label>
  <input type="date" value="<?= htmlspecialchars($user['tanggal_lahir']) ?>"><br>

  <label>Nomor Telepon:</label>
  <input type="text" value="<?= htmlspecialchars($user['nomor_telepon']) ?>"><br>

  <button type="submit">Simpan Perubahan</button>
</form>


<?php
// Proses Update Profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
  $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
  $nomor_telepon = mysqli_real_escape_string($conn, $_POST['nomor_telepon']);

  $update_query = "UPDATE users SET 
    jenis_kelamin = '$jenis_kelamin', 
    tanggal_lahir = '$tanggal_lahir', 
    nomor_telepon = '$nomor_telepon'
    WHERE id = '$user_id'";

  if (mysqli_query($conn, $update_query)) {
    echo "<p class='text-green-500'>Profil berhasil diperbarui!</p>";
    // Segarkan halaman atau redirect ke halaman lain
    header("Location: account.php");
    exit;
  } else {
    echo "<p class='text-red-500'>Gagal memperbarui profil: " . mysqli_error($conn) . "</p>";
  }
}
?>

<script>
  function togglePassDisplay(btn) {
    const currentText = btn.previousSibling.textContent.trim();
    if (currentText.includes('*')) {
      btn.previousSibling.textContent = '************'; // kamu bisa ganti ini jadi teks dummy
      btn.textContent = 'Sembunyikan';
    } else {
      btn.previousSibling.textContent = '************';
      btn.textContent = 'Lihat';
    }
  }

  // Fungsi untuk menampilkan atau menyembunyikan form edit
  document.getElementById('editButton').addEventListener('click', function() {
    const editForm = document.getElementById('editForm');
    console.log(editForm.style.display); // Debugging untuk melihat nilai style display
    if (editForm.style.display === 'none' || editForm.style.display === '') {
      editForm.style.display = 'block';  // Menampilkan form
      this.textContent = 'Sembunyikan Form Edit';  // Mengubah teks tombol menjadi "Sembunyikan"
    } else {
      editForm.style.display = 'none';  // Menyembunyikan form
      this.textContent = 'Edit Profil';  // Mengubah teks tombol kembali menjadi "Edit Profil"
    }
  });
</script>

