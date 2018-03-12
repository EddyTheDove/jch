<template lang="html">
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                {{ currency.name }} <i class="ion-chevron-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li v-for="c in currencies">
                    <a  @click="setCurrency(c)">{{ c.name }}</a>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
export default {
    name: 'nav-right',

    data: () => ({
        currencies: []
    }),

    mounted () {
        this.makeCurrencies()
        this.setDefaultCurrency()
    },

    computed: {
        currency () {
            return this.$store.state.currency
        }
    },

    methods: {
        setCurrency (currency) {
            this.$store.commit('SET_CURRENCY', currency)
            window.localStorage.setItem('currency', currency.name)
        },

        makeCurrencies () {
            if (typeof _rates !== 'undefined') {
                for (let k in _rates) {
                    this.currencies.push({
                        name: k,
                        rate: _rates[k]
                    })
                }
            }

            this.currencies.unshift({ name: 'AUD', rate: 1 })
        },

        setDefaultCurrency () {
            let currency = this.currencies[0]
            let currencyFromLocalStorage = localStorage.getItem('currency')
            if (currencyFromLocalStorage) {
                this.currencies.forEach(c => {
                    if (c.name === currencyFromLocalStorage) {
                        currency = c
                    }
                })
            }
            this.setCurrency(currency)
        }
    }
}
</script>
