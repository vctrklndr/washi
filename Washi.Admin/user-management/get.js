var URL = 'http://mikahl.se/VuePHP/users.php?action=read'

// Load and delete users
function getAllUsers() {
  axios
    .get(URL)
    .then(function (response) {
      if (response.data.error) {
        app.errorMessage = response.data.message
      } else {
        for (let i = 0; i < response.data.users.length; i++) {
          var user = response.data.users
          console.log(user[i])
          // Print users in html
          var userlist = document.getElementById('userlist');
          userlist.innerHTML += `
          <div style='padding: 5px; text-align: left; outline:1px solid black' id='${user[i].id}'>
            <p>Lägenhetsnummer: ${user[i].apartmentNumber}</p>
            <p>Lösenord: ${user[i].password}</p>
            <p>Id: ${user[i].id}</p>
            <p>Skapad: ${user[i].dateAdded}</p>
            <button class='deleteButtons'>Ta bort</button>
          </div>
          `
        }
      }
    })
    .then(function () {
      var deleteButtons = document.getElementsByClassName('deleteButtons')
      for (const deleteButton of deleteButtons) {
        deleteButton.addEventListener('click', function () {
          var userId = { id: this.parentElement.id }
          var formData = toFormData(userId)
          axios.post("http://mikahl.se/VuePHP/users.php?action=delete", formData)
            .then(function (response) {
              if (response.data.error) {
                var errorMessage = response.data.message
                console.log(errorMessage)
              } else {
                var successMessage = response.data.message
                console.log(successMessage)
              }
            })
            location.reload();
        })
      }
    })
};

function toFormData (obj) {
  console.log(obj)
  var formData = new FormData()
  for (var key in obj) {
    formData.append(key, obj[key])
  }
  return formData
}

// Create new user
function createNewUser () {
  var createUserButton = document.getElementById('createUserButton')

  createUserButton.addEventListener('click', function () {
    var apartmentNumberInput = document.getElementById('appNo').value
    var passwordInput = document.getElementById('password').value

    var user = {
      'apartmentNumber': apartmentNumberInput,
      'password': passwordInput
    }

    var newUser = toFormData(user)
    axios.post("http://mikahl.se/VuePHP/users.php?action=create", newUser)
      .then(function (response) {
        console.log(response)
        if (response.data.error) {
          var errorMessage = response.data.message
          console.log(errorMessage)
        } else {
          var successMessage = response.data.message
          console.log(successMessage)
        }
      })
      location.reload();
  })
}

getAllUsers()
createNewUser()
