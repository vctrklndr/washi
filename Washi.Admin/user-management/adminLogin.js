const authUsername = "admin";
const authPassword = "pass";
const loginButton = document.getElementById("adminLoginButton");
const loginErrorMessage = document.getElementById("loginErrorMessage");
loginButton.addEventListener("click", function() {
  const username = document.getElementById("admin-username").value;
  const password = document.getElementById("admin-password").value;
  if (username === authUsername && password === authPassword) {
    console.log("Valid!");
    window.location.href = "login.html";
  } else {
    console.log("Error!");
    loginErrorMessage.className = "showErrorMessage";
  }
});
