import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    strict: true,
    state: {
        currency: {},
        total: 0,
        coupon: {}
    },

    mutations: {
        SET_CURRENCY (state, currency) {
            state.currency = currency
        },

        SET_TOTAL (state, total) {
            state.total = total
        },

        SET_COUPON (state, coupon) {
            state.coupon = coupon
        }
    }
})
