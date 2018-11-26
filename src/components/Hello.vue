<template>
  <div>
    <header class="Header">
      <div class="Page-container">
        <div class="Header-container">
          <img class="Header-logo" src="src/Assets/Images/washi-logo.svg" width="200px">
          <nav class="PageNav">
            <ul class="PageNav-list">
              <li class="PageNav-Link">Boka tvättid</li>
              <li class="PageNav-Link">Regler</li>
              <li class="PageNav-Link">Tvättråd</li>
              <li class="PageNav-Link">Logga ut</li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <div class="Page-container">
      <h1>{{ message }}</h1>
      <span class="Button">Hej</span>
    </div>
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
