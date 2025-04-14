<?php
session_start();
include 'db.php';
$query = "SELECT * FROM book_list";
$result = mysqli_query($conn, $query);
?>

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
   <?php include 'library/header.php'; ?>
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
          <a href="detail.php?id=<?php echo $bookId; ?>" class="block">
            <div class="w-48 h-80 flex-shrink-0 bg-slate-300 rounded-lg shadow p-3 mr-4 hover:shadow-lg transition">
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
 
  <!-- LINK FOOTER -->
  <?php include 'library/footer.php'; ?>
  <!-- LINK FOOTER -->

  <!--Link ke file JS -->
  <script src="src/main.js"></script>
</body>
</html>
