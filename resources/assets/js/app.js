
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')
window.Vue = require('vue')
window.eventBus = new Vue()

import VeeValidate from 'vee-validate'
import VTooltip from 'v-tooltip'

Vue.use(VTooltip)
Vue.use(VeeValidate)
require('./ui')

Vue.component('new-order', require('./front/components/order/order'))

const app = new Vue({
    el: '#app'
});
