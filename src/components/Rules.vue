<template>
  <section class="Section Section--contain">
    <div class="Page-container">
      <h1 class="Heading Heading--h1 Heading-line">Regler</h1>
      <div id="Rules" v-html="rules" class="u-md-size2of3 u-textLarge"></div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      rules: ''
    };
  },
  mounted: function() {
    this.getAllRules();
  },
  methods: {
    getAllRules: function() {
      axios
        .get("http://mikahl.se/VuePHP/rules.php?action=read")
        .then(response => {
        if (response.data.error) {
          app.errorMessage = response.data.message;
        } else {
          this.rules = response.data.rules[0].textField;
        }
        });
    }
  }
};
</script>