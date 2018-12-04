<template>
  <div class="Calendar Grid-cell u-md-size6of10">
    <div class="Calendar-header">
      <div class="Calendar-controls">
        <span @click="subtractMonth"><</span>
        <time class="Calendar-selectedDate">{{month + ' - ' + year}}</time>
        <span @click="addMonth">></span>
      </div>
    </div>
    <button
      class="Calendar-day Calendar-day--noDate"
      v-for="blank in firstDayOfMonth"
      :key="blank.id"
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
    <button
      class="Calendar-day Calendar-day--noDate"
      v-for="blank in lastDayOfMonth"
      :key="blank.id"
    >
      <div class="Calendar-day-content">
        <div class="Calendar-dayNumber">&nbsp;</div>
      </div>
    </button>
  </div>
</template>

<script>
import moment from "moment";
moment.updateLocale('en', {
  week: {
    dow: 1,
  },
})

export default {
  data() {
    return {
      today: moment(),
      dateContext: moment(),
      days: ['Mån', 'Tis', 'Ons', 'Tors', 'Fre', 'Lör', 'Sön']
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
      return this.dateContext.daysInMonth('hej');
    },
    currentDate: function () {
      return this.dateContext.get('D');
    },
    firstDayOfMonth: function () {
      const firstDay = moment(this.dateContext).subtract((this.currentDate - 1), 'days');
      return firstDay.weekday();
    },
    lastDayOfMonth: function () {
      const lastDay = moment(this.dateContext).subtract((this.daysInMonth - this.daysInMonth), 'days');
      return lastDay.weekday();
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
