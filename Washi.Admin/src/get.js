const URL = "http://mikahl.se/VuePHP/users.php?action=read";
const rulesURL = "http://mikahl.se/VuePHP/rules.php?action=read";

function postData(action, data) {
  axios
    .post(`http://mikahl.se/VuePHP/users.php?action=${action}`, data)
    .then(function(response) {
      if (response.data.error) {
        const errorMessage = response.data.message;
      } else {
        const successMessage = response.data.message;
      }
    });
}

// Load and delete users
function getAllUsers() {
  axios
    .get(URL)
    .then(function(response) {
      if (response.data.error) {
        app.errorMessage = response.data.message;
      } else {
        for (let i = 0; i < response.data.users.length; i++) {
          const user = response.data.users;
          // Print users in html
          const Users = document.getElementById("Users");
          Users.innerHTML += `
          <div class='Users-block' name='${user[i].apartmentNumber}' id='${
            user[i].id
          }' data='${user[i].apartmentNumber}'>
            <p><strong>Lägenhetsnummer:</strong> ${user[i].apartmentNumber}</p>
            <p><strong>Lösenord:</strong> ${user[i].password}</p>
            <p><strong>Skapad:</strong> ${user[i].dateAdded}</p>
            <button class='Button Button--delete u-marginTlg'>Ta bort</button>
          </div>
          `;
        }
      }
    })
    .then(function() {
      const deleteButtons = document.getElementsByClassName("Button--delete");
      for (let deleteButton of deleteButtons) {
        deleteButton.addEventListener("click", function() {
          const userId = { id: this.parentElement.id };
          const formData = toFormData(userId);
          postData("delete", formData);
          location.reload();
        });
      }
    });
}

function getAllRules() {
  axios.get(rulesURL).then(function(response) {
    if (response.data.error) {
      app.errorMessage = response.data.message;
    } else {
      const rule = response.data.rules;
      editor.contentDocument.getElementsByTagName("body")[0].innerHTML =
        rule[0].textField;
    }
  });
}

function toFormData(obj) {
  const formData = new FormData();
  for (let key in obj) {
    formData.append(key, obj[key]);
  }
  return formData;
}

// Create new user
function createNewUser() {
  const createUserButton = document.getElementById("createUserButton");

  createUserButton.addEventListener("click", function() {
    const apartmentNumberInput = document.getElementById("appNo").value;
    const passwordInput = document.getElementById("password").value;

    const user = {
      apartmentNumber: apartmentNumberInput,
      password: passwordInput
    };

    const newUser = toFormData(user);
    postData("create", newUser);
    location.reload();
  });
}


// Create new rule
function createNewRule() {
  const editor = document.getElementById("editor");
  axios
    .post("http://mikahl.se/VuePHP/rules.php?action=delete")
    .then(function(response) {
      if (response.data.error) {
        const errorMessage = response.data.message;
      } else {
        const successMessage = response.data.message;
      }
    });

  const rule = {
    textField: editor.contentDocument.getElementsByTagName("body")[0].innerHTML
  };

  const newRule = toFormData(rule);
  axios
    .post("http://mikahl.se/VuePHP/rules.php?action=create", newRule)
    .then(function(response) {
      if (response.data.error) {
        const errorMessage = response.data.message;
      } else {
        location.reload();
      }
    });
}

const update = document.getElementById("update");
update.addEventListener("click", function() {
  createNewRule();
});

// Allows searching for users by apartmentnumber
const searchInput = document.getElementById("searchInput");
searchInput.addEventListener("keyup", function() {
  const createdUsers = document.getElementsByClassName("Users-block");
  for (let createdUser of createdUsers) {
    if (createdUser.innerHTML.includes(searchInput.value)) {
      createdUser.style.display = "block";
    } else {
      createdUser.style.display = "none";
    }
  }
});

getAllUsers();
getAllRules();
createNewUser();
//createNewRule();
