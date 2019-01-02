var URL = 'http://mikahl.se/VuePHP/users.php?action=read'

function getAllUsers() {
  axios
    .get(URL)
    .then(function (response) {
      if (response.data.error) {
        app.errorMessage = response.data.message;
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
          var userId = { id: this.parentElement.id };
          var formData = toFormData(userId);
          axios.post("http://mikahl.se/VuePHP/users.php?action=delete", formData)
          .then(function (response) {
            if(response.data.error) {
              var errorMessage = response.data.message;
              console.log(errorMessage);
              console.log(id);
            } else {
              var successMessage = response.data.message;
              console.log(successMessage);
              console.log(id);
            }
          })
        })
      }
    })
};

function toFormData(obj) {
  console.log(obj);
  var form_data = new FormData();
  for (var key in obj) {
    form_data.append(key, obj[key]);
  }
  return form_data;
}

getAllUsers();