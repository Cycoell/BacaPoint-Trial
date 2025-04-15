<?php
include '/BacaPoint-Trial/db.php'; // Ubah sesuai path koneksi kamu

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $sql = "DELETE FROM books WHERE id='$id'";
  if (mysqli_query($conn, $sql)) {
    header("Location: profile.php"); // Redirect balik ke koleksi
    exit();
  } else {
    echo "Gagal menghapus: " . mysqli_error($conn);
  }
} else {
  echo "ID tidak ditemukan.";
}
?>
