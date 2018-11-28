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
import colors from 'vuetify/es5/util/colors'

Vue.use(Vuelidate)
Vue.use(VueYouTubeEmbed)

Vue.use(Vuetify, {
  theme: {
    primary: colors.yellow, // #E53935
    accent: colors.yellow // #3F51B5
  }
})

Vue.directive('bottom-line', {
  bind(el,binding,vnode){
    el.style.borderTop = "2px solid #3B3B3B"
  }
})

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')