<?php
// Pastikan koneksi database
include '../db.php';

// Cek apakah parameter ID dikirim
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Cek dulu apakah bukunya ada
    $check = mysqli_query($conn, "SELECT * FROM book_list WHERE id = $id");
    if (mysqli_num_rows($check) == 0) {
        echo "Buku tidak ditemukan.";
        exit;
    }

    // Eksekusi query hapus
    $query = "DELETE FROM book_list WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "Buku berhasil dihapus.";
    } else {
        echo "Gagal menghapus buku: " . mysqli_error($conn);
    }
} else {
    echo "ID buku tidak diberikan.";
}
?>
