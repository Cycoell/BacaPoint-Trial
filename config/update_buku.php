<?php
include '/BacaPoint-Trial/db.php'; // Ubah sesuai path file koneksi kamu

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

  $sql = "UPDATE books SET judul='$judul', tahun='$tahun', author='$author', genre='$genre' WHERE id='$id'";

  if (mysqli_query($conn, $sql)) {
    header("Location: profile.php"); // Redirect balik ke halaman koleksi
    exit();
  } else {
    echo "Gagal mengupdate: " . mysqli_error($conn);
  }
}
?>
