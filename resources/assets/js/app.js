
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

import Vue from 'vue'

import App from './App.vue'

import router from './router'

Vue.component('vue-table', require('./components/dashboard/VueTable.vue'))

const app = new Vue({
  router,
  mode: 'history',
  render: h => h(App)
}).$mount('#app')
