import Vue from 'vue';
import Vuex from 'vuex';
import { youtubeAPI, GFapi } from "../config.js"

Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        username: "",
        room: "1",
        apiLocation: GFapi,
        youtube: youtubeAPI,
        hitLimit: false,
        listGirth: 0
    }
});