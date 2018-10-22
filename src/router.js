import Vue from "vue"
import Router from "vue-router"
import Chat from "./components/chat/chatRoom.vue"
import onlineNow from "./components/membership/onlineList.vue"
import Register from "./components/membership/Register.vue"

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
    }
  ]
});