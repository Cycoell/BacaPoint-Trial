let pdfDoc = null,
    pageNum = 1,
    scale = 1,
    initialScale = 1,
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
  if (pageRendering) {
    setTimeout(() => queueRenderPage(num), 100);
  } else {
    renderPage(num);
  }
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

// Ambil filePath dari elemen container
const filePath = document.getElementById("pdfContainer").dataset.filepath;

fetch(filePath)
  .then(response => {
    if (!response.ok) throw new Error("File tidak ditemukan");
    return response.arrayBuffer();
  })
  .then(data => {
    const typedarray = new Uint8Array(data);
    pdfjsLib.getDocument(typedarray).promise.then(pdf => {
      pdfDoc = pdf;
      setTimeout(() => {
        resizeCanvasToFitContainer();
      }, 300);
    });
  })
  .catch(error => {
    console.error("Terjadi kesalahan:", error);
  });
