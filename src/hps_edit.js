
// Fungsi edit buku
document.addEventListener("DOMContentLoaded", () => {
    window.enableEdit = function(id) {
      const form = document.getElementById('form-' + id);
      const inputs = form.querySelectorAll('input[type="text"]');
      const buttons = document.getElementById('buttons-' + id);
      const actions = document.getElementById('actions-' + id);

      inputs.forEach(input => {
        input.removeAttribute('readonly');
        input.classList.remove('bg-transparent');
        input.classList.add('bg-white');
      });

      buttons.classList.remove('hidden');
      actions.classList.add('hidden');
    }

    window.cancelEdit = function(id) {
      const form = document.getElementById('form-' + id);
      const inputs = form.querySelectorAll('input[type="text"]');
      const buttons = document.getElementById('buttons-' + id);
      const actions = document.getElementById('actions-' + id);

      inputs.forEach(input => {
        input.setAttribute('readonly', true);
        input.classList.remove('bg-white');
        input.classList.add('bg-transparent');
        input.value = input.getAttribute('data-original');
      });

      buttons.classList.add('hidden');
      actions.classList.remove('hidden');
    }
  });

//   Fungsi Hapus Buku
  function hapusBuku(id) {
    if (confirm("Apakah Anda yakin ingin menghapus buku ini dari library?")) {
      fetch(`../config/hapus_buku.php?id=${id}`)
        .then(response => response.text())
        .then(responseText => {
          alert(responseText);
          loadContent('collection'); // ini untuk reload konten collection-nya
        })
        .catch(error => {
          alert("Terjadi kesalahan saat menghapus.");
          console.error(error);
        });
    }
  }