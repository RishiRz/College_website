const loginCard = document.getElementById("loginCard");
const forgotCard = document.getElementById("forgotCard");
const createCard = document.getElementById("createCard");

// SWITCH CARDS
function showCreate() {
  loginCard.classList.add("d-none");
  forgotCard.classList.add("d-none");
  createCard.classList.remove("d-none");
}

function showForgot() {
  loginCard.classList.add("d-none");
  forgotCard.classList.remove("d-none");
}

function showLogin() {
  forgotCard.classList.add("d-none");
  loginCard.classList.remove("d-none");
  createCard.classList.add("d-none");
}

// CREATE
function createAccount() {
  let tel = document.getElementById("createphone").value.trim();
  let text = document.getElementById("adminName").value.trim();
  let password = document.getElementById("createPassword").value.trim();

  if (!text || !password || !tel) {
    alert("Please fill all fields");
    return;
  }

  fetch("admin_login.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `action=create&adminName=${encodeURIComponent(text)}&phone=${encodeURIComponent(tel)}&password=${encodeURIComponent(password)}`,
  })
    .then((res) => res.text())
    .then((data) => {
      console.log(data);

      if (data === "success") {
        alert("Admin created successfully");

        document.getElementById("createCard").classList.add("d-none");
        document.getElementById("loginCard").classList.remove("d-none");
      } else {
        alert(data);
      }
    })
    .catch((err) => console.error(err));
}

// LOGIN
function login() {
  let tel = document.getElementById("loginphone").value.trim();
  let password = document.getElementById("loginPassword").value.trim();

  if (!tel || !password) {
    alert("Please fill all fields");
    return;
  }

  fetch("admin_login.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `action=login&password=${encodeURIComponent(password)}&phone=${encodeURIComponent(tel)}`,
  })
    .then((res) => res.text())
    .then((data) => {
      console.log("Server response:", data);

      if (data === "success") {
        alert("Login successfully!");
        window.location.href = "../admin/pages/dashboard.php"; // redirect
      } else {
        alert("Invalid phone or password");
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Something went wrong. Try again.");
    });
}

// FORGOT
function sendForgotOTP() {
  const phone = forgotphone.value.trim();

  if (!phone || phone.length < 10) {
    alert("Please enter a valid phone number");
    return;
  }

  fetch("../../auth/send_reset_otp.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "phone=" + encodeURIComponent(phone),
  })
    .then((res) => res.text())
    .then((data) => {
      console.log(data);
      document.getElementById("message").innerText = data;

      if (data.toLowerCase().includes("otp")) {
        // ✅ SHOW RESET SECTION
        document.getElementById("resetSection").classList.remove("d-none");

        // ✅ OPTIONAL: hide send button and phone number
        document.getElementById("sendOtpBtn").classList.add("d-none");
        document.getElementById("forgotphone").classList.add("d-none");

        //Timer
        startTimer(); // 🔥 START TIMER HERE
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Failed to send OTP. Try again.");
    });
}

function resendOTP() {
  sendForgotOTP(); // reuse same function
  startTimer(); //resume the timer
}

function resetPassword() {
  fetch("../../auth/reset_password.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `phone=${forgotphone.value}&otp=${forgotOtp.value}&password=${resetPasswordField.value}`,
  })
    .then((res) => res.text())
    .then(alert);
}

// TIMER
let t;

function startTimer() {
  let time = 120; // 2 minutes
  const timerEl = document.getElementById("timer");

  clearInterval(t);

  t = setInterval(() => {
    let minutes = Math.floor(time / 60);
    let seconds = time % 60;

    // format like 02:05
    seconds = seconds < 10 ? "0" + seconds : seconds;

    timerEl.innerText = `OTP expires in ${minutes}:${seconds}`;

    time--;

    if (time < 0) {
      clearInterval(t);
      timerEl.innerText = "OTP expired ❌";

      // 👉 show resend button
      document.getElementById("resendBtn").classList.remove("d-none");
    }
  }, 1000);
}

// AUTO MOVE TO NEXT INPUT (Typing)
document.querySelectorAll(".otp-input").forEach((input, index, inputs) => {
  input.addEventListener("input", (e) => {
    input.value = input.value.replace(/[^0-9]/g, ""); // only numbers

    if (input.value && inputs[index + 1]) {
      inputs[index + 1].focus();
    }
  });

  // Backspace → go to previous
  input.addEventListener("keydown", (e) => {
    if (e.key === "Backspace" && !input.value && inputs[index - 1]) {
      inputs[index - 1].focus();
    }
  });
});

// PASTE FULL OTP → AUTO DISTRIBUTE
document.querySelector(".otp-container").addEventListener("paste", (e) => {
  e.preventDefault();

  const pasteData = (e.clipboardData || window.clipboardData)
    .getData("text")
    .replace(/\D/g, ""); // only numbers

  const inputs = document.querySelectorAll(".otp-input");

  pasteData.split("").forEach((char, i) => {
    if (inputs[i]) {
      inputs[i].value = char;
    }
  });

  // focus last filled box
  const lastIndex = Math.min(pasteData.length, inputs.length) - 1;
  if (inputs[lastIndex]) {
    inputs[lastIndex].focus();
  }
});
