const adminURL = "http://mikahl.se/VuePHP/admins.php?action=read";
const loginButton = document.getElementById("adminLoginButton");
const loginErrorMessage = document.getElementById("loginErrorMessage");

// Load and delete users
function getAllAdmins() {
  axios.get(adminURL).then(function(response) {
    if (response.data.error) {
      app.errorMessage = response.data.message;
    } else {
      var adminName = response.data.users[0].adminName;
      var adminPass = response.data.users[0].password;
      loginButton.addEventListener("click", function() {
        const username = document.getElementById("admin-username").value;
        const password = document.getElementById("admin-password").value;
        if (username === adminName && password === adminPass) {
          console.log("Valid!");
          window.location.href = "login.html";
        } else {
          console.log("Error!");
          loginErrorMessage.className = "showErrorMessage";
        }
      });
    }
  });
}

getAllAdmins();
