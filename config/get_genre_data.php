<?php
include "../db.php"; // Sesuaikan dengan file koneksi kamu

// Ambil data genre dari database
$query = "SELECT genre, COUNT(*) AS jumlah FROM book_list GROUP BY genre";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>