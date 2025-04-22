<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- FOOTER SECTION -->
<section class="mt-6">
<footer class="bg-white text-gray-800 py-10 border-t">
  <div class="max-w-6xl mx-auto px-4">
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6 text-sm mb-10">

      <!-- Logo dan Slogan -->
      <div>
        <a href="<?php echo isset($_SESSION['user']) ? '/BacaPoint-Trial/dashboard.php' : 'index.php'; ?>">
        <img src="/BacaPoint-Trial/assets/logo_bawah.png" alt="Logo Bacapoint"
        class="w-20 mx-auto object-contain" />
        </a>
        <p class="text-gray-500">Pengetahuan dengan Imbalan</p>
      </div>

      <!-- Kolom 1 -->
      <div>
        <h3 class="font-semibold mb-2 text-gray-700">Weebly Themes</h3>
        <ul class="space-y-1 text-gray-500">
          <li><a href="/BacaPoint-trial/pages/develop.php" class="hover:underline">Submit a Ticket</a></li>
          <li><a href="/BacaPoint-trial/pages/develop.php" class="hover:underline">Pre-sale FAQs</a></li>
        </ul>
      </div>

      <!-- Kolom 2 -->
      <div>
        <h3 class="font-semibold mb-2 text-gray-700">Services</h3>
        <ul class="space-y-1 text-gray-500">
          <li><a href="/BacaPoint-trial/pages/develop.php" class="hover:underline">Theme Tweak</a></li>
        </ul>
      </div>

      <!-- Kolom 3 -->
      <div>
        <h3 class="font-semibold mb-2 text-gray-700">Showcase</h3>
        <ul class="space-y-1 text-gray-500">
          <li><a href="/BacaPoint-trial/pages/develop.php" class="hover:underline">Widgetkit</a></li>
          <li><a href="/BacaPoint-trial/pages/develop.php" class="hover:underline">Support</a></li>
        </ul>
      </div>

      <!-- Kolom 4 -->
      <div>
        <h3 class="font-semibold mb-2 text-gray-700">About Us</h3>
        <ul class="space-y-1 text-gray-500">
          <li><a href="/BacaPoint-trial/pages/develop.php" class="hover:underline">Contact Us</a></li>
          <li><a href="/BacaPoint-trial/pages/develop.php" class="hover:underline">Affiliates</a></li>
          <li><a href="/BacaPoint-trial/pages/develop.php" class="hover:underline">Resources</a></li>
        </ul>
      </div>
    </div>

    <!-- Garis -->
    <hr class="border-gray-300 mb-6">

    <!-- Ikon Sosial -->
    <div class="flex justify-center space-x-6 mb-4">
      <a href="/BacaPoint-trial/pages/develop.php"><img src="/BacaPoint-Trial/assets/facebook-square.png" alt="Facebook" class="w-5 h-5 hover:scale-110 transition" /></a>
      <a href="/BacaPoint-trial/pages/develop.php"><img src="/BacaPoint-Trial/assets/twitter.png" alt="Twitter" class="w-5 h-5 hover:scale-110 transition" /></a>
      <a href="/BacaPoint-trial/pages/develop.php"><img src="/BacaPoint-Trial/assets/instagram.png" alt="Instagram" class="w-6 h-6 hover:scale-110 transition" /></a>
      <a href="/BacaPoint-trial/pages/develop.php"><img src="/BacaPoint-Trial/assets/whatsapp.png" alt="WhatsApp" class="w-6 h-6 hover:scale-110 transition" /></a>
      </div>

    <!-- Copyright -->
    <p class="text-center text-gray-400 text-sm">©Copyright. All rights reserved.</p>
  </div>
</footer>
</section>
<!-- FOOTER SECTION -->