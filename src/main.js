import Vue from 'vue'
import App from './App.vue'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import VueYouTubeEmbed from 'vue-youtube-embed'

import {store} from './store.js';
import router from './router.js';

Vue.use(VueYouTubeEmbed)
Vue.use(Vuetify)

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')