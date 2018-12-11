<template>
  <div class="flexMe">
    <form>
      <input id="userName" type="text" placeholder="username">
      <input id="appNo" type="password" placeholder="appNo">
      <button @click="setOnlineUser">Submit</button>
    </form>
    <ul>
      <li>{{loggedInUser.username}}</li>
      <li>{{loggedInUser.appNo}}</li>
    </ul>
    <div @click="logThis" id="1" class="unbooked"></div>
    <div @click="logThis" id="2" class="unbooked"></div>
    <div @click="logThis" id="3" class="unbooked"></div>
  </div>
</template>
<script>
export default {
  name: "users",
  methods: {
    setOnlineUser: function(event) {
      for (let i = 0; i < this.testdata.length; i++) {
        if (
          userName.value !== this.testdata[i].username ||
          appNo.value !== this.testdata[i].appNo
        ) {
          console.log("Fel användarnamn och/eller lösenord");
        } else {
          this.loggedInUser.username = userName.value;
          this.loggedInUser.appNo = appNo.value;
          this.renderFunction();
        }
      }
    },
    // Validates whos booking belongs to who
    renderFunction: function() {
      var bookings = document.getElementsByClassName("unbooked");

      for (let i = 0; i < bookings.length; i++) {
        if (bookings[i].id !== this.loggedInUser.appNo) {
          $(bookings[i]).addClass("booked");
          $(bookings[i]).removeClass("userbooked");
        } else {
          $(bookings[i]).addClass("userbooked");
          $(bookings[i]).removeClass("booked");
        }
      }
    },
    logThis: function(event) {
      console.log(this);
    }
  },
  mounted: function() {
    this.renderFunction();
  },
  data() {
    return {
      loggedInUser: {
        username: "Username",
        appNo: "AppNo"
      },
      testdata: [
        {
          username: "user1",
          appNo: "1"
        },
        {
          username: "user2",
          appNo: "2"
        },
        {
          username: "user3",
          appNo: "3"
        }
      ]
    };
  }
};
</script>
<style scoped>
.flexMe {
  padding: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.unbooked {
  height: 50px;
  width: 50px;
  outline: 1px solid black;
  background-color: grey;
}
.booked {
  height: 50px;
  width: 50px;
  outline: 1px solid black;
  background-color: red;
}
.userbooked {
  height: 50px;
  width: 50px;
  outline: 1px solid black;
  background-color: green;
}
</style>

