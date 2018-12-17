<template>
  <div class="Login-container u-sizeFull">
    <img class="Login-logo u-marginVlg" src="src/Assets/Images/washi-logo-brandcolor.svg" alt="Logo" />
    <label class="Input-label u-textXSmall" for="username">Användarnamn:</label>
    <input class="Input" id="username" type="text" placeholder="Användarnamn" />
    <label class="Input-label u-marginTsm u-textXSmall" for="username">Lösenord:</label>
    <input class="Input" id="password" type="password" placeholder="Lösenord" />
    <router-link class="Button u-marginTlg" to="/home">Logga in</router-link>
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