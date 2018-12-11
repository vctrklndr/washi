<template>
  <section class="Section Section--contain">
    <div>
      <h1 class="Heading Heading--h1 Heading-line">Boka tvättid</h1>
    </div>
    <div class="Grid u-marginTlg">
      <div class="Grid-cell u-md-size6of10">
        <div class="Calendar--daysHeading">
          <div class="Calendar-header">
            <span
              v-if="month !== initialMonth || year !== initialYear"
              @click="subtractMonth"
              class="Calendar-controls"
            >&lt; Föregående</span>
            <span v-else>&nbsp;</span>
            <time
              class="Calendar-selectedDate"
            >{{month.charAt(0).toUpperCase() + month.slice(1) + ' - ' + year}}</time>
            <span 
              @click="addMonth"
              class="Calendar-controls"
            >Nästa &gt;</span>
          </div>
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
          <button
            class="Calendar-day Calendar-day--noDate"
            v-for="blank in firstDayOfMonth"
            :key="blank.id"
            disabled
          ></button>
          <button
            v-for="date in daysInMonth"
            @click="selectDate(date)"
            :key="date.id"
            :class="{
              'Calendar-day--today':
                date === initialDate && 
                month === initialMonth &&
                year === initialYear,
              'Calendar-day--before': 
                date < today.format('D') &&
                month === today.format('MMMM') &&
                year === today.format('YYYY')
            }"
            class="Calendar-day"
          >
            <div class="Calendar-day-content">
              <div class="Calendar-dayNumber">{{date}}</div>
            </div>
          </button>
        </div>
      </div>
      <div class="Calendar--times Grid-cell u-md-size4of10">
        <div class="Calendar-header">
          <time
            class="Calendar-selectedDate"
          >{{displayDate.charAt(0).toUpperCase() + displayDate.slice(1)}}</time>
        </div>
        <button
          v-for="(time, index) in times"
          :key="time.id"
          class="Calendar-time"
          @click="selectTime(index + 1)"
        >
          <time>{{time}}</time>
        </button>
        <div style="display: flex; justify-content: center;">
          <button
            v-if="selectedDate !== '' && selectedTime !== ''"
            @click="bookTime(selectedDate, selectedTime)"
            class="Button u-marginTlg"
          >Boka tid</button>
          <button
            v-else
            @click="bookTime(selectedDate, selectedTime)"
            class="Button Button--disabled u-marginTlg"
            disabled
          >Boka tid</button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import moment from "moment";
import 'moment/locale/sv';
moment.updateLocale('sv', {
  week: {
    dow: 1,
  },
})
export default {
  data() {
    return {
      today: moment(),
      dateContext: moment(),
      displayDate: moment().format('dddd' +' D ' + 'MMMM'),
      days: ['M', 'T', 'O', 'T', 'F', 'L', 'S'],
      times: ['06.00 – 09.00', '09.00 – 12.00', '12.00 – 15.00', '15.00 – 18.00', '18.00 – 21.00'],
      selectedDate: '',
      selectedTime: ''
    }
  },
  computed: {
    year: function () {
      return this.dateContext.format('Y');
    },
    month: function () {
      return this.dateContext.format('MMMM');
    },
    dayOfMonth: function() {
      return this.dateContext.format('D');
    },
    daysInMonth: function () {
      return this.dateContext.daysInMonth('D');
    },
    currentDate: function () {
      return this.dateContext.get('D');
    },
    firstDayOfMonth: function () {
      const firstDay = moment(this.dateContext).subtract((this.currentDate - 1), 'days');
      return firstDay.weekday();
    },
    initialDate: function () {
      return this.today.get('D');
    },
    initialMonth: function () {
      return this.today.format('MMMM');
    },
    initialYear: function () {
      return this.today.format('Y');
    },
    isDisable: function (date) {
      if(date !== this.initialDate) {
        return true;
      } return false;
    }
  },
  methods: {
    addMonth: function () {
      this.dateContext = moment(this.dateContext).add(1, 'month');
    },
    subtractMonth: function () {
      this.dateContext = moment(this.dateContext).subtract(1, 'month');
    },
    selectDate: function (date){
      const month = this.dateContext.format('MMMM');
      const year = this.dateContext.format('YYYY');
      const day = moment(year + month + date).format('YYYY-MM-DD');

      this.selectedDate = day;
      this.selectedTime = '';
      this.displayDate = moment(year + month + date).format('dddd' +' D ' + 'MMMM');
      console.log(this.selectedDate);
      console.log(this.isActive);
    },
    selectTime: function(time){      
      this.selectedTime = "tid" + time;
      console.log(this.selectedTime);
    },
    bookTime: function(date, time){
      if(date !== "" && time !== "") {
        console.log(date,time)
      }
      return null;
    }
  }
}

</script>
