<template>
  <div>
    <div class="Calendar Calendar-Header" style="align-items: center;">
      <span @click="subtractMonth"> < </span>
      <h4>{{month + ' - ' + year}}</h4>
      <span @click="addMonth"> > </span>
    </div>
    <ul class="Calendar List u-textCenter">
      <li v-for="day in days" :key="day.id" style="width: 60px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 3px;">
        {{day}}
      </li>
    </ul>
    <ul class="Calendar List" style="max-width: 420px;">
      <li v-for="blank in firstDayOfMonth" :key="blank.id" style="width: 60px; height: 60px;">&nbsp;</li>
      <li style="width: 60px; height: 60px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 3px; display: flex; justify-content: center; align-items: center;"
        v-for="date in daysInMonth"
        :class="{'Calendar--currentDay': date === initialDate &amp;&amp; month === initialMonth && year === initialYear}"
        :key="date.id"
      >
        {{ date }}
      </li>
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
  
  data(){
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
        return this.dateContext.daysInMonth('dddd');
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
//function  = () => {}
</script>
