
var authUsername = 'admin'
var authPassword = 'pass'
var loginButton = document.getElementById('adminLoginButton')
var loginErrorMessage = document.getElementById('loginErrorMessage')
loginButton.addEventListener('click', function () {
  var username = document.getElementById('admin-username').value
  var password = document.getElementById('admin-password').value
  if (username === authUsername && password === authPassword) {
    console.log('Valid!');
    window.location.href = 'login.html'
  } else {
    console.log('Error!');
    loginErrorMessage.className = 'showErrorMessage'
  }
})
