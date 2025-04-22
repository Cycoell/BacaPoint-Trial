<?php
session_start();
include '../db.php'; // Pastikan path ini benar

if (!isset($_SESSION['user']['id'])) {
  die("Belum login. Session user_id tidak ditemukan.");
}

$user_id = $_SESSION['user']['id'];

$bookId = isset($_GET['id']) ? $_GET['id'] : 0;
$filePath = '/bacapoint-trial/assets/buku/default.pdf';
$judul = "Judul Tidak Ditemukan";

if ($bookId > 0) {
    $sql = "SELECT pdf_path, judul FROM book_list WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = "/bacapoint-trial/" . $row['pdf_path'];
        $judul = $row['judul'];
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BacaPoint</title>

  <!-- Link Icon -->
  <?php include '../library/icon.php'; ?>

  <!-- Link ke css -->
  <link href="../css/styles.css" rel="stylesheet"> 

</head>
<body class="bg-gray-300 font-sans w-screen h-screen overflow-hidden flex flex-col">
  <div class="flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-white px-4 py-2 flex justify-between items-center shadow relative">
      <div class="flex items-center space-x-2 flex-1">
       <button onclick="window.history.back()" class="text-3xl font-bold">&larr;</button>
      </div>

      <!-- Logo -->
      <div class="w-20 h-24 left-16 ml-10 absolute">
        <img src="../assets/logo_samping.png" alt="Logo" class="h-full w-full object-contain" />
      </div>

      <!-- Judul Buku dari Database -->
      <div class="text-center text-sm text-gray-500 items-center absolute top-4 left-1/2 transform -translate-x-1/2">
        <?php echo htmlspecialchars($judul); ?>
      </div>

      <!-- Zoom out & Zoom in -->
      <div class="flex items-center space-x-2 flex-1 justify-end">
        <div class="flex items-center border rounded px-2 py-1">
          <button onclick="zoomOut()">−</button>
          <span id="zoomLevel" class="px-2">100%</span>
          <button onclick="zoomIn()">+</button>
        </div>
      </div>

      <!-- Button reset zoom -->
      <div class="mx-4">
        <button onclick="resetZoom()">Reset Zoom</button>
      </div>
    </header>

    <!-- PDF Viewer -->
    <main id="pdfContainer" data-filepath="<?php echo $filePath; ?>" class="flex-grow bg-gray-200 overflow-auto flex justify-center items-center">
      <canvas id="pdfCanvas" class="bg-white shadow-lg"></canvas>
    </main>

    <!-- Footer -->
    <footer class="bg-white p-4 flex justify-center items-center space-x-4 relative">
      <button id="prevPage" class="bg-green-500 text-white px-4 py-2 rounded">Sebelumnya</button> 
      <span id="pageInfo" class="text-gray-700">Page 1 of 1</span>
      <button id="nextPage" class="bg-green-500 text-white px-4 py-2 rounded">Selanjutnya</button>

      <!-- Tombol Selesai Membaca -->
      <button id="finishReading" class="bottom-[10] right-5 bg-green-600 text-white px-6 py-3 rounded-full shadow-lg absolute  hover:bg-green-700 transition">
        Selesai Membaca
      </button>


    </footer>

  </div>

  <!-- Scrip ke pdf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
  


  <!-- link Scrip JS -->
  <script src="../src/read.js"></script>
  
</body>

<input type="hidden" id="bookId" value="<?php echo $bookId; ?>">
<input type="hidden" id="userId" value="<?php echo $userId; ?>">

</html>
