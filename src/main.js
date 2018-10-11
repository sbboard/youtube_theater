import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false

import {store} from './store/store.js';

new Vue({
  store,
  render: h => h(App)
}).$mount('#app')