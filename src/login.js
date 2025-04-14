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
