<template>
  <section class="Section u-marginVxlg">
    <div class="Section--fullHeight u-sizeFull u-textCenter">
      <img id="Logo-estate" :src="logo" title="Fastighetslogotyp" /><br />
      <router-link class="Button Button--medium u-marginTlg" to="/boka">Klicka här för att boka tvättid</router-link>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      logo: ''
    };
  },
  mounted: function() {
    this.getAllRules();
  },
  methods: {
    getAllRules: function() {
      axios
        .get("http://mikahl.se/VuePHP/logo.php?action=read")
        .then(response => {
        if (response.data.error) {
          app.errorMessage = response.data.message;
        } else {
          this.logo = response.data.logo[0].logoUrl;
        }
        });
    }
  }
};
</script>
