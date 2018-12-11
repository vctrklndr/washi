<template>
  <section class="Section Section--contain">
    <div class="Page-container">
      <h1 class="Heading Heading--h1 Heading-line">{{message}}</h1>
    </div>
  </section>
</template>

<script>
export default {
  name: 'home',
  data () {
    return {
      message: 'Välkommen till världens guffigaste tvättstuga!'
    }
  }
}
</script>
