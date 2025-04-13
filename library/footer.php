<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- FOOTER SECTION -->
<section class="bg-white border-t py-6 mt-4">
    <div class="container mx-auto max-w-4xl px-2">
      <div class="text-center">
        <!-- Menu Footer -->
        <div class="flex justify-center gap-6 text-sm text-gray-700 mb-6">
          <a href="#" class="inline-block">Saran dan Pendapat</a>
          <a href="#" class="inline-block">Bantuan</a>
          <a href="#" class="inline-block">Syarat Penggunaan</a>
          <a href="#" class="inline-block">Privasi</a>
          <a href="#" class="inline-block">Info Iklan</a>
        </div>
        <!-- Logo -->
        <div class="flex justify-center">
          <a href="<?php echo isset($_SESSION['user']) ? '/BacaPoint-Trial/dashboard.php' : 'index.php'; ?>">
          <img src="/BacaPoint-Trial/assets/logo_bawah.png" alt="Logo" class="w-[80px] h-[80px] scale-125 object-cover" />
          </a>
        </div>
  
  
      </div>
    </div>
  </section>
  <!-- FOOTER SECTION -->