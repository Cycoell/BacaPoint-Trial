
let pdfDoc = null,
    pageNum = 1,
    scale = 1,
    initialScale = 1,
    pageRendering = false,
    canvas = document.getElementById("pdfCanvas"),
    ctx = canvas.getContext("2d");



// Render satu halaman
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

// Queue render agar tidak konflik saat berpindah
const queueRenderPage = num => {
  if (pageRendering) {
    setTimeout(() => queueRenderPage(num), 100);
  } else {
    renderPage(num);
  }
};

// Tombol navigasi
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

// Zoom in/out/reset
function resetZoom() {
  scale = initialScale;
  resizeCanvasToFitScale();
}

function zoomIn() {
  scale += 0.05;
  scale = Math.min(scale, 3);
  resizeCanvasToFitScale();
}

function zoomOut() {
  scale -= 0.05;
  scale = Math.max(scale, 0.3);
  resizeCanvasToFitScale();
}

function resizeCanvasToFitScale() {
  if (!pdfDoc) return;

  pdfDoc.getPage(pageNum).then(page => {
    const viewport = page.getViewport({ scale });
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    const renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    page.render(renderContext);
    document.getElementById("zoomLevel").textContent = `${Math.round((scale / initialScale) * 100)}%`;
    document.getElementById("pageInfo").textContent = `Page ${pageNum} of ${pdfDoc.numPages}`;
  });
}

// Resize canvas ketika ukuran layar berubah
function resizeCanvasToFitContainer() {
  if (!pdfDoc) return;
  const container = document.getElementById('pdfContainer');
  const containerWidth = container.clientWidth;
  const containerHeight = container.clientHeight;

  pdfDoc.getPage(pageNum).then(page => {
    const tempViewport = page.getViewport({ scale: 1.0 });
    const scaleX = containerWidth / tempViewport.width;
    const scaleY = containerHeight / tempViewport.height;

    scale = Math.min(scaleX, scaleY);
    initialScale = scale;
    renderPage(pageNum);
  });
}

window.addEventListener('resize', resizeCanvasToFitContainer);

// Ambil file PDF
const filePath = document.getElementById("pdfContainer").dataset.filepath;

fetch(filePath)
  .then(response => {
    if (!response.ok) throw new Error("File tidak ditemukan");
    return response.arrayBuffer();
  })
  .then(data => {
    const typedarray = new Uint8Array(data);

    // Untuk versi 3.x → workerSrc langsung di getDocument
    pdfjsLib.getDocument({
      data: typedarray,
      workerSrc: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js'
    }).promise.then(pdf => {
      pdfDoc = pdf;
      setTimeout(() => {
        resizeCanvasToFitContainer();
      }, 300);
    });
  })
  .catch(error => {
    console.error("Terjadi kesalahan:", error);
    alert("File PDF tidak ditemukan.");
  });



// Tombol "Selesai Membaca"
document.getElementById("finishReading")?.addEventListener("click", function() {
  Swal.fire({
    title: 'Konfirmasi',
    text: "Apakah Anda yakin sudah menyelesaikan membaca buku ini?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Selesai!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const bookId = document.getElementById("bookId").value;
      const userId = document.getElementById("userId").value;

      fetch("../config/finish_reading.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `book_id=${bookId}&user_id=${userId}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          Swal.fire({
            title: 'Sukses!',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'OK',
            willClose: () => {
              const btn = document.getElementById("finishReading");
              if (btn) btn.remove();
              
              // Update poin di UI jika diperlukan
              const pointsElement = document.querySelector("[data-user-points]");
              if (pointsElement) {
                pointsElement.textContent = parseInt(pointsElement.textContent) + data.points;
              }
            }
          });
        } else {
          Swal.fire('Gagal', data.message, 'error');
        }
      })
      .catch(err => {
        console.error("Error:", err);
        Swal.fire('Error', 'Terjadi kesalahan saat memproses', 'error');
      });
    }
  });
});


