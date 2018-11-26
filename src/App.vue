<template>
  <div id="app">
    <hello></hello>
  </div>
</template>

<script>
import Hello from './components/Hello.vue';

export default {
  name: 'app',
  components: {
    Hello
  }
}
</script>

<style lang="less">
  @import 'src/Assets/Styles/app.less';
</style>