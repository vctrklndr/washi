import LoginComponent from "./components/Login.vue";
import Home from './components/Home.vue';
import Calendar from './components/Calendar.vue';
import Help from './components/Help.vue';
import Rules from './components/Rules.vue';
import Washing from './components/Washing.vue';

export default [
  {
    path: "/",
    redirect: {
      name: "login"
    }
  },
  {
    path: "/login",
    name: "login",
    component: LoginComponent
  },
  {
    path: "/home",
    name: "home",
    component: Home
  },
  {
    path: "/boka",
    component: Calendar
  },
  {
    path: "/hjalp",
    component: Help
  },
  {
    path: "/regler",
    component: Rules
  },
  {
    path: "/tvattrad",
    component: Washing
  }
];
