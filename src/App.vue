<template>
  <div id="app">
    <navbar v-if="loggedIn === true"/>
    <login v-if="loggedIn !== true" />
    <div class="Page-container" v-if="loggedIn === true">
      <main class="Page-main">
        <router-view></router-view>
      </main>
    </div>
    <w-footer v-if="loggedIn === true"/>
  </div>
</template>

<script>
import Navbar from "./components/Navbar.vue";
import WFooter from "./components/WFooter.vue";
import Login from "./components/Login.vue";
export default {
  name: "app",
  components: {
    Navbar,
    WFooter,
    Login
  },
  data() {
    return {
      loggedIn: true
    };
  }
};
</script>

<style lang="less">
@import "src/Assets/Styles/app.less";
</style>
