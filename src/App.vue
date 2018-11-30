<template>
  <div id="app">
    <navbar/>
    <div class="Page-container">
      <main class="Page-main">
        <hello/>
        <calendar/>
      </main>
    </div>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import Hello from './components/Hello.vue';
import Calendar from './components/Calendar.vue';

export default {
  name: 'app',
  components: {
    Navbar,
    Hello,
    Calendar
  }
}
</script>

<style lang="less">
  @import 'src/Assets/Styles/app.less';
</style>

