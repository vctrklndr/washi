<template>
  <div id="app">
    <navbar/>
      <div class="Page-container">
    <main class="Page-main">
        <router-view></router-view>
    </main>
      </div>
    <w-footer/>
  </div>
</template>

<script>
import Navbar from "./components/Navbar.vue";
import WFooter from "./components/WFooter.vue";
export default {
  name: "app",
  components: {
    Navbar,
    WFooter
  }
};
</script>
