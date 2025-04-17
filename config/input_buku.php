<?php
include '../db.php'; // koneksi database

// Ambil data dari form
$judul = $_POST['judul'];
$tahun = $_POST['tahun'];
$author = $_POST['author'];
$genre = $_POST['genre'];

// Ambil nama file dari path asli (file picker akan mengembalikan 'C:\fakepath\nama_file.ext')
$coverFileName = basename($_POST['cover_path']);
$pdfFileName   = basename($_POST['pdf_path']);

// Tambahkan prefix folder tujuan
$coverPath = "assets/buku/" . $coverFileName;
$pdfPath   = "assets/buku/" . $pdfFileName;

// Simpan ke database
$sql = "INSERT INTO book_list (judul, tahun, author, genre, cover_path, pdf_path) 
        VALUES ('$judul', '$tahun', '$author', '$genre', '$coverPath', '$pdfPath')";

if (mysqli_query($conn, $sql)) {
    header("Location: /bacapoint-trial/pages/profile.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
