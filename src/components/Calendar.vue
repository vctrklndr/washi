<template>
  <section class="Section">
    <div class="Calendar" style="display: flex;">
      <ul class="List" style="display: flex; flex-wrap: wrap; margin-right: 10px;">
        <li style="
                        background: #f0f3f2;
            border: 2px solid transparent;
            border-radius: 2px;
            color: #e4e4e4;
            -ms-flex-preferred-size: 13.33333333%;
            flex-basis: 13.33333333%;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            font-family: inherit;
            font-weight: 400;
            margin: 1px;
            padding: 0;
            text-align: center;
            position: relative;"
        ></li>
        <li style="
                        background: #f0f3f2;
            border: 2px solid transparent;
            border-radius: 2px;
            color: #e4e4e4;
            -ms-flex-preferred-size: 13.33333333%;
            flex-basis: 13.33333333%;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            font-family: inherit;
            font-weight: 400;
            margin: 1px;
            padding: 0;
            text-align: center;
            position: relative;"
        ></li>
        <li style="
                        background: #f0f3f2;
            border: 2px solid transparent;
            border-radius: 2px;
            color: #e4e4e4;
            -ms-flex-preferred-size: 13.33333333%;
            flex-basis: 13.33333333%;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            font-family: inherit;
            font-weight: 400;
            margin: 1px;
            padding: 0;
            text-align: center;
            position: relative;"
        ></li>
        <li
          v-for="(date, day) in dates"
          v-bind:key="day"
          style="
            background: #f0f3f2;
            border: 2px solid transparent;
            border-radius: 2px;
            color: #e4e4e4;
            -ms-flex-preferred-size: 13.33333333%;
            flex-basis: 13.33333333%;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            font-family: inherit;
            font-weight: 400;
            margin: 1px;
            padding: 0;
            text-align: center;
            position: relative;"
        >{{ date.day }}</li>
        <li style="
            background: #f0f3f2;
            border: 2px solid transparent;
            border-radius: 2px;
            color: #e4e4e4;
            -ms-flex-preferred-size: 13.33333333%;
            flex-basis: 13.33333333%;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            font-family: inherit;
            font-weight: 400;
            margin: 1px;
            padding: 0;
            text-align: center;
            position: relative;"
        ></li>
        <li style="
            background: #f0f3f2;
            border: 2px solid transparent;
            border-radius: 2px;
            color: #e4e4e4;
            -ms-flex-preferred-size: 13.33333333%;
            flex-basis: 13.33333333%;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            font-family: inherit;
            font-weight: 400;
            margin: 1px;
            padding: 0;
            text-align: center;
            position: relative;"
        ></li>
      </ul>
      <ul class="List u-textCenter">
        <li style="width: 300px; padding: 15px; background-color: #0066ff; border-radius: 3px; color: #fafafa; margin-bottom: 1px;">Tider:</li>
        <li style="padding: 11px 0 11px 0; background-color: #eee; margin-bottom: 1px; border-radius: 3px;" v-for="(booking, book) in bookings" v-bind:key="book">{{ booking.hour }}</li>
      </ul>
    </div>
  </section>
</template>

<script>
export default {
  name: "bookings",
  name: "dates",
  data() {
    return {
      bookings: [
        { hour: "06:00 - 09:00" },
        { hour: "09:00 - 12:00" },
        { hour: "12:00 - 15:00" },
        { hour: "15:00 - 18:00" },
        { hour: "18:00 - 21:00" }
      ],
      dates: [
        { day: "1" },
        { day: "2" },
        { day: "3" },
        { day: "4" },
        { day: "5" },
        { day: "6" },
        { day: "7" },
        { day: "8" },
        { day: "9" },
        { day: "10" },
        { day: "11" },
        { day: "12" },
        { day: "13" },
        { day: "14" },
        { day: "15" },
        { day: "16" },
        { day: "17" },
        { day: "18" },
        { day: "19" },
        { day: "20" },
        { day: "21" },
        { day: "22" },
        { day: "23" },
        { day: "24" },
        { day: "25" },
        { day: "26" },
        { day: "27" },
        { day: "28" },
        { day: "29" },
        { day: "30" }
      ]
    }
  }
};
</script>
