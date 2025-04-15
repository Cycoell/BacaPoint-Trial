<?php
include '../db.php';

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $sql = "DELETE FROM book_list WHERE id='$id'";
  if (mysqli_query($conn, $sql)) {
    echo "Buku berhasil dihapus";
  } else {
    echo "Gagal menghapus: " . mysqli_error($conn);
  }
} else {
  echo "ID tidak ditemukan.";
}
?>
