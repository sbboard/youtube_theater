import Vue from 'vue'
import App from './App.vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import VueYouTubeEmbed from 'vue-youtube-embed'
Vue.use(VueYouTubeEmbed)

Vue.use(Vuetify);

Vue.config.productionTip = false

import {store} from './store/store.js';

new Vue({
  store,
  render: h => h(App)
}).$mount('#app')