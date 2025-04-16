
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
let bukuIdToDelete = null;

function hapusBuku(id) {
  bukuIdToDelete = id;
  document.getElementById('confirmModal').classList.remove('hidden');
}

document.getElementById('confirmYes').addEventListener('click', () => {
  if (bukuIdToDelete !== null) {
    fetch(`../config/hapus_buku.php?id=${bukuIdToDelete}`)
      .then(response => response.text())
      .then(responseText => {
        alert(responseText);
        loadContent('collection'); // ini tetap dipakai untuk refresh
      })
      .catch(error => {
        alert("Terjadi kesalahan saat menghapus.");
        console.error(error);
      });
    document.getElementById('confirmModal').classList.add('hidden');
  }
});

document.getElementById('confirmNo').addEventListener('click', () => {
  bukuIdToDelete = null;
  document.getElementById('confirmModal').classList.add('hidden');
});


// Fungsi untuk menampilkan modal konfirmasi hapus
function showConfirmModal(callback) {
    const modal = document.getElementById("confirmModal");
    const yesBtn = document.getElementById("confirmYes");
    const noBtn = document.getElementById("confirmNo");
  
    modal.classList.remove("hidden");
    modal.classList.add("flex");
  
    yesBtn.onclick = () => {
      modal.classList.remove("flex");
      modal.classList.add("hidden");
      callback(true);
    };
  
    noBtn.onclick = () => {
      modal.classList.remove("flex");
      modal.classList.add("hidden");
      callback(false);
    };
  }
  