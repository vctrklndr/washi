<template>
  <div id="app">
    <header class="Header" v-if="authenticated">
      <div class="Page-container">
        <div class="Header-container">
          <router-link to="/home">
            <img
              @click="closeMenu"
              class="Header-logo"
              src="src/Assets/Images/washi-logo.svg"
              alt="Washi logo"
            >
          </router-link>
          <nav class="PageNav">
            <div
              class="Hamburger"
              :class="{'Hamburger--open': isActive}"
              @click="toggleMenu(); disableScroll();"
            >
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>
            <ul class="PageNav-list" :class="{'PageNav-list--open': isActive}">
              <li @click="closeMenu">
                <router-link class="PageNav-Link" to="/boka">Boka tvättid</router-link>
              </li>
              <li @click="closeMenu">
                <router-link class="PageNav-Link" to="/hjalp">Hjälp</router-link>
              </li>
              <li @click="closeMenu">
                <router-link class="PageNav-Link" to="/regler">Regler</router-link>
              </li>
              <li @click="closeMenu">
                <router-link class="PageNav-Link" to="/tvattrad">Tvättråd</router-link>
              </li>
              <li @click="closeMenu">
                <router-link
                  class="PageNav-Link"
                  v-if="authenticated"
                  to="/login"
                  @click.native="logout()"
                  replace
                >Logga ut</router-link>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <div class="Page-container">
      <main class="Page-main">
        <router-view @authenticated="setAuthenticated"/>
      </main>
    </div>
    <w-footer v-if="authenticated"/>
  </div>
</template>

<script>
import WFooter from "./components/Footer.vue";
export default {
  name: "App",
  components: {
    WFooter
  },
  data() {
    return {
      authenticated: false,
      isActive: false
    };
  },
  mounted() {
    if (!this.authenticated) {
      this.$router.replace({ name: "login" });
    }
  },
  methods: {
    setAuthenticated(status) {
      this.authenticated = status;
    },
    logout: function() {
      this.authenticated = false;
    },
    toggleMenu: function() {
      this.isActive = !this.isActive;
    },
    disableScroll: function() {
      const app = document.getElementById("app");
      if (app.classList.contains("disable-scroll")) {
        app.classList.remove("disable-scroll");
      } else {
        app.classList.add("disable-scroll");
      }
    },
    closeMenu: function() {
      this.isActive = false;
      const app = document.getElementById("app");
      app.classList.remove("disable-scroll");
      window.scrollTo({
        top: 0
      });
    }
  }
};
</script>

<style lang="less">
@import "src/Assets/Styles/app.less";
</style>
