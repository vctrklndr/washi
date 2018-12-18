<template>
  <div id="app">
    <user v-if="loggedIn === true"/>
    <div v-else class="Login-container">
      <img
        class="Login-logo u-marginVlg"
        src="src/Assets/Images/washi-logo.svg"
        alt="Logo"
      >
      <label class="Input-label u-textXSmall" for="username">Användarnamn:</label>
      <input class="Input" id="username" type="text" placeholder="Användarnamn">
      <label class="Input-label u-marginTsm u-textXSmall" for="username">Lösenord:</label>
      <input class="Input" id="password" type="password" placeholder="Lösenord">
      <button @click="loginUser()" class="Button Button--altColor u-marginTlg">Logga in</button>
    </div>
  </div>
</template>

<script>
import User from "./User/User.vue";

export default {
  name: "app",
  components: {
    User
  },
  data() {
    return {
      loggedIn: false
    };
  },
  methods: {
    loginUser: function() {
      this.loggedIn = true;
    }
  }
};
</script>

<style lang="less">
@import "src/Assets/Styles/app.less";
</style>
