<!-- PHP SESSION -->
 
<?php
// Mulai sesi
session_start();
include 'db.php';
$query = "SELECT * FROM book_list";
$result = mysqli_query($conn, $query);
// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: /pages/login.php");
    exit;
}

// Ambil data pengguna dari sesi
$user = $_SESSION['user'];
?>

<!-- END PHP SESSION -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BacaPoint</title>
    
    <!--Link Icon  -->
    <?php include 'library/icon.php'; ?>

    <!-- Link ke file CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Swiper library -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


</head>
<body class="bg-slate-300">

   <!--LINK HEADER  -->
   <?php include './library/header.php'; ?>
   <!--LINK HEADER  -->

<!-- GAMBAR BESAR SECTION -->
<section class="mt-10">
  <div class="container mx-auto max-w-4xl">
    <div class="swiper mySwiper w-full overflow-hidden rounded-xl shadow-lg">
      <div class="swiper-wrapper">

        <?php
        $slides = ["1.jpg", "2.jpg", "3.jpg", "4.jpg", "5.jpg"];
        foreach ($slides as $slide) {
          echo '
            <div class="swiper-slide px-0.5 group transition-transform duration-300 ease-in-out">
              <img src="assets/' . $slide . '" alt="Slide"
                class="w-full h-[400px] object-cover rounded-xl transform group-hover:scale-105 transition duration-300 shadow-md" />
            </div>';
        }
        ?>

      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
<!-- END GAMBAR BESAR SECTION -->

<!-- TAB PREMIUM DLL -->
<section class="mt-3">
  <div class="container mx-auto max-w-4xl px-4 py-4 bg-slate-100 rounded-lg flex items-center gap-6 min-h-16">

    <!-- Left: Fitur -->
    <div class="flex items-center flex-wrap gap-x-6 gap-y-3 text-sm text-gray-700 flex-1">

      <!-- BacaPoin -->
      <a href="#" class="flex items-center gap-2 bg-orange-100 text-orange-600 px-3 py-1 rounded-full">
        <img src="assets/icon_coin.png" alt="Coin" class="w-4 h-4 object-contain" />
        <span class="font-semibold">0</span>
        <span>BacaPoin</span>
      </a>

      <!-- Scan -->
      <a href="pages/develop.php" class="flex items-center gap-1 border-l pl-4 hover:text-green-600">
        <img src="assets/icon_scan.png" alt="Scan" class="w-4 h-4" />
        <span>Scan</span>
      </a>

      <!-- TopUp -->
      <a href="pages/develop.php" class="flex items-center gap-1 border-l pl-4 hover:text-green-600">
        <img src="assets/icon_topup.png" alt="TopUp" class="w-4 h-4" />
        <span>TopUp</span>
      </a>

      <!-- Riwayat -->
      <a href="pages/develop.php" class="flex items-center gap-1 border-l pl-4 hover:text-green-600">
        <img src="assets/icon_history.png" alt="Riwayat" class="w-4 h-4" />
        <span>Riwayat</span>
      </a>
    </div>

    <!-- Right: Premium -->
    <a href="pages/develop.php" class="border border-green-600 text-green-600 font-semibold text-sm px-4 py-1 rounded-full hover:bg-green-500 whitespace-nowrap">
      Jadi Member Premium
    </a>

  </div>
</section>
<!-- TAB PREMIUM DLL -->



<!-- BAR SECTION -->
<section class="mt-2">
    <div class="container mx-auto max-w-4xl px-5 py-6 bg-slate-100 rounded-lg">
      <div class="overflow-x-auto">
        <div class="flex gap-4 whitespace-nowrap justify-center">

        <?php
        $count = 0; // Mulai counter
        while (($row = mysqli_fetch_assoc($result)) && $count < 4) {
          $count++; // Tambah counter setiap loop
          $bookId = $row['id']; // Asumsikan kamu punya kolom id
        ?>
          <!-- Card dari database (klik ke detail buku) -->
          <a href="/BacaPoint-Trial/pages/reading.php?id=<?php echo $bookId; ?>" class="block">
            <div class="w-44 h-80 flex-none  bg-slate-300 rounded-lg shadow p-3 mr-4 hover:shadow-lg transition">
              <div class="h-48 w-full overflow-hidden rounded mb-2">
                <img src="<?php echo $row['cover_path']; ?>" alt="Cover" class="w-full h-full object-cover" />
              </div>
              <div class="text-wrap space-y-1">
                <h3 class="text-base font-semibold"><?php echo $row['judul']; ?></h3>
                <p class="text-xs text-gray-500">
                  <?php echo $row['tahun']; ?> • <?php echo $row['genre']; ?> • <?php echo $row['author']; ?>
                </p>
              </div>
            </div>
          </a>
        <?php } ?>

      </div>
    </div>
  </section>
  <!-- BAR SECTION -->

<!-- LIBRARY SECTION -->
 
<section class="mt-3">
  <div class="container mx-auto max-w-4xl bg-emerald-300 px-6 py-5 rounded-lg">
    
    <h2 class="text-xl font-bold text-gray-900 mb-4">Library</h2>

    <div class="flex gap-4 overflow-x-auto scrollbar-hide justify-center">
      <!-- Card 1 -->
      <div class="w-[170px] h-[290px] bg-neutral-100 rounded-lg overflow-hidden shadow-sm">
        <img src="assets/comic1.jpg" alt="The Guy Upstairs" class="w-full h-[230px] object-cover">
        <div class="p-2">
          <h3 class="font-bold text-sm">The Guy Upstairs</h3>
          <p class="text-xs text-gray-500">Ryu Ahnan</p>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="w-[170px] h-[290px] bg-neutral-100 rounded-lg overflow-hidden shadow-sm">
        <img src="assets/comic1.jpg" alt="The Guy Upstairs" class="w-full h-[230px] object-cover">
        <div class="p-2">
          <h3 class="font-bold text-sm">The Guy Upstairs</h3>
          <p class="text-xs text-gray-500">Ryu Ahnan</p>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="w-[170px] h-[290px] bg-neutral-100 rounded-lg overflow-hidden shadow-sm">
        <img src="assets/comic1.jpg" alt="The Guy Upstairs" class="w-full h-[230px] object-cover">
        <div class="p-2">
          <h3 class="font-bold text-sm">The Guy Upstairs</h3>
          <p class="text-xs text-gray-500">Ryu Ahnan</p>
        </div>
      </div>
      <!-- Card 4 -->
      <div class="w-[170px] h-[290px] bg-neutral-100 rounded-lg overflow-hidden shadow-sm">
        <img src="assets/comic1.jpg" alt="The Guy Upstairs" class="w-full h-[230px] object-cover">
        <div class="p-2">
          <h3 class="font-bold text-sm">The Guy Upstairs</h3>
          <p class="text-xs text-gray-500">Ryu Ahnan</p>
        </div>
      </div>
      <!-- Card 5 -->
      <div class="w-[170px] h-[290px] bg-neutral-100 rounded-lg overflow-hidden shadow-sm">
        <img src="assets/comic1.jpg" alt="The Guy Upstairs" class="w-full h-[230px] object-cover">
        <div class="p-2">
          <h3 class="font-bold text-sm">The Guy Upstairs</h3>
          <p class="text-xs text-gray-500">Ryu Ahnan</p>
        </div>
      </div>

    </div>  
    <div class="m-3"></div>
  </div>
</section>

<!-- END LIBRARY SECTION -->
 
<!-- LINK FOOTER -->
<?php include 'library/footer.php'; ?>
<!-- END LINK FOOTER -->

<!--Link ke file JS -->
  <script src="src/main.js"></script>
</body>
</html>