import Calendar from './components/Calendar.vue';
import Help from './components/Help.vue';
import Home from './components/Home.vue';
import Rules from './components/Rules.vue';
import Washing from './components/Washing.vue';

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
  },
  {
    path: '/regler',
    component: Rules
  },
  {
    path: '/tvattrad',
    component: Washing
  }
]