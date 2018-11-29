<template>
  <div id="app">
    <div class="Page">
      <navbar/>
        <div class="Page-container">
      <main class="Page-main">
          <hello/>
          <loop/>
      </main>
        </div>
    </div>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import Hello from './components/Hello.vue';
import Loop from './components/Loop.vue';

export default {
  name: 'app',
  components: {
    Navbar,
    Hello,
    Loop
  }
}
</script>

<style lang="less">
  @import 'src/Assets/Styles/app.less';
</style>

