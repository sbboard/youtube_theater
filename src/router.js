import Vue from "vue"
import Router from "vue-router"
import Chat from "./components/chat/chatRoom.vue"
import onlineNow from "./components/membership/onlineList.vue"
import Register from "./components/membership/Register.vue"
import Login from "./components/membership/Login.vue"

Vue.use(Router);

export default new Router({
  routes: [
    {
    path: "/",
    name: "chat",
    component: Chat
    },
    {
    path: "/onlineNow",
    name: "onlineNow",
    component: onlineNow
    },
    {
    path: "/register",
    name: "register",
    component: Register
    },
    {
    path: "/login",
    name: "login",
    component: Login
    }
  ],
  scrollBehavior (to, from, savedPosition) {
    if(to.name == 'chat'){
    return { x: 0, y: 100 }
    }
  }
});