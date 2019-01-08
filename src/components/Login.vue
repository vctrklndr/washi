<template>
  <div class="Login-container">
    <img class="Login-logo" src="src/Assets/Images/washi-logo.svg">
    <span
      class="u-textWeightBold u-textCenter"
      :class="{
        'u-textAltColor u-marginVlg':
        errorMessage === 'Logga in med ditt lägenhetsnummer och lösenord för att boka tvättid.',
        'Login-errorMessage u-marginVmd':
        errorMessage === 'Lägenhetsnumret eller lösenordet stämmer inte.' ||
        errorMessage === 'Du har glömt att fylla i lägenhetsnummer och/eller lösenord.',
      }"
    >{{errorMessage}}</span>
    <label class="Input-label" for="username">Lägenhetsnummer:</label>
    <input
      class="Input"
      type="text"
      name="apartmentNumber"
      v-model="input.apartmentNumber"
      placeholder="Lägenhetsnummer"
    >
    <label class="Input-label u-marginTmd" for="password">Lösenord:</label>
    <input
      class="Input"
      type="password"
      name="password"
      v-model="input.password"
      placeholder="Lösenord"
    >
    <button class="Button Button--large Button--altColor u-marginTmd" @click="login()">Login</button>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      input: {
        apartmentNumber: "",
        password: ""
      },
      errorMessage:
        "Logga in med ditt lägenhetsnummer och lösenord för att boka tvättid."
    };
  },
  methods: {
    setCookie: function(cname, cvalue, exdays) {
      const date = new Date();
      date.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
      const expires = "expires=" + d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

      this.$emit("loggedInUser", this.input.apartmentNumber);
    },
    validateUser: function() {
      const formData = this.toFormData(this.input);
      axios
        .post("http://mikahl.se/VuePHP/users.php?action=login", formData)
        .then(response => {
          console.log(response);
          if (response.data.error) {
            console.log(response.data.message);
            this.errorMessage =
              "Lägenhetsnumret eller lösenordet stämmer inte.";
          } else {
            this.$emit("authenticated", true);
            this.$router.replace({ name: "home" });
            this.setCookie("username", this.input.apartmentNumber, 2);
            console.log(this.input.apartmentNumber);
            console.log(response.data);
          }
        });
    },
    toFormData: function(obj) {
      console.log(obj);
      const form_data = new FormData();
      for (let key in obj) {
        form_data.append(key, obj[key]);
      }
      return form_data;
    },

    login: function() {
      if (this.input.apartmentNumber !== "" && this.input.password !== "") {
        this.validateUser();
      } else {
        this.errorMessage =
          "Du har glömt att fylla i lägenhetsnummer och/eller lösenord.";
      }
    }
  }
};
</script>