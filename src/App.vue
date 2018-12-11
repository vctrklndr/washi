<template>
  <div id="app">
    <navbar/>
    <main class="Page-main">
      <Data/>
      <div class="Page-container">
        <router-view></router-view>
      </div>
    </main>
    <w-footer/>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import WFooter from './components/WFooter.vue';
import Data from './data/Data.vue'
export default {
  name: 'app',
  components: {
    Navbar,
    WFooter,
    Data
  }
}
</script>

<style lang="less">
  @import 'src/Assets/Styles/app.less';
</style>

