<?php
session_start();
require '../db.php';

// Periksa apakah user sudah login
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

// Gunakan user data dari session
$user = $_SESSION['user'];
$user_id = $user['id'];

// Debug (bisa dihapus setelah testing)
// echo "<pre>"; print_r($user); echo "</pre>";

// Ambil data terbaru dari database untuk memastikan data tidak stale
$query = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
mysqli_stmt_bind_param($query, "i", $user_id);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

$user_data = mysqli_fetch_assoc($result);

if (!$user_data) {
    die("User tidak ditemukan di database.");
}

// Tutup statement
mysqli_stmt_close($query);
?>

<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Pengaturan Akun</h2>
    
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Foto Profil -->
        <div class="flex flex-col items-center space-y-4 w-full md:w-1/4">
            <div class="relative w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                <?php if (!empty($user_data['foto_profil'])): ?>
                    <img src="../uploads/profiles/<?= htmlspecialchars($user_data['foto_profil']) ?>" 
                         alt="Foto Profil" class="w-full h-full object-cover">
                <?php else: ?>
                    <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                <?php endif; ?>
            </div>
            <form action="../config/upload_profile.php" method="post" enctype="multipart/form-data" class="text-center">
                <input type="file" name="profile_picture" id="profile_picture" class="hidden" accept="image/*">
                <label for="profile_picture" class="cursor-pointer border border-blue-500 text-blue-500 px-4 py-1 rounded-md hover:bg-blue-50 text-sm transition">
                    Ubah Foto
                </label>
                <button type="submit" class="block mt-2 text-xs text-gray-500 hover:text-gray-700">Simpan Perubahan</button>
            </form>
        </div>

        <!-- Data Profil -->
        <div class="w-full md:w-3/4 space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                    <div class="flex items-center">
                        <input type="text" value="<?= htmlspecialchars($user_data['name']) ?>" 
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" readonly>
                        <button onclick="enableEdit('name')" class="ml-2 text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                    <div class="flex items-center">
                        <input type="email" value="<?= htmlspecialchars($user_data['email']) ?>" 
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" readonly>
                        <button onclick="enableEdit('email')" class="ml-2 text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Password (disembunyikan) -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Password</label>
                    <div class="flex items-center">
                        <input type="password" value="********" 
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" readonly>
                        <button onclick="showChangePasswordModal()" class="ml-2 text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Jenis Kelamin</label>
                    <div class="flex items-center">
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" disabled>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" <?= $user_data['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $user_data['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <button onclick="enableEdit('jenis_kelamin')" class="ml-2 text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Tanggal Lahir -->
                <!-- <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Lahir</label>
                    <div class="flex items-center">
                        <input type="date" value="<?= htmlspecialchars($user_data['tanggal_lahir']) ?>" 
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" disabled>
                        <button onclick="enableEdit('tanggal_lahir')" class="ml-2 text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                    </div>
                </div> -->

                <!-- Nomor Telepon -->
                <!-- <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nomor Telepon</label>
                    <div class="flex items-center">
                        <input type="tel" value="<?= htmlspecialchars($user_data['nomor_telepon']) ?>" 
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" readonly>
                        <button onclick="enableEdit('nomor_telepon')" class="ml-2 text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Change Password -->
<div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <h3 class="text-xl font-bold mb-4">Ubah Password</h3>
        <form id="changePasswordForm" action="../config/change_password.php" method="post">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="current_password">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password">Password Baru</label>
                <input type="password" id="new_password" name="new_password" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">Konfirmasi Password Baru</label>
                <input type="password" id="confirm_password" name="confirm_password" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="document.getElementById('passwordModal').classList.add('hidden')" 
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">
                    Batal
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function enableEdit(field) {
    const input = document.querySelector(`input[name="${field}"], select[name="${field}"]`);
    if (input) {
        input.readOnly = !input.readOnly;
        input.disabled = !input.disabled;
        if (!input.readOnly) {
            input.focus();
            input.classList.remove('bg-gray-50');
            input.classList.add('bg-white');
        } else {
            input.classList.add('bg-gray-50');
            input.classList.remove('bg-white');
            // Kirim perubahan ke server jika diperlukan
            saveChanges(field, input.value);
        }
    }
}

function showChangePasswordModal() {
    document.getElementById('passwordModal').classList.remove('hidden');
}

function saveChanges(field, value) {
    // Implementasi AJAX untuk menyimpan perubahan
    fetch('../config/update_profile.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            field: field,
            value: value
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Perubahan berhasil disimpan');
        } else {
            alert('Gagal menyimpan perubahan: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan perubahan');
    });
}
</script>