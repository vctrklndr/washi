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
                year === today.format('YYYY'),
              'Calendar-day--booked':
                checkUserBookingDate(setDateId(date))
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
      <div
        v-if="selectedDate === '' && booked === true"
        class="Calendar--times Grid-cell u-md-size4of10 u-textCenter"
      >
        <h2 class="Heading Heading--h2 Calendar-header u-marginTz">Tvättid bokad!</h2>
        <p class="u-textLarge u-marginAz">
          Du har bokat en tvättid kl.
          <span v-if="bookingInfo.selectedTime === 'tid1'">06.00 – 09.00</span>
          <span v-else-if="bookingInfo.selectedTime === 'tid2'">09.00 – 12.00</span>
          <span v-else-if="bookingInfo.selectedTime === 'tid3'">12.00 – 15.00</span>
          <span v-else-if="bookingInfo.selectedTime === 'tid4'">15.00 – 18.00</span>
          <span v-else-if="bookingInfo.selectedTime === 'tid5'">18.00 – 21.00</span>
          <br>
          {{bookingInfo.selectedDate}}
        </p>
      </div>
      <booking-information v-else-if="selectedDate === ''"/>
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
          @click="selectTime(index + 1), setActiveTime(time, index), cancelBooking(time, index)"
          :id="'tid' + (index + 1)"
          :class="{
            'Calendar-time--selected': activeTimeIndex === index,
            'Calendar-time--disabled' :
              checkBookedTimes(index + 1),
            'Calendar-time--booked' :
              checkUserBookingTime(index + 1)
            }"
          :disabled="!checkUserBookingTime(index + 1) && checkBookedTimes(index + 1)"
        >
          <time>{{time}}</time>
        </button>
        <div class="u-textCenter">
          <button
            v-if="timeIsBooked === true"
            @click="removeBooking()"
            class="Button Button--large Button--altRedColor u-marginTlg"
          >Avboka tid</button>
          <button
            v-else-if="selectedDate !== '' && selectedTime !== ''"
            @click="newBooking()"
            class="Button Button--large u-marginTlg"
          >Boka tid</button>
          <button v-else class="Button Button--large Button--disabled u-marginTlg" disabled>Boka tid</button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import moment from "moment";
import "moment/locale/sv";
import regeneratorRuntime from "regenerator-runtime";
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
      unformattedData: [],
      formattedData: [],
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
      bookingInfo: { selectedDate: "", selectedTime: "", apartmentNumber: "" },
      clickedUser: {},
      activeDateIndex: undefined,
      activeTimeIndex: undefined,
      timeIsBooked: false,
      booked: false
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
    this.getAllUsers();
    console.log(this.getCookie("username"));
  },
  methods: {
    getCookie: function(cname) {
      const name = cname + "=";
      const decodedCookie = decodeURIComponent(document.cookie);
      const ca = decodedCookie.split(";");
      for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    },
    checkUserBookingDate: function(date) {
      const apartmentNumber = this.getCookie("username");
      const bookings = this.formattedData;
      if (bookings.hasOwnProperty(date)) {
        for (let i = 0; i < bookings[date].length; i++) {
          if (apartmentNumber === bookings[date][i].apartmentNumber) {
            //console.log("lägg på grön färg");
            return true;
          }
        }
      }
    },
    checkUserBookingTime: function(slot) {
      const time = "tid" + slot;
      const date = this.selectedDate;
      const bookings = this.formattedData;
      const apartmentNumber = this.getCookie("username");

      if (bookings.hasOwnProperty(date) === true) {
        for (let i = 0; i < bookings[date].length; i++) {
          if (
            time === bookings[date][i].bookingTime &&
            apartmentNumber === bookings[date][i].apartmentNumber
          ) {
            //console.log("Grön FÄRG TILL ALLA");
            return true;
          }
        }
      }
    },
    addMonth: function() {
      this.dateContext = moment(this.dateContext).add(1, "month");
      this.activeDateIndex = undefined;
    },
    subtractMonth: function() {
      this.dateContext = moment(this.dateContext).subtract(1, "month");
      this.activeDateIndex = undefined;
    },
    checkIfFullyBooked: function(date) {
      const bookings = this.formattedData;

      if (bookings.hasOwnProperty(date) === false) {
        // console.log(false);
        // console.log(date);
      } else if (
        bookings.hasOwnProperty(date) === true &&
        this.formattedData[date].length >= 5
      ) {
        // console.log(true);
        // console.log(date);
        return true;
      }
    },
    checkBookedTimes(slot) {
      const time = "tid" + slot;
      const date = this.selectedDate;
      const bookings = this.formattedData;

      if (bookings.hasOwnProperty(date) === false) {
        // console.log(false);
        // console.log(date);
      } else if (bookings.hasOwnProperty(date) === true) {
        //console.log(bookings[date][0]);
        for (let i = 0; i < bookings[date].length; i++) {
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
      this.timeIsBooked = false;
      //console.log(this.selectedDate);
    },
    selectTime: function(time) {
      this.selectedTime = "tid" + time;
      this.bookingInfo = {
        selectedDate: this.selectedDate,
        selectedTime: "tid" + time,
        apartmentNumber: this.$parent.loggedInUser
      };
      // console.log(this.selectedTime);
      // console.log(this.groupBy(app.bookings, "bookingDate"));
    },
    newBooking: async function() {
      let users = this.unformattedData;

      for (let i = 0; i < users.length; i++) {
        console.log(users[i].apartmentNumber);
        if (users[i].apartmentNumber == "1003") {
          console.log("true");
          await this.deleteBooking();
        }
      }
      this.saveBooking();
      this.getAllUsers();
      this.selectedDate = "";
      if (this.booked === true) {
        this.booked = false;
      }
      this.booked = true;
    },
    removeBooking: async function() {
      this.deleteBooking();
      this.selectedTime = "";
      this.activeTimeIndex = undefined;
      this.timeIsBooked = false;
      this.getAllUsers();
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
        .then(response => {
          if (response.data.error) {
            app.errorMessage = response.data.message;
          } else {
            console.log(response.data.bookings);
            this.formattedData = this.groupBy(
              response.data.bookings,
              "bookingDate"
            );
            this.unformattedData = response.data.bookings;
            console.log(this.formattedData);
          }
        });
    },

    saveBooking: function() {
      const formData = this.toFormData(this.bookingInfo);
      axios
        .post("http://mikahl.se/VuePHP/api.php?action=create", formData)
        .then(function(response) {
          //console.log(response);
          if (response.data.error) {
            app.errorMessage = response.data.message;
          } else {
            app.successMessage = response.data.message;
          }
        });
    },
    deleteBooking: function() {
      const formData = this.toFormData(this.bookingInfo);
      console.log(formData);
      axios
        .post("http://mikahl.se/VuePHP/api.php?action=delete", formData)
        .then(function(response) {
          console.log(response);
          //app.clickedUser = {};
          if (response.data.error) {
            app.errorMessage = response.data.message;
          } else {
            app.successMessage = response.data.message;
          }
        });
    },
    toFormData: function(obj) {
      console.log(obj);
      const form_data = new FormData();
      for (let key in obj) {
        form_data.append(key, obj[key]);
      }
      console.log(form_data);
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
    },
    cancelBooking: function(time, index) {
      if (
        this.selectDate !== "" &&
        this.activeTimeIndex === index &&
        this.checkUserBookingTime(index + 1)
      ) {
        this.timeIsBooked = true;
      } else if ((this.timeIsBooked = true)) {
        this.timeIsBooked = false;
      }
    }
  }
};
</script>
