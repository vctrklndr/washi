<template>
  <div id="app">
    <navbar/>
    <div class="Page-container">
      <main class="Page-main">
        <router-view></router-view>
      </main>
    </div>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
export default {
  name: 'app',
  components: {
    Navbar
  }
}
</script>

<style lang="less">
  @import 'src/Assets/Styles/app.less';
</style>

