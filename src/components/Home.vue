<template>
  <section class="Section">
    <div class="Page-container u-textCenter">
      <h1 class="Heading Heading--h1">{{message}}</h1>
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
