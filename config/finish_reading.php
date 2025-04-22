    <?php
    session_start();
    include '../db.php';

    if (!isset($_SESSION['user']['id'])) {
        die("Belum login. Session user_id tidak ditemukan.");
      }
      
      $user_id = $_SESSION['user']['id'];

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = intval($_POST['user_id']);
        $bookId = intval($_POST['book_id']);

        // Cek apakah user sudah menyelesaikan buku ini
        $check = $conn->prepare("SELECT * FROM reading_history WHERE user_id = ? AND book_id = ? AND point_given = 1");
        $check->bind_param("ii", $userId, $bookId);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(["success" => false, "message" => "Kamu sudah menyelesaikan dan dapat poin."]);
            exit;
        }

        // Masukkan atau update data bacaan
        $stmt = $conn->prepare("
            INSERT INTO reading_history (user_id, book_id, completed_at, point_given) 
            VALUES (?, ?, NOW(), 1) 
            ON DUPLICATE KEY UPDATE completed_at = NOW(), point_given = 1
        ");
        $stmt->bind_param("ii", $userId, $bookId);
        $stmt->execute();

        // Tambahkan poin
        $updatePoints = $conn->prepare("UPDATE users SET poin = poin + 10 WHERE id = ?");
        $updatePoints->bind_param("i", $userId);
        $updatePoints->execute();

        echo json_encode(["success" => true, "message" => "Terima kasih! Kamu mendapatkan 10 poin!"]);
    }
    ?>
