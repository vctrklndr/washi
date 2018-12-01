<template>
  <div class="Calendar">
    <div class="Calendar-Header">
      <span @click="subtractMonth"> Vänster </span>
      <h4>{{month + ' - ' + year}}</h4>
      <span @click="addMonth">Höger</span>
    </div>
    <ul class="List">
      <li v-for="day in days" :key="day.id"> {{day}} </li>
    </ul>
    <ul class="List">
      <li v-for="blank in firstDayOfMonth" :key="blank.id">&nbsp;</li>
      <li
        v-for="date in daysInMonth"
        :class="{'current-day': date == initialDate &amp;&amp; month == initialMonth && year == initialYear}"
        :key="date.id"
      >
        {{ date }}
      </li>
    </ul>
  </div>
</template>

<script>
import moment from "moment";

export default {
  data(){
    return{
        today: moment(),
        dateContext: moment(),
        days: ['S', 'M', 'T', 'W', 'T', 'F', 'S']
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
        return this.dateContext.daysInMonth();
    },
    currentDate: function () {
        return this.dateContext.get('date');
    },
    firstDayOfMonth: function () {
        const firstDay = moment(this.dateContext).subtract((this.currentDate - 1), 'days');
        return firstDay.weekday();
    },
    initialDate: function () {
        return this.today.get('date');
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
//function  = () => {}
</script>
