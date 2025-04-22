
  function loadContent(page, el = null) {
    fetch(`${page}.php`)
      .then(response => response.text())
      .then(html => {
        document.getElementById('main-content').innerHTML = html;

        // Hapus class active dari semua tombol
        document.querySelectorAll('.nav-btn').forEach(btn => {
          btn.classList.remove('border-l-4', 'border-green-500', 'bg-green-100', 'font-semibold', 'text-green-700');
          btn.classList.add('text-gray-800', 'hover:font-semibold');
        });

        // Tambahkan class active ke tombol yang diklik
        if (el) {
          el.classList.add('border-l-4', 'border-green-500', 'bg-green-100', 'font-semibold', 'text-green-700');
          el.classList.remove('text-gray-800');
        }

        // Simpan ke sessionStorage supaya bisa dipakai ulang saat reload
        sessionStorage.setItem('currentPage', page);
      })
      .catch(error => {
        document.getElementById('main-content').innerHTML = '<p class="text-red-500">Gagal memuat konten.</p>';
      });
  }

  document.addEventListener('DOMContentLoaded', function () {
    // Ambil dari sessionStorage kalau ada
    const current = sessionStorage.getItem('currentPage') || 'account';
    const activeBtn = document.getElementById(`btn-${current}`);
    loadContent(current, activeBtn);
  });

