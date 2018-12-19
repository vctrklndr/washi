<template>
  <div id="app">
    <user v-if="loggedIn === true"/>
    <div v-else class="Login-container u-marginTlg">
      <img
        class="Login-logo u-marginVlg"
        src="src/Assets/Images/washi-logo-brandcolor.svg"
        alt="Logo"
      >
      <label class="Input-label u-textXSmall" for="username">Användarnamn:</label>
      <input class="Input" id="username" type="text" placeholder="Användarnamn">
      <label class="Input-label u-marginTsm u-textXSmall" for="username">Lösenord:</label>
      <input class="Input" id="password" type="password" placeholder="Lösenord">
      <button @click="loginUser(); formatBookings()" class="Button u-marginTlg">Logga in</button>
    </div>
  </div>
</template>

<script>
import User from "./User/User.vue";

export default {
  name: "app",
  data() {
    return {
      loggedIn: false,
      savedBookingsFromDB: [],
      formattedBookings: []
    };
  },

  mounted: function() {
    this.getAllUsers();
    //formatData();
    //this.bookings.dates = this.groupBy(app.savedBookingsFromDB, "bookingDate");
  },
  components: {
    User
  },
  methods: {
    formatBookings: function() {
      console.log(app.formattedBookings);
      this.formattedBookings = this.groupBy(
        this.savedBookingsFromDB,
        "bookingDate"
      );
      console.log(this.formattedBookings);
    },
    loginUser: function() {
      this.loggedIn = true;
    },
    groupBy: (arrayToGroup, keyToGroupBy) => {
      return arrayToGroup.reduce((previous, current) => {
        (previous[current[keyToGroupBy]] =
          previous[current[keyToGroupBy]] || []).push(current);
        return previous;
      }, {});
    },
    getAllUsers: function() {
      axios
        .get("http://mikahl.se/VuePHP/api.php?action=read")
        .then(function(response) {
          if (response.data.error) {
            app.errorMessage = response.data.message;
          } else {
            console.log(response.data);
            app.savedBookingsFromDB = response.data.bookings;
            console.log(app.savedBookingsFromDB);
          }
        });
    }
  }
};
</script>

<style lang="less">
@import "src/Assets/Styles/app.less";
</style>
