var createUserButton = document.getElementById('createUserButton')

createUserButton.addEventListener('click', function () {
  var apartmentNumberInput = document.getElementById('appNo').value
  var passwordInput = document.getElementById('password').value

  var newUser = {
    'apartmentNumber': apartmentNumberInput,
    'password': passwordInput
  }
  console.log(newUser)
})
