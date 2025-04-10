<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <link href="../css/styles.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-500 to-purple-500">

  <div id="container" class="relative w-[768px] h-[480px] bg-white rounded-[30px] overflow-hidden shadow-2xl transition-all duration-700">
    
    <!-- Sign Up Form -->
    <div id="signUpForm" class="absolute right-0 top-0 w-1/2 h-full px-10 py-16 transition-all duration-700 z-10 opacity-0 pointer-events-none">
      <h2 class="text-2xl font-bold text-indigo-600 mb-4">Create Account</h2>
      <input type="text" placeholder="Name" class="w-full mb-3 p-2 border rounded" />
      <input type="email" placeholder="Email" class="w-full mb-3 p-2 border rounded" />
      <input type="password" placeholder="Password" class="w-full mb-3 p-2 border rounded" />
      <button class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Sign Up</button>
    </div>

    <!-- Sign In Form -->
    <div id="signInForm" class="absolute left-0 top-0 w-1/2 h-full px-10 py-16 transition-all duration-700 z-20 opacity-100">
      <h2 class="text-2xl font-bold text-indigo-600 mb-4">Sign In</h2>
      <input type="email" placeholder="Email" class="w-full mb-3 p-2 border rounded" />
      <input type="password" placeholder="Password" class="w-full mb-3 p-2 border rounded" />
      <button class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Sign In</button>
    </div>

    <!-- Overlay -->
    <div class="absolute top-0 left-1/2 w-1/2 h-full z-30 transition-all duration-[1000ms] ease-in-out will-change-left" id="overlayContainer">
      <div id="overlay" class="relative w-full h-full flex items-center justify-center bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-l-[150px] shadow-lg transition-all duration-[1000ms] ease-in-out">
        <div id="overlayContent" class="text-center px-8">
          <h2 id="overlayTitle" class="text-2xl font-bold mb-2">Hello, Friend!</h2>
          <p id="overlayText" class="mb-6">Register with your personal details to start journey</p>
          <button id="overlayBtn" class="border border-white px-5 py-2 rounded hover:bg-white hover:text-purple-600 transition">
            Sign Up
          </button>
        </div>
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
