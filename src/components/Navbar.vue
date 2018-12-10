<template>
  <header class="Header">
    <div class="Page-container">
      <div class="Header-container">
        <router-link to="/">
          <img class="Header-logo" src="src/Assets/Images/washi-logo.svg" alt="Washi logo">
        </router-link>
        <nav class="PageNav">
          <div class="Hamburger" @click="toggleMenu">
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
            <li class="PageNav-Link">Logga ut</li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
</template>

<script>

export default {
  name: 'navbar',
  data() {
    return {
      isActive: false
    }
  },
  methods: {
    toggleMenu: function () {
      this.isActive = !this.isActive;
    },
    closeMenu: function () {
      console.log("Hejsansvejsan");
      this.isActive = false;
    }
  }
}

</script>
