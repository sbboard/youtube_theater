import Vue from 'vue';
import Vuex from 'vuex';
import { youtubeAPI } from "./config.js"
import VueCookies from 'vue-cookies'

Vue.use(Vuex);
Vue.use(require('vue-cookies'))
Vue.use(VueCookies)

export const store = new Vuex.Store({
    state:{
        username: "",
        room: "1",
        youtube: youtubeAPI,
        hitLimit: false,
        listGirth: 0,
        queueSize: 0,
        currentTime : 0,
        vidTitle: "placeholder"
    }
});