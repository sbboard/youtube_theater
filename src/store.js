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
        vidID: "XqAX-xIFomw",
        killed: false,
        placeholder: "XqAX-xIFomw",
        voted: false,
        currentVid: "",
        totalUsers: 0,
        totalDownvotes: 0
    },
    getters:{
        getYouTubeAPI: state=> {
            return state.youtube
        },
        getUsername: state=> {
            return state.username
        },
        getRoom: state=> {
            return state.room
        },
        getCurrentTime: state=> {
            return state.currentTime
        },
        getVidID: state=> {
            return state.vidID
        },
        getPlaceholder: state=> {
            return state.placeholder
        },
        getCurrentVid: state=> {
            return state.currentVid
        },
        getKilled: state=> {
            return state.killed
        },
        getTotalDownvotes: state=> {
            return state.totalDownvotes
        },
        getVoted: state=> {
            return state.voted
        },
        getQueueSize: state=> {
            return state.queueSize
        },
        getTotalUsers: state=> {
            return state.totalUsers
        }
    },
    mutations: {
        setUsername(state,n){
            state.username = n
        },
        setKill(state,n){
            state.killed = n
        },
        setDownvotes(state,n){
            state.totalDownvotes = n
        },
        setTotalUsers(state,n){
            state.totalUsers = n
        },
        setVoted(state,n){
            state.voted = n
        },
        setCurrentVid(state,n){
            state.currentVid = n
        },
        setVidID(state,n){
            state.vidID = n
        },
        setQueueSize(state,n){
            state.queueSize = n
        }
    }
});