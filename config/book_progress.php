<?php
if (isset($_POST['update_progress']) && isset($_POST['book_id']) && isset($_POST['last_page'])) {
    $user_id = $_SESSION['user_id'];  // ID pengguna yang sedang login
    $book_id = $_POST['book_id'];     // ID buku yang sedang dibaca
    $last_page = $_POST['last_page']; // Halaman terakhir yang dibaca

    // Mengambil jumlah total halaman dari buku
    $sql = "SELECT total_pages FROM book_list WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $total_pages = 0;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_pages = $row['total_pages'];
    }
    $stmt->close();

    if ($total_pages > 0) {
        // Mengambil data progres terakhir (halaman terakhir yang dibaca)
        $sql = "SELECT last_page, points FROM book_progress WHERE user_id = ? AND book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $book_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $last_page_stored = 0; // Halaman terakhir yang tercatat di database
        $points_stored = 0; // Poin yang sudah disimpan

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $last_page_stored = $row['last_page'];
            $points_stored = $row['points']; // Ambil poin yang sudah ada
        }
        $stmt->close();

        // Cek apakah halaman terakhir yang dibaca lebih tinggi dari yang tercatat
        if ($last_page > $last_page_stored) {
            // Hitung halaman baru yang dibaca
            $pages_read = $last_page - $last_page_stored;

            // Hitung progres baru
            $progress = ($last_page / $total_pages) * 100;

            // Hitung poin (misalnya 1 poin per halaman baru yang dibaca)
            $points = $points_stored + $pages_read; // Poin baru dihitung dari poin yang sudah ada ditambah halaman yang baru dibaca

            // Update progres dan poin di database
            $update_sql = "
            INSERT INTO book_progress (user_id, book_id, last_page, progress, points)
            VALUES (?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE last_page = ?, progress = ?, points = ?";
            
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("iiiiddi", $user_id, $book_id, $last_page, $progress, $points, $last_page, $progress, $points);
            $update_stmt->execute();
            echo "Progres berhasil diperbarui: " . round($progress, 2) . "%, Poin: " . $points;
        } else {
            echo "Tidak ada halaman baru yang dibaca.";
        }
    } else {
        die("Jumlah halaman buku tidak ditemukan.");
    }
} else {
    die("Data tidak lengkap.");
}
?>
