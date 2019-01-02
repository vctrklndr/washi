<template>
  <header class="Header">
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
            <li @click="closeMenu()">
              <router-link class="PageNav-Link" to="/boka">Boka tvättid</router-link>
            </li>
            <li @click="closeMenu()">
              <router-link class="PageNav-Link" to="/hjalp">Hjälp</router-link>
            </li>
            <li @click="closeMenu()">
              <router-link class="PageNav-Link" to="/regler">Regler</router-link>
            </li>
            <li @click="closeMenu()">
              <router-link class="PageNav-Link" to="/tvattrad">Tvättråd</router-link>
            </li>
            <li @click="closeMenu()">
              <router-link
                class="PageNav-Link"
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
</template>

<script>
export default {
  name: "navbar",
  data() {
    return {
      isActive: false
    };
  },
  methods: {
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
