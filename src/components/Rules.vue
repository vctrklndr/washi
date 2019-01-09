<template>
  <section class="Section Section--contain">
    <div class="Page-container">
      <h1 class="Heading Heading--h1 Heading-line">Regler</h1>
      <div id="Rules">
      </div>
    </div>
  </section>
</template>

<script>
export default {
  mounted: function() {
    this.getAllRules();
  },
  methods: {
    getAllRules() {
      const rulesURL = "http://mikahl.se/VuePHP/rules.php?action=read"
      axios
        .get(rulesURL)
        .then(function(response) {
          if (response.data.error) {
            app.errorMessage = response.data.message;
          } else {
            console.log(response)
            for (let i = 0; i < response.data.rules.length; i++) {
              const rule = response.data.rules;
              // Print rules in html
              const Rules = document.getElementById("Rules");
              Rules.innerHTML += `
              <div class='Users-block' name='${rule[i].id}' id='${
                rule[i].id
              }' data='${rule[i].id}'>
                ${rule[i].textField}
              </div>
              `;
            }
          }
        })
      }
  },
};
</script>
