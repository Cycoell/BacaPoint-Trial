<?php
include '../db.php'; // Ubah sesuai path file koneksi kamu

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id     = $_POST['id'];
  $judul  = $_POST['judul'];
  $tahun  = $_POST['tahun'];
  $author = $_POST['author'];
  $genre  = $_POST['genre'];

  // Lindungi input dari SQL Injection
  $id     = mysqli_real_escape_string($conn, $id);
  $judul  = mysqli_real_escape_string($conn, $judul);
  $tahun  = mysqli_real_escape_string($conn, $tahun);
  $author = mysqli_real_escape_string($conn, $author);
  $genre  = mysqli_real_escape_string($conn, $genre);

  $sql = "UPDATE book_list SET judul='$judul', author='$author', tahun='$tahun', genre='$genre' WHERE id='$id'";

  if (mysqli_query($conn, $sql)) {
    header("Location: /bacapoint-trial/pages/profile.php"); // Redirect balik ke halaman koleksi
    exit();
  } else {
    echo "Gagal mengupdate: " . mysqli_error($conn);
  }
}
?>
