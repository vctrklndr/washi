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
    <foot v-if="authenticated"/>
  </div>
</template>

<script>
import Foot from "./components/Footer.vue";
export default {
  name: "App",
  components: {
    Foot
  },
  data() {
    return {
      authenticated: false,
      isActive: false,
      loggedInUser: ""
    };
  },

  mounted() {
    this.checkCookie();
    console.log(this.getCookie("username"));
  },
  methods: {
    // group all bookings per day
    setCookie: function(cname, cvalue, exdays) {
      const date = new Date();
      date.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
      const expires = "expires=" + date.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

      //this.$parent.loggedInUser = cname;
    },

    getCookie: function(cname) {
      const name = cname + "=";
      const decodedCookie = decodeURIComponent(document.cookie);
      const ca = decodedCookie.split(";");
      for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    },
    checkCookie: function() {
      const user = this.getCookie("username");
      if (user != "") {
        this.loggedInUser = this.getCookie("username");
        this.$router.replace({ name: "home" });
        this.$emit("authenticated", true);
        this.authenticated = true;
      }
    },
    setAuthenticated(status) {
      this.authenticated = status;
    },
    logout: function() {
      this.authenticated = false;
      document.cookie =
        "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    },
    toggleMenu: function() {
      this.isActive = !this.isActive;
    },
    closeMenu: function() {
      this.isActive = false;
      const app = document.getElementById("app");
      app.classList.remove("disable-scroll");
      window.scrollTo({
        top: 0
      });
    },
    disableScroll: function() {
      const app = document.getElementById("app");
      if (app.classList.contains("disable-scroll")) {
        app.classList.remove("disable-scroll");
      } else {
        app.classList.add("disable-scroll");
      }
    }
  }
};
</script>

<style lang="less">
@import "src/Assets/Styles/app.less";
</style>
