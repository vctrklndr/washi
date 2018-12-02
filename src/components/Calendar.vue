<template>
  <div>
    <div class="Calendar Calendar-Header">
      <span @click="subtractMonth"><</span>
      <h4>{{month + ' - ' + year}}</h4>
      <span @click="addMonth">></span>
    </div>
    <ul class="Calendar List">
      <li v-for="day in days" :key="day.id">{{day}}</li>
      <li v-for="blank in firstDayOfMonth" :key="blank.id">&nbsp;</li>
      <li
        v-for="date in daysInMonth"
        :class="{'Calendar-currentDay': 
          date === initialDate &&
          month === initialMonth && 
          year === initialYear}"
        :key="date.id"
      >{{ date }}</li>
    </ul>
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
    return{
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
    addMonth: function () {
        this.dateContext = moment(this.dateContext).add(1, 'month');
    },
    subtractMonth: function () {
        this.dateContext = moment(this.dateContext).subtract(1, 'month');
    }
  }
}
</script>
