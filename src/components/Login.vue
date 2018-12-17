<template>
  <div class="Login-container u-marginTlg">
    <img class="Login-logo u-marginVlg" src="src/Assets/Images/washi-logo-brandcolor.svg" alt="Logo" />
    <label class="Input-label u-textXSmall" for="username">Användarnamn:</label>
    <input class="Input" id="username" type="text" placeholder="Användarnamn" />
    <label class="Input-label u-marginTsm u-textXSmall" for="username">Lösenord:</label>
    <input class="Input" id="password" type="password" placeholder="Lösenord" />
    <button class="Button u-marginTlg">Logga in</button>
  </div>
</template>

<script>
export default {
  name: "login"
};
</script>
