<template>
  <section class="Section">
    <div class="Page-container u-textCenter">
      <h1>{{message}}</h1>
      <Button class="Button">Button</Button>
    </div>
  </section>
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
