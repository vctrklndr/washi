<template>
  <section class="Section Section--contain">
    <div>
      <h1 class="Heading Heading--h1 Heading-line">Boka tvättid</h1>
    </div>
    <div class="Grid u-marginTlg">
      <div class="Grid-cell u-md-size6of10 Calendar--spacing">
        <div class="Calendar--daysHeading">
          <h2 class="Heading Heading--h2 Calendar-header u-marginTz u-flex u-spaceBetween">
            <button
              v-if="month !== initialMonth || year !== initialYear"
              @click="subtractMonth()"
              class="Calendar-button"
            >&lt; Föregående</button>
            <button
              v-else
              class="Calendar-button Calendar-button--disabled"
              disabled
            >&lt; Föregående</button>
            <time>{{month.charAt(0).toUpperCase() + month.slice(1) + ' - ' + year}}</time>
            <button @click="addMonth()" class="Calendar-button">Nästa &gt;</button>
          </h2>
          <div class="Calendar u-paddingBz">
            <button
              v-for="day in days"
              class="Calendar-day Calendar-day--heading"
              :key="day.id"
              disabled
            >
              <div class="Calendar-day-content">
                <div class="Calendar-dayNumber">{{day}}</div>
              </div>
            </button>
          </div>
        </div>
        <div class="Calendar u-marginTz">
          <blank v-for="blank in firstDayOfMonth" :key="blank.id"/>
          <button
            v-for="(date, index) in daysInMonth"
            :key="date.id"
            @click="selectDate(date), setActiveDate(date, index)"
            :id="setDateId(date)"
            :class="{
              'Calendar-day--today':
                date === initialDate && 
                month === initialMonth &&
                year === initialYear,
              'Calendar-day--selected': activeDateIndex === index,
              'Calendar-day--disabled':
                checkIfFullyBooked(setDateId(date)) ||
                date < today.format('D') &&
                month === today.format('MMMM') &&
                year === today.format('YYYY')
            }"
            class="Calendar-day"
            :disabled="
              checkIfFullyBooked(setDateId(date)) ||
              date < today.format('D') &&
              month === today.format('MMMM') &&
              year === today.format('YYYY')"
          >
            <div class="Calendar-day-content">
              <div class="Calendar-dayNumber">{{date}}</div>
            </div>
          </button>
          <blank v-for="blank in lastDayOfMonth" :key="blank.id"/>
        </div>
      </div>
      <booking-information v-if="selectedDate === ''"/>
      <div v-else class="Calendar--times Grid-cell u-md-size4of10">
        <div class="Heading Heading--h2 Calendar-header u-marginTz">
          <time
            class="Calendar-selectedDate"
          >{{displayDate.charAt(0).toUpperCase() + displayDate.slice(1)}}</time>
        </div>
        <button
          v-for="(time, index) in times"
          :key="time.id"
          class="Calendar-time"
          @click="selectTime(index + 1), setActiveTime(time, index)"
          :id="'tid' + (index + 1)"
          :class="{
            'Calendar-time--selected': activeTimeIndex === index,
            'Calendar-time--disabled' :
              checkBookedTimes(index + 1)
            }"
          :disabled="checkBookedTimes(index + 1)"
        >
          <time>{{time}}</time>
        </button>
        <div class="u-textCenter">
          <button
            v-if="selectedDate !== '' && selectedTime !== ''"
            @click="saveUser()"
            class="Button Button--large u-marginTlg"
          >Boka tid</button>
          <button
            v-else
            class="Button Button--large Button--disabled u-marginTlg"
            disabled
          >Boka tid</button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import moment from "moment";
import "moment/locale/sv";
import Blank from "./Blank.vue";
import BookingInformation from "./BookingInformation.vue";
moment.updateLocale("sv", {
  week: {
    dow: 1
  }
});
export default {
  components: {
    Blank,
    BookingInformation
  },
  data() {
    return {
      today: moment(),
      dateContext: moment(),
      displayDate: moment().format("dddd" + " D " + "MMMM"),
      days: ["Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Sön"],
      times: [
        "06.00 – 09.00",
        "09.00 – 12.00",
        "12.00 – 15.00",
        "15.00 – 18.00",
        "18.00 – 21.00"
      ],
      selectedDate: "",
      selectedTime: "",
      errorMessage: "",
      successMessage: "",
      bookings: [],
      newBooking: { selectedDate: "", selectedTime: "" },
      clickedUser: {},
      activeDateIndex: undefined,
      activeTimeIndex: undefined
    };
  },
  computed: {
    year: function() {
      return this.dateContext.format("Y");
    },
    month: function() {
      return this.dateContext.format("MMMM");
    },
    dayOfMonth: function() {
      return this.dateContext.format("D");
    },
    daysInMonth: function() {
      return this.dateContext.daysInMonth("D");
    },
    currentDate: function() {
      return this.dateContext.get("D");
    },
    firstDayOfMonth: function() {
      const firstDay = moment(this.dateContext).subtract(
        this.currentDate - 1,
        "days"
      );
      return firstDay.weekday();
    },
    lastDayOfMonth: function() {
      const lastDayOfMonth = Number(
        moment(this.dateContext)
          .endOf("month")
          .format("d")
      );
      const monday = 1;
      const tuesday = 2;
      const wednesday = 3;
      const thursday = 4;
      const friday = 5;
      const saturday = 6;
      const sunday = 0;
      if (lastDayOfMonth === monday) {
        return +6;
      } else if (lastDayOfMonth === tuesday) {
        return +5;
      } else if (lastDayOfMonth === wednesday) {
        return +4;
      } else if (lastDayOfMonth === thursday) {
        return +3;
      } else if (lastDayOfMonth === friday) {
        return +2;
      } else if (lastDayOfMonth === saturday) {
        return +1;
      } else if (lastDayOfMonth === sunday) {
        return 0;
      } else return lastDayOfMonth;
    },
    initialDate: function() {
      return this.today.get("D");
    },
    initialMonth: function() {
      return this.today.format("MMMM");
    },
    initialYear: function() {
      return this.today.format("Y");
    }
  },
  mounted: function() {
    //this.bookings.dates = this.groupBy(app.savedBookingsFromDB, "bookingDate");
    //console.log(this.bookings.dates["2018-12-18"].length);
    //console.log(this.$parent.formattedData["2018-12-28"].length);
    //this.checkIfBooked();
    // console.log("mounted");
    // console.log(this.$parent.formattedData);
  },
  methods: {
    addMonth: function() {
      this.dateContext = moment(this.dateContext).add(1, "month");
      this.activeDateIndex = undefined;
    },
    subtractMonth: function() {
      this.dateContext = moment(this.dateContext).subtract(1, "month");
      this.activeDateIndex = undefined;
    },
    checkIfFullyBooked: function(date) {
      var bookings = this.$parent.formattedData;

      if (bookings.hasOwnProperty(date) === false) {
        // console.log(false);
        // console.log(date);
      } else if (
        bookings.hasOwnProperty(date) === true &&
        this.$parent.formattedData[date].length >= 5
      ) {
        // console.log(true);
        // console.log(date);
        return true;
      }
    },
    checkBookedTimes(slot) {
      var time = "tid" + slot;
      var date = this.selectedDate;
      var bookings = this.$parent.formattedData;

      if (bookings.hasOwnProperty(date) === false) {
        // console.log(false);
        // console.log(date);
      } else if (bookings.hasOwnProperty(date) === true) {
        //console.log(bookings[date][0]);
        for (var i = 0; i < bookings[date].length; i++) {
          if (time === bookings[date][i].bookingTime) {
            //console.log("detta kommer aldrig funka");
            return true;
          }
        }
      }
    },
    setDateId: function(date) {
      const month = this.dateContext.format("MMMM");
      const year = this.dateContext.format("YYYY");
      const day = moment(year + month + date).format("YYYY-MM-DD");
      return day;
    },
    selectDate: function(date) {
      const month = this.dateContext.format("MMMM");
      const year = this.dateContext.format("YYYY");
      const day = moment(year + month + date).format("YYYY-MM-DD");

      this.selectedDate = day;
      this.selectedTime = "";
      this.displayDate = moment(year + month + date).format(
        "dddd" + " D " + "MMMM"
      );
      //console.log(this.selectedDate);
    },
    selectTime: function(time) {
      this.selectedTime = "tid" + time;
      this.newBooking = {
        selectedDate: this.selectedDate,
        selectedTime: "tid" + time
      };
      // console.log(this.selectedTime);
      // console.log(this.groupBy(app.bookings, "bookingDate"));
    },
    saveUser: function() {
      var formData = this.toFormData(this.newBooking);
      axios
        .post("http://mikahl.se/VuePHP/api.php?action=create", formData)
        .then(function(response) {
          console.log(response);

          if (response.data.error) {
            app.errorMessage = response.data.message;
          } else {
            app.successMessage = response.data.message;
          }
        });
    },
    updateUser: function() {
      var formData = app.toFormData(app.clickedUser);
      axios
        .post("http://localhost:8888/VuePHP/api.php?action=update", formData)
        .then(function(response) {
          console.log(response).data.bookings;
          app.clickedUser = {};
          if (response.data.error) {
            app.errorMessage = response.data.message;
          } else {
            app.successMessage = response.data.message;
            app.getAllUsers();
          }
        });
    },
    deleteUser: function() {
      var formData = app.toFormData(app.clickedUser);
      axios
        .post("http://localhost:8888/VuePHP/api.php?action=delete", formData)
        .then(function(response) {
          console.log(response);
          app.clickedUser = {};
          if (response.data.error) {
            app.errorMessage = response.data.message;
          } else {
            app.successMessage = response.data.message;
            app.getAllUsers();
          }
        });
    },
    selectUser(user) {
      app.clickedUser = user;
    },
    toFormData: function(obj) {
      console.log(obj);
      var form_data = new FormData();
      for (var key in obj) {
        form_data.append(key, obj[key]);
      }
      return form_data;
    },
    clearMessage: function() {
      app.errorMessage = "";
      app.successMessage = "";
    },
    setActiveDate: function(date, index) {
      this.activeDateIndex = index;
      this.activeTimeIndex = undefined;
    },
    setActiveTime: function(time, index) {
      this.activeTimeIndex = index;
    }
  }
};
</script>
