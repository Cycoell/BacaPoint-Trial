<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- HEADER SECTION -->
<section class="bg-white border-b border-gray-200 shadow-md sticky top-0 z-50">
  <div class="container mx-auto px-4 py-4 backdrop-blur-md bg-white/80">

    <!-- Baris 1: Logo, Search, Auth -->
    <div class="flex flex-col lg:flex-row items-center justify-between relative gap-4">

      <div class="w-16 h-16"></div>

      <!-- Logo -->
      <div class="w-[140px] h-[140px] -top-8 left-8 absolute">
        <a href="<?php echo isset($_SESSION['user']) ? '/BacaPoint-Trial/dashboard.php' : 'index.php'; ?>" 
           class="transition-transform duration-300 hover:scale-110">
          <img src="/BacaPoint-Trial/assets/logo_samping.png" alt="BacaPoint" class="bg-contain w-full h-full object-contain" />
        </a>
      </div>

      <!-- Dropdown + Search -->
      <div class="flex flex-1 max-w-2xl w-full items-center gap-3 mt-4 lg:mt-0">
        <select class="border border-gray-300 rounded-md px-3 py-2 text-sm w-1/4 focus:ring-2 focus:ring-green-500 focus:outline-none">
          <option>Kategori</option>
        </select>
        <input
          type="text"
          placeholder="Cari judul buku, atau penulis"
          class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500"
        />
      </div>

      <!-- Auth Buttons -->
      <div class="space-x-2 mt-4 lg:mt-0">
        <?php if (!isset($_SESSION['user'])): ?>
          <a href="pages/login.php" class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition-all duration-300">
            Masuk
          </a>
        <?php else: ?>
          <a href="/BacaPoint-Trial/pages/profile.php" class="flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 ring-1 ring-inset ring-green-600 rounded-full hover:bg-green-200 transition-all duration-300">
            <img src="/BacaPoint-Trial/assets/icon_person.png" class="w-6 h-6 rounded-full object-cover" />
            <span class="text-sm"><?php echo $_SESSION['user']['name']; ?></span>
          </a>
        <?php endif; ?>
      </div>

    </div>

    <!-- Baris 2: Nav Links dengan gradasi background -->
    <nav class="flex justify-center flex-wrap gap-4 mt-4 text-sm text-gray-500 bg-gradient-to-r from-green-50 via-white to-green-50 rounded-lg py-2 shadow-inner">
      <?php
        $navLinks = ["Omniscient Reader", "Solo Leveling", "Eleceed", "Sweet Home", "The Beginning After The End"];
        foreach ($navLinks as $link) {
          echo '<a href="pages/develop.php" class="relative group hover:text-green-600 transition-all duration-300">' . $link . '
                  <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-500 group-hover:w-full transition-all duration-300"></span>
                </a>';
        }
      ?>
    </nav>

  </div>
</section>
<!-- HEADER SECTION -->
