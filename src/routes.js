import Calendar from './components/Calendar.vue';
import Help from './components/Help.vue';
import Home from './components/Home.vue';

export default [
  {
    path: '/',
    component: Home
  },
  {
    path: '/boka',
    component: Calendar
  },
  {
    path: '/hjalp',
    component: Help
  }
]