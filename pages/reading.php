<?php
session_start();
include '../db.php'; // Pastikan path ini benar sesuai dengan lokasi db.php

// Ambil ID buku dari query string
$bookId = isset($_GET['id']) ? $_GET['id'] : 0;

// Pastikan ID valid
if ($bookId > 0) {
    // Query untuk mengambil path PDF berdasarkan ID menggunakan prepared statement
    $sql = "SELECT pdf_path FROM book_list WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param("i", $bookId); // Bind parameter untuk ID
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Menambahkan path lengkap untuk mengakses file PDF
        $filePath = "/bacapoint-trial/" . $row['pdf_path'];
    } else {
        $filePath = '/bacapoint-trial/assets/buku/default.pdf'; // Jika tidak ditemukan, beri file default
    }
    $stmt->close();
} else {
    $filePath = '/bacapoint-trial/assets/buku/default.pdf'; // Jika ID tidak valid, beri file default
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BacaPoint</title>
  
  <!--Link Icon  -->
  <?php include '../library/icon.php'; ?>

  <!-- Link ke file CSS -->
  <link href="../css/styles.css" rel="stylesheet"> 

  <!-- Link PDF.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

</head>
<body class="bg-gray-300 font-sans w-screen h-screen overflow-hidden">
  <div class="flex flex-col h-screen">
    <!-- Header -->
    <header class="bg-white px-4 py-2 flex justify-between items-center shadow">
      <div class="flex flex-1 items-center space-x-2">
        <button onclick="window.history.back()" class="text-xl font-bold">&larr;</button>
      </div>
      <div class="text-center text-sm text-gray-500">Baca Buku</div>
    </header>

    <!-- PDF Viewer -->
    <main id="pdfContainer" class="flex-grow bg-gray-200 overflow-auto flex justify-center items-center">
      <canvas id="pdfCanvas" class="bg-white shadow-lg"></canvas>
    </main>

    <!-- Footer -->
    <footer class="bg-white p-4 flex justify-center items-center space-x-4">
      <button id="prevPage" class="bg-green-500 text-white px-4 py-2 rounded">Sebelumnya</button>
      <button onclick="zoomOut()" class="bg-blue-500 text-white px-4 py-2 rounded">-</button>
      <span id="pageInfo" class="text-gray-700">Page 1 of 1</span>
      <button onclick="zoomIn()" class="bg-blue-500 text-white px-4 py-2 rounded">+</button>
      <button id="nextPage" class="bg-green-500 text-white px-4 py-2 rounded">Selanjutnya</button>
    </footer>
  </div>

  <script>
    let pdfDoc = null,
        pageNum = 1,
        scale = 1.5,
        pageRendering = false,
        canvas = document.getElementById("pdfCanvas"),
        ctx = canvas.getContext("2d");

    const renderPage = num => {
      pageRendering = true;
      pdfDoc.getPage(num).then(page => {
        const viewport = page.getViewport({ scale });
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        const renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };
        page.render(renderContext).promise.then(() => {
          pageRendering = false;
          document.getElementById("pageInfo").textContent = `Page ${pageNum} of ${pdfDoc.numPages}`;
        });
      });
    };

    const queueRenderPage = num => {
      if (pageRendering) return;
      renderPage(num);
    };

    document.getElementById("prevPage").addEventListener("click", () => {
      if (pageNum <= 1) return;
      pageNum--;
      queueRenderPage(pageNum);
    });

    document.getElementById("nextPage").addEventListener("click", () => {
      if (pageNum >= pdfDoc.numPages) return;
      pageNum++;
      queueRenderPage(pageNum);
    });

    function zoomIn() {
      scale += 0.1;
      renderPage(pageNum);
    }

    function zoomOut() {
      scale = Math.max(0.5, scale - 0.1);
      renderPage(pageNum);
    }

    function resizeCanvasToFitContainer() {
      if (!pdfDoc) return;
      const container = document.getElementById('pdfContainer');
      const containerWidth = container.clientWidth;
      const containerHeight = container.clientHeight;

      // Buat viewport sementara untuk hitung ukuran asli
      pdfDoc.getPage(pageNum).then(page => {
        const tempViewport = page.getViewport({ scale: 1.0 });
        const scaleX = containerWidth / tempViewport.width;
        const scaleY = containerHeight / tempViewport.height;

        scale = Math.min(scaleX, scaleY);
        renderPage(pageNum);
      });
    }

    window.addEventListener('resize', resizeCanvasToFitContainer);

    // Load PDF
    const filePath = "<?php echo $filePath; ?>";
    fetch(filePath)
      .then(response => {
        if (!response.ok) throw new Error("File tidak ditemukan");
        return response.arrayBuffer();
      })
      .then(data => {
        const typedarray = new Uint8Array(data);
        pdfjsLib.getDocument(typedarray).promise.then(pdf => {
          pdfDoc = pdf;
          renderPage(pageNum);
          setTimeout(resizeCanvasToFitContainer, 200); // wait for layout to settle
        });
      })
      .catch(error => {
        console.error("Terjadi kesalahan:", error);
      });
  </script>
</body>
</html>
