import Vue from 'vue'
import App from './App.vue'
//plugins
import Vuetify from 'vuetify'
import VueYouTubeEmbed from 'vue-youtube-embed'
import Vuelidate from 'vuelidate'
//js files
import {store} from './store.js';
import router from './router.js';
//css
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuelidate)
Vue.use(VueYouTubeEmbed)
Vue.use(Vuetify)

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')