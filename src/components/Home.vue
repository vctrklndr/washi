<template>
  <section class="Section Section--contain">
    <div class="u-sizeFull u-textCenter u-marginTlg">
      <img id="Logo-estate" src="src/Assets/Images/fastighet-logo.png" title="Fastighetslogotyp" />
      <p>Välkommen till Kungshem Fastigheters tvättstugebokning.</p>
      <router-link class="Button" to="/boka">Klicka här för att boka tvättid</router-link>
    </div>
  </section>
</template>

<script>
export default {
  name: "home",
  data() {
    return {
      message: "Välkommen till världens guffigaste tvättstuga!"
    };
  }
};
</script>
