let checkRules = {};
let checkLogo = {};

function postData(update, action, data) {
  axios
    .post(`http://mikahl.se/VuePHP/${update}.php?action=${action}`, data)
    .then(function(response) {
      if (response.data.error) {
        console.log(response.data.message);
      } else {
        //location.reload();
      }
    });
}

// Load and delete users
function getAllUsers() {
  axios
    .get("http://mikahl.se/VuePHP/users.php?action=read")
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
          postData("users", "delete", formData);
        });
      }
    });
}

// Get rules
function getAllRules() {
  axios
    .get("http://mikahl.se/VuePHP/rules.php?action=read")
    .then(function(response) {
      if (response.data.error) {
        app.errorMessage = response.data.message;
      } else {
        checkRules = response.data.rules;
        const rule = response.data.rules;
        editor.contentDocument.getElementsByTagName("body")[0].innerHTML =
          rule[0].textField;
      }
    });
}

// Get logo
function getLogo() {
  axios
    .get("http://mikahl.se/VuePHP/logo.php?action=read")
    .then(function(response) {
      if (response.data.error) {
        app.errorMessage = response.data.message;
      } else {
        checkLogo = response.data.logo[0]
        document.getElementById("logoInput").value = checkLogo.logoUrl;
        const imageContainer = document.getElementById("imageContainer");
        imageContainer.innerHTML += `
          <img src="${checkLogo.logoUrl}" class="Logo-current">
        `;
      }
    });
}

// Add new logo
function addLogo() {
    const mumma = checkLogo.urlId
    const logoUrlInput = document.getElementById("logoInput").value;
    const logo = {
      logoUrl: logoUrlInput,
      urlId: mumma
    };
    console.log(logo)
    const addLogo = toFormData(logo);

    if (logo.length < 1) {
      postData("logo", "create", addLogo);
    } else {
      postData("logo", "update", addLogo);
    }

  }

const addLogobutton = document.getElementById("uploadLogo");
addLogobutton.addEventListener("click", function() {
  addLogo();
});

// Create new user
function createNewUser() {
  const apartmentNumberInput = document.getElementById("appNo").value;
  const passwordInput = document.getElementById("password").value;
  const user = {
    apartmentNumber: apartmentNumberInput,
    password: passwordInput
  };
  const newUser = toFormData(user);
  if (apartmentNumberInput === "") {
    alert("Felmeddelande: Du har glömt ange lägenhetsnummer");
  } else if (passwordInput === "") {
    alert("Felmeddelande: Du har glömt ange lösenord");
  } else {
    postData("users", "create", newUser);
  }
}

const createUserButton = document.getElementById("createUserButton");
createUserButton.addEventListener("click", function() {
  createNewUser();
});

// Create new rule
function createNewRule() {
  const editor = document.getElementById("editor");
  const rule = {
    textField: editor.contentDocument.getElementsByTagName("body")[0].innerHTML,
    textId: checkRules[0].textId
  };
  const newRule = toFormData(rule);
  if (checkRules.length < 1) {
    postData("rules", "create", newRule);
  } else {
    postData("rules", "update", newRule);
  }
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

function toFormData(obj) {
  const formData = new FormData();
  for (let key in obj) {
    formData.append(key, obj[key]);
  }
  return formData;
}

getAllUsers();
getAllRules();
getLogo();
