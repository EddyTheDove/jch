import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    strict: true,
    state: {
        currency: {}
    },

    mutations: {
        SET_CURRENCY (state, currency) {
            state.currency = currency
        }
    }
})
