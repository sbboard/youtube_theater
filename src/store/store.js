import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        username: "",
        room: "1",
        apiLocation: "http://localhost/youtube_theater/api/checkin.php"
    }
});