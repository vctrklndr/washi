<template>
  <div class="Grid u-marginTlg">
    <div class="Grid-cell u-md-size6of10">
      <div class="Calendar--daysHeading">
        <div class="Calendar-header">
          <div class="Calendar-controls">
            <span @click="subtractMonth" style="cursor: pointer;"><</span>
            <time class="Calendar-selectedDate">{{month + ' - ' + year}}</time>
            <span @click="addMonth" style="cursor: pointer;">></span>
          </div>
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
          :class="{
          'Calendar-day--today' : 
          date === initialDate &&
          month === initialMonth && 
          year === initialYear }"
          class="Calendar-day"
          :key="date.id"
        >
          <div class="Calendar-day-content">
            <div class="Calendar-dayNumber">{{date}}</div>
          </div>
        </button>
      </div>
    </div>
    <div class="Calendar--times Grid-cell u-md-size4of10">
      <div class="Calendar-header">
        <time class="Calendar-selectedDate">{{this.today.format('dddd' +' D ' + 'MMMM')}}</time>
      </div>
      <button v-for="time in times" :key="time.id" class="Calendar-time">
        <time>{{time}}</time>
      </button>
    </div>
  </div>
</template>

<script>
import moment from "moment";
moment.updateLocale('en', {
  week: {
    dow: 1,
  },
})
console.log(moment());

export default {
  data() {
    return {
      today: moment(),
      dateContext: moment(),
      days: ['M', 'T', 'O', 'T', 'F', 'L', 'S'],
      times: ['06.00 – 09.00', '09.00 – 12.00', '12.00 – 15.00', '15.00 – 18.00', '18.00 – 21.00']
    }
  },
  computed: {
    year: function () {
      return this.dateContext.format('Y');
    },
    month: function () {
      return this.dateContext.format('MMMM');
    },
    daysInMonth: function () {
      return this.dateContext.daysInMonth('ddd');
    },
    currentDate: function () {
      return this.dateContext.get('D');
    },
    firstDayOfMonth: function () {
      const firstDay = moment(this.dateContext).subtract((this.currentDate - 1), 'days');
      return firstDay.weekday();
    },
    lastDayOfMonth: function () {
      const lastDay = moment().day(0);
      const weekday = lastDay.weekday();
      return weekday;
    },
    initialDate: function () {
      return this.today.get('D');
    },
    initialMonth: function () {
      return this.today.format('MMMM');
    },
    initialYear: function () {
      return this.today.format('Y');
    }
  },
  methods: {
    update: function () {
      if(
        date === initialDate &&
        month === initialMonth && 
        year === initialYear) {
        return true;
      }
    },
    addMonth: function () {
      this.dateContext = moment(this.dateContext).add(1, 'month');
    },
    subtractMonth: function () {
      this.dateContext = moment(this.dateContext).subtract(1, 'month');
    }
  }
}
</script>
