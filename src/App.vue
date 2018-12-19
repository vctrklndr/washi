<template>
  <div id="app">
<<<<<<< HEAD
    <user v-if="loggedIn === true"/>
    <div v-else class="Login-container u-marginTlg">
      <img
        class="Login-logo u-marginVlg"
        src="src/Assets/Images/washi-logo-brandcolor.svg"
        alt="Logo"
      >
      <label class="Input-label u-textXSmall" for="username">Användarnamn:</label>
      <input class="Input" id="username" type="text" placeholder="Användarnamn">
      <label class="Input-label u-marginTsm u-textXSmall" for="username">Lösenord:</label>
      <input class="Input" id="password" type="password" placeholder="Lösenord">
      <button @click="loginUser(); formatBookings()" class="Button u-marginTlg">Logga in</button>
=======
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
    <div 
    class="Page-container">
      <main class="Page-main">
        <router-view @authenticated="setAuthenticated"/>
      </main>
>>>>>>> a3df6ad444606a528bfc9a028a9e44de59cc72e4
    </div>
    <w-footer v-if="authenticated"/>
  </div>
</template>

<script>
import WFooter from "./components/Footer.vue";
export default {
<<<<<<< HEAD
  name: "app",
  data() {
    return {
      loggedIn: false,
      savedBookingsFromDB: [],
      formattedBookings: []
    };
  },

  mounted: function() {
    this.getAllUsers();
    //formatData();
    //this.bookings.dates = this.groupBy(app.savedBookingsFromDB, "bookingDate");
  },
  components: {
    User
  },
  methods: {
    formatBookings: function() {
      console.log(app.formattedBookings);
      this.formattedBookings = this.groupBy(
        this.savedBookingsFromDB,
        "bookingDate"
      );
      console.log(this.formattedBookings);
    },
    loginUser: function() {
      this.loggedIn = true;
    },
    groupBy: (arrayToGroup, keyToGroupBy) => {
      return arrayToGroup.reduce((previous, current) => {
        (previous[current[keyToGroupBy]] =
          previous[current[keyToGroupBy]] || []).push(current);
        return previous;
      }, {});
    },
    getAllUsers: function() {
      axios
        .get("http://mikahl.se/VuePHP/api.php?action=read")
        .then(function(response) {
          if (response.data.error) {
            app.errorMessage = response.data.message;
          } else {
            console.log(response.data);
            app.savedBookingsFromDB = response.data.bookings;
            console.log(app.savedBookingsFromDB);
          }
        });
=======
  name: "App",
  components: {
    WFooter
  },
  data() {
    return {
      authenticated: false,
      mockAccount: {
        username: "1203",
        password: "123"
      },
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
>>>>>>> a3df6ad444606a528bfc9a028a9e44de59cc72e4
    }
  }
};
</script>

<style lang="less">
@import "src/Assets/Styles/app.less";
</style>
