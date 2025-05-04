<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']['id'])) {
    die(json_encode(["success" => false, "message" => "Belum login"]));
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = intval($_POST['book_id']);
    $userIdFromSession = $_SESSION['user']['id']; // Ambil dari session langsung

    // Tidak perlu validasi user_id dari POST karena kita pakai session
    $conn->begin_transaction();

    try {
        // Cek apakah sudah pernah mendapatkan poin
        $check = $conn->prepare("SELECT point_given FROM reading_history WHERE user_id = ? AND book_id = ?");
        $check->bind_param("ii", $userIdFromSession, $bookId);
        $check->execute();
        $result = $check->get_result();
        
        if ($result->num_rows > 0 && $result->fetch_assoc()['point_given'] == 1) {
            throw new Exception("Buku ini sudah selesai dibaca");
        }

        // Update atau insert record
        if ($result->num_rows > 0) {
            $stmt = $conn->prepare("UPDATE reading_history SET completed_at = NOW(), point_given = 1 WHERE user_id = ? AND book_id = ?");
        } else {
            $stmt = $conn->prepare("INSERT INTO reading_history (user_id, book_id, completed_at, point_given) VALUES (?, ?, NOW(), 1)");
        }
        $stmt->bind_param("ii", $userIdFromSession, $bookId);
        $stmt->execute();

        // Tambahkan poin
        $update = $conn->prepare("UPDATE users SET poin = poin + 10 WHERE id = ?");
        $update->bind_param("i", $userIdFromSession);
        $update->execute();

        $conn->commit();
        
        echo json_encode([
            "success" => true, 
            "message" => "Poin berhasil ditambahkan",
            "points" => 10
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode([
            "success" => false, 
            "message" => $e->getMessage()
        ]);
    }
}
?>