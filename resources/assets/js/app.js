
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import store from './front/store/store'

require('./bootstrap')
require('./filters')
window.Vue = require('vue')
window.eventBus = new Vue()

import VeeValidate from 'vee-validate'
import VTooltip from 'v-tooltip'

Vue.use(VTooltip)
Vue.use(VeeValidate)
require('./ui')

Vue.component('new-order', require('./front/components/order/order'))
Vue.component('nav-right', require('./front/components/nav/right'))

const app = new Vue({
    el: '#app',
    store
});
