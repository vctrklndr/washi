import LoginComponent from "./components/Login.vue";
import Home from './User/components/Home.vue';
import Calendar from './User/components/Calendar.vue';
import Help from './User/components/Help.vue';
import Rules from './User/components/Rules.vue';
import Washing from './User/components/Washing.vue';

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
