<template>
  <div id="hello">
    <img src="src/Assets/Images/washi-logo.svg" width="200px">
    <h1>{{ message }}</h1>
    <span class="Button">Hej</span>
  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      message: 'Välkommen till världens guffigaste tvättstuga!'
    }
  }
}
</script>
