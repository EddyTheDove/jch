
import Vue from 'vue'

Vue.filter('number', function(value) {
    value = parseInt(value)
    return value.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
})

Vue.filter('currency', function (value, rate = 1, showCurrency = false) {
    if ( 'string' === typeof value ) {
        value = parseInt(value)
    }

    const currency = window.localStorage.getItem('currency')
    let decimals = 0

    if (currency === 'AUD'|| currency === 'USD') {
        decimals = 2
    }

    value = value * rate
    value = value.toFixed(decimals).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
    return value += showCurrency ? ' ' + currency : ''
})
