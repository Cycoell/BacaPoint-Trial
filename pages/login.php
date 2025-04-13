<!-- PHP -->
<?php
session_start();
include '../db.php'; // Pastikan koneksi ke database sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Proses Sign Up
    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $confirm = $_POST['confirm'];

        if ($password === $confirm) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // Gunakan prepared statement untuk menghindari SQL injection
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed);
            if ($stmt->execute()) {
                // Redirect ke halaman login setelah registrasi berhasil
                header("Location: login.php");
                exit;
            } else {
                echo "<script>alert('Terjadi kesalahan saat mendaftar!');</script>";
            }
        } else {
            echo "<script>alert('Password tidak cocok!');</script>";
        }
    }

    // Proses Sign In
    if (isset($_POST['signin'])) {
        // Ambil data user berdasarkan email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: ../dashboard.php");
            exit;
        } else {
            echo "<script>alert('Email atau password salah');</script>";
        }
    }
}
?>
<!-- END PHP -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign In</title>

  <!-- Link ke file CSS -->
  <link href="../css/styles.css" rel="stylesheet">

</head>
<body class="min-h-screen flex items-center justify-center bg-green-100">

  <div id="container" class="relative w-[768px] h-[480px] bg-white rounded-[30px] overflow-hidden shadow-2xl transition-all duration-700">

    <!-- Sign Up Form -->

    <form method="POST" id="signUpForm" class="absolute top-0 right-0 w-1/2 h-full px-10 py-16 opacity-0 pointer-events-none z-10 transition-all duration-700">
      <h2 class="text-2xl font-bold text-green-600 mb-4">Sign Up</h2>
      <input type="text" name="name" placeholder="Name" class="w-full mb-3 p-2 border rounded" />
      <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border rounded" />
      <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border rounded" />
      <input type="password" name="confirm" placeholder="Confirm Password" class="w-full mb-3 p-2 border rounded" />
      <button class="mt-4 px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition" name="signup">Sign Up</button>
    </form>

    <!-- Sign In Form -->
    <form method="POST" id="signInForm" class="absolute top-0 left-0 w-1/2 h-full px-10 py-16 opacity-100 z-20 transition-all duration-700">
      <h2 class="text-2xl font-bold text-green-600 mb-4">Sign In</h2>
      <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border rounded" />
      <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border rounded" />

      <!-- Forgot Password Link -->
      <div class="text-right text-sm mb-3">
        <a href="#" class="text-green-500 hover:underline">Forgot Password?</a>
      </div>

      <button class="mt-4 px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition" name="signin">Sign In</button>

      <!-- Divider -->
      <div class="flex items-center my-4">
        <hr class="flex-grow border-gray-300" />
        <span class="mx-3 text-sm text-gray-500">or</span>
        <hr class="flex-grow border-gray-300" />
      </div>

      <!-- Sign in with Google -->
      <button class="w-full flex items-center justify-center border border-gray-300 rounded px-4 py-2 hover:bg-gray-100 transition">
        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="w-5 h-5 mr-2" />
        <span class="text-sm text-gray-700 font-medium">Sign in with Google</span>
      </button>
      
    </form>

    <!-- Overlay -->
    <div id="overlayContainer" class="absolute top-0 left-1/2 w-1/2 h-full z-30 transition-all duration-700 ease-in-out">
      <div id="overlay" class="w-full h-full bg-gradient-to-r from-green-500 to-green-400 text-white flex flex-col justify-center items-center px-8 text-center rounded-l-[150px] transition-all duration-700">
        <a href="../">
          <div class="bg-white w-32 h-32 rounded-full flex items-center justify-center overflow-hidden">
            <img src="../assets/Logo_bawah.png" class="w-[90px] h-[90px] object-contain" />
          </div>
        </a>
        <h2 id="overlayTitle" class="text-2xl font-bold mb-2">Hello, Friend!</h2>
        <p id="overlayText" class="mb-6">Register with your personal details to start journey</p>
        <!-- <img src="../assets/login.jpg" alt="Reading Illustration" class="w-24 h-24 rounded-xl object-cover mb-6 shadow-md" /> -->
        <button id="overlayBtn" class="border border-white px-5 py-2 rounded hover:bg-white hover:text-green-600 transition">Sign Up</button>
      </div>
    </div>

  </div>

  <script>
    const container = document.getElementById("container") || document.getElementById("main-container");
    const signUpForm = document.getElementById("signUpForm");
    const signInForm = document.getElementById("signInForm");

    const overlayContainer = document.getElementById("overlayContainer");
    const overlay = document.getElementById("overlay");

    const overlayBtn = document.getElementById("overlayBtn");
    const overlayTitle = document.getElementById("overlayTitle");
    const overlayText = document.getElementById("overlayText");

    const signUpBtn = document.getElementById("signUpOverlay");
    const signInBtn = document.getElementById("signInOverlay");

    let isSignUp = false;

    function toggleForm() {
      isSignUp = !isSignUp;

      document.title = isSignUp ? "Sign Up" : "Sign In";

      if (isSignUp) {
        // Geser overlay ke kiri
        overlayContainer.classList.remove("left-1/2");
        overlayContainer.classList.add("left-0");

        // Rounded kanan
        overlay.classList.remove("rounded-l-[150px]");
        overlay.classList.add("rounded-r-[150px]");

        // Ubah konten overlay
        overlayTitle.textContent = "Welcome Back!";
        overlayText.textContent = "Enter your personal details to use all of site features";
        overlayBtn.textContent = "Sign In";

        // Tampilkan form Sign Up
        signUpForm.classList.remove("opacity-0", "pointer-events-none", "z-10");
        signUpForm.classList.add("opacity-100", "z-20");

        signInForm.classList.remove("opacity-100", "z-20");
        signInForm.classList.add("opacity-0", "pointer-events-none", "z-10");
      } else {
        // Geser overlay ke kanan
        overlayContainer.classList.remove("left-0");
        overlayContainer.classList.add("left-1/2");

        // Rounded kiri
        overlay.classList.remove("rounded-r-[150px]");
        overlay.classList.add("rounded-l-[150px]");

        // Ubah konten overlay
        overlayTitle.textContent = "Hello, Friend!";
        overlayText.textContent = "Register with your personal details to start journey";
        overlayBtn.textContent = "Sign Up";

        // Tampilkan form Sign In
        signInForm.classList.remove("opacity-0", "pointer-events-none", "z-10");
        signInForm.classList.add("opacity-100", "z-20");

        signUpForm.classList.remove("opacity-100", "z-20");
        signUpForm.classList.add("opacity-0", "pointer-events-none", "z-10");
      }
    }

    // Tombol utama di overlay
    overlayBtn.addEventListener("click", toggleForm);

    // Jika kamu pakai tombol tambahan di luar overlay
    if (signUpBtn && signInBtn) {
      signUpBtn.addEventListener("click", () => {
        if (!isSignUp) toggleForm();
      });

      signInBtn.addEventListener("click", () => {
        if (isSignUp) toggleForm();
      });
    }
</script>

</body>
</html>
