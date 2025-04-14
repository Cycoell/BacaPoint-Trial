<?php
$fileName = isset($_GET['file']) ? $_GET['file'] : 'default.pdf';
$filePath = "assets/" . $fileName;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BacaPoint</title>
  
  <!--Link Icon  -->
  <?php include '../library/icon.php'; ?>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-300 font-sans">

  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-white px-4 py-2 flex justify-between items-center shadow">
      <div class="flex items-center space-x-2">
        <button onclick="window.history.back()" class="text-xl font-bold">&larr;</button>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
        </svg>
      </div>
      <div class="text-center text-sm text-gray-500">(Judul Buku)</div>
      <div class="flex items-center space-x-2">
        <div class="flex items-center border rounded px-2 py-1">
          <button onclick="zoomOut()">−</button>
          <span id="zoomLevel" class="px-2">100%</span>
          <button onclick="zoomIn()">+</button>
        </div>
        <div class="w-8 h-8 rounded-full border-2 border-green-500 flex items-center justify-center">
          <span>&#128100;</span>
        </div>
      </div>
    </header>

    <!-- PDF Viewer -->
    <main class="flex-grow bg-gray-200 overflow-auto flex justify-center items-center">
      <canvas id="pdfCanvas" class="bg-white shadow-lg"></canvas>
    </main>

    <!-- Footer -->
    <footer class="bg-white p-4 flex justify-center items-center space-x-4">
      <button id="prevPage" class="bg-green-500 text-white px-4 py-2 rounded">Sebelumnya</button>
      <span id="pageInfo" class="text-gray-700">Page 1 of 1</span>
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
      updateZoomDisplay();
    }

    function zoomOut() {
      scale = Math.max(0.5, scale - 0.1);
      renderPage(pageNum);
      updateZoomDisplay();
    }

    function updateZoomDisplay() {
      document.getElementById("zoomLevel").textContent = Math.round(scale * 100) + "%";
    }

    // Load PDF
    const fileName = "<?php echo $filePath; ?>";
    fetch(fileName)
      .then(response => {
        if (!response.ok) throw new Error("File tidak ditemukan");
        return response.arrayBuffer();
      })
      .then(data => {
        const typedarray = new Uint8Array(data);
        pdfjsLib.getDocument(typedarray).promise.then(pdf => {
          pdfDoc = pdf;
          renderPage(pageNum);
        });
      })
      .catch(error => {
        console.error("Terjadi kesalahan:", error);
      });
  </script>
</body>
</html>
''