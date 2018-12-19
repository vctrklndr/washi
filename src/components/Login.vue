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
      name="username"
      v-model="input.username"
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
    <button
      class="Button Button--large Button--altColor u-marginTmd"
      type="button"
      @click="login()"
    >Login</button>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      input: {
        username: "",
        password: ""
      },
      errorMessage:
        "Logga in med ditt lägenhetsnummer och lösenord för att boka tvättid."
    };
  },
  methods: {
    login: function() {
      if (this.input.username !== "" && this.input.password !== "") {
        if (
          this.input.username === this.$parent.mockAccount.username &&
          this.input.password === this.$parent.mockAccount.password
        ) {
          this.$emit("authenticated", true);
          this.$router.replace({ name: "home" });
        } else {
          this.errorMessage = "Lägenhetsnumret eller lösenordet stämmer inte.";
        }
      } else {
        this.errorMessage =
          "Du har glömt att fylla i lägenhetsnummer och/eller lösenord.";
      }
    }
  }
};
</script>