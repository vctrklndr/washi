<template>
  <section class="Section u-textCenter">
    <div class="timeDiv" v-for="(time, index) in times" v-bind:key="index">
      <p>{{ time.hour }}</p>
    </div>
  </section>
</template>

<script>
export default {
  name: "timeRow",
  data() {
    return {
      times: [
        { hour: "00:00 - 03:00" },
        { hour: "03:00 - 06:00" },
        { hour: "06:00 - 09:00" },
        { hour: "09:00 - 12:00" },
        { hour: "12:00 - 15:00" },
        { hour: "15:00 - 18:00" },
        { hour: "18:00 - 21:00" },
        { hour: "21:00 - 00:00" }
      ]
    };
  }
};
</script>
