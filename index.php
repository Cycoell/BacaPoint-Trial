<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BacaPoint</title>
    
    <!-- Link ke file CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Swiper library -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


</head>
<body class="bg-slate-300">
    <!-- HEADER SECTION -->
    <section class="bg-white border-b border-gray-200 shadow-sm">
      <div class="container mx-auto px-4 py-4">

      <!-- Baris 1: Logo, Search, Auth -->
      <div class="flex flex-col lg:flex-row items-center justify-between gap-2 ">

      <!-- Logo -->
       
      <a href="/" class="ml-6 w-[120px] h-[80px] bg-no-repeat bg-[length:167px_190px] bg-center" style="background-image: url('assets/Logo_samping.png');">
        <span class="sr-only">BacaPoint</span>
      </a>
       

      <!-- Dropdown + Search -->
      <div class="flex flex-1 max-w-2xl w-full items-center gap-3">
        <select class="border rounded-md px-3 py-2 text-sm w-1/4">
          <option>Kategori</option>
        </select>
        <input
          type="text"
          placeholder="Cari judul buku, atau penulis"
          class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
        />
      </div>

      <!-- Auth Buttons -->
      <div class="space-x-2">
        <a href="register.php" class="px-4 py-1 border border-green-600 text-green-600 rounded hover:bg-green-50">Daftar</a>
        <a href="login.php" class="px-4 py-1 bg-green-600 text-white rounded hover:bg-green-700">Masuk</a>
      </div>
    </div>

    <!-- Baris 2: Nav Links -->
        <nav class="flex justify-center flex-wrap gap-3 mt-1 text-xs text-gray-400">
          <a href="#" class="hover:text-gray-600 transition">Omniscient Reader</a>
          <a href="#" class="hover:text-gray-600 transition">Solo Leveling</a>
          <a href="#" class="hover:text-gray-600 transition">Eleceed</a>
          <a href="#" class="hover:text-gray-600 transition">Sweet Home</a>
          <a href="#" class="hover:text-gray-600 transition">The Beginning After The End</a>
        </nav>

      </div>
    </section>
    <!-- HEADER SECTION -->

<!-- GAMBAR BESAR SECTION -->
<section class="mt-10">
  <div class="container mx-auto max-w-4xl">
  <div class="swiper mySwiper w-full overflow-hidden rounded-lg">
      <div class="swiper-wrapper">
        <div class="swiper-slide px-0.5">
          <img src="assets/1.jpg" alt="Slide 1" class="w-full h-[400px] object-cover rounded-lg"/>
          </div>
        <div class="swiper-slide px-0.5">
          <img src="assets/2.jpg" alt="Slide 2" class="w-full h-[400px] object-cover rounded-lg"/>
        </div>
        <div class="swiper-slide px-0.5">
          <img src="assets/3.jpg" alt="Slide 3" class="w-full h-[400px] object-cover rounded-lg"/>
        </div>
        <div class="swiper-slide px-0.5">
          <img src="assets/4.jpg" alt="Slide 4" class="w-full h-[400px] object-cover rounded-lg"/>
        </div>
        <div class="swiper-slide px-0.5">
          <img src="assets/5.jpg" alt="Slide 5" class="w-full h-[400px] object-cover rounded-lg"/>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
<!-- GAMBAR BESAR SECTION -->


<!-- BAR SECTION -->
<section class="mt-2">
  <div class="container mx-auto max-w-4xl px-5 py-6 bg-slate-100 rounded-lg">
    <div class="overflow-x-auto">
      <div class="flex gap-4 whitespace-nowrap justify-center">
        <!-- Card 1 -->
        <div class="w-48 h-80 flex-shrink-0 bg-slate-300 rounded-lg shadow p-3">
          <div class="h-48 w-full overflow-hidden rounded mb-2">
            <img src="assets/1.jpg" alt="Image" class="w-full h-full object-cover" />
          </div>
        <div class="space-y-1">
          <h3 class="text-base font-semibold">Judul Manga</h3>
          <p class="text-xs text-gray-500">2024 • Action • Author</p>
        </div>
      </div>
      
      <!-- Card 1 -->
      <div class="w-48 h-80 flex-shrink-0 bg-slate-300 rounded-lg shadow p-3">
          <div class="h-48 w-full overflow-hidden rounded mb-2">
            <img src="assets/1.jpg" alt="Image" class="w-full h-full object-cover" />
          </div>
        <div class="space-y-1">
          <h3 class="text-base font-semibold">Judul Manga</h3>
          <p class="text-xs text-gray-500">2024 • Action • Author</p>
        </div>
      </div>

      <!-- Card 1 -->
      <div class="w-48 h-80 flex-shrink-0 bg-slate-300 rounded-lg shadow p-3">
          <div class="h-48 w-full overflow-hidden rounded mb-2">
            <img src="assets/1.jpg" alt="Image" class="w-full h-full object-cover" />
          </div>
        <div class="space-y-1">
          <h3 class="text-base font-semibold">Judul Manga</h3>
          <p class="text-xs text-gray-500">2024 • Action • Author</p>
        </div>
      </div>

      <!-- Card 1 -->
      <div class="w-48 h-80 flex-shrink-0 bg-slate-300 rounded-lg shadow p-3">
          <div class="h-48 w-full overflow-hidden rounded mb-2">
            <img src="assets/1.jpg" alt="Image" class="w-full h-full object-cover" />
          </div>
        <div class="space-y-1">
          <h3 class="text-base font-semibold">Judul Manga</h3>
          <p class="text-xs text-gray-500">2024 • Action • Author</p>
        </div>
      </div>
 
    </div>
  </div>
</section>

<!-- BAR SECTION -->


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
        <img src="assets/Logo_bawah.png" alt="Logo" class="w-[80px] h-[80px] object-cover" />
      </div>


    </div>
  </div>
</section>

<!-- FOOTER SECTION -->


  <!--Link ke file JS -->
  <script src="src/main.js"></script>
</body>
</html>