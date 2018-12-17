<template>
  <div class="Login-container u-marginTlg">
    <img class="Login-logo u-marginVlg" src="src/Assets/Images/washi-logo-brandcolor.svg" alt="Logo" />
    <label class="Input-label u-textXSmall" for="username">Användarnamn:</label>
    <input class="Input" id="username" type="text" placeholder="Användarnamn" />
    <label class="Input-label u-marginTsm u-textXSmall" for="username">Lösenord:</label>
    <input class="Input" id="password" type="password" placeholder="Lösenord" />
    <a href="#/main" class="Button u-marginTlg">Logga in</a>
    <router-link class="Link u-textXSmall" to="/">Admin</router-link>
  </div>
</template>

<script>
export default {
  name: "app"
};
</script>

<style lang="less">
@import "src/Assets/Styles/app.less";
</style>