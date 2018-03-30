<template lang="html">
    <div class="_form">
        <label class="teal bold">Do you have a coupon? Apply it below.</label>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="text"
                        name="coupon" v-model="ghost.coupon"
                        placeholder="Coupon Code"
                        class="form-control input-lg text-center">
                </div>
            </div>

            <div class="col-sm-4">
                <a class="pointer btn btn-lg btn-wise"
                    style="padding:12px 30px;"
                    :class="{ disabled: isLoading }"
                    @click="getCoupon()">
                    <span v-show="!isLoading">Apply Coupon</span>
                    <span v-show="isLoading">Applying...</span>
                </a>
            </div>
        </div>


        <div class="red bold pb-10" v-show="errorMessage">
            {{ errorMessage }}
        </div>

        <div class="bold pb-10 green" v-show="couponMessage">
            {{ couponMessage }}
        </div>
    </div>
</template>

<script>
import _ from 'lodash'
import moment from 'moment'

export default {
    name: 'apply-coupon',

    data: () => ({
        ghost: {},
        report: {},
        coupon: {},
        isLoading: false,
        errorMessage: '',
        couponMessage: ''
    }),

    mounted () {
        this.report = _report
    },

    computed: {
        isExpired () {
            if (!_.isEmpty(this.coupon)) {
                return moment(this.coupon.expiry).isBefore(moment())
            }
            return false
        },

        validCoupon () {

        }
    },

    methods: {
        getCoupon () {
            if (this.ghost.coupon.length > 1) {
                this.isLoading = true
                this.reset()

                axios.get(`api/v1/coupons/${ this.ghost.coupon }`)
                .then(response => {
                    if (!_.isEmpty(response.data)) {
                        this.coupon = response.data

                        if (this.coupon.nb_use >= this.coupon.max_use) {
                            this.errorMessage = 'The specified coupon has been used to its maximum capacity'
                        } else if (this.coupon.status == 0) {
                            this.errorMessage = 'The specified coupon is invalid'
                        } else if (moment(this.coupon.expiry).isBefore(moment())) {
                            this.errorMessage = 'The specified coupon already expired'
                        } else {
                            this.applyCoupon()
                        }
                    }
                    this.isLoading = false
                })
                .catch(error => {
                    console.log(error)
                    this.isLoading = false
                    this.errorMessage = 'The specified coupon does not exist.'
                })
            }
        },


        applyCoupon () {
            let total = 0
            this.couponMessage = 'Coupon applied. You receive '

            if (this.coupon.type === 'percentage') {
                total = (this.report.amount - ((this.coupon.value * this.report.amount) / 100)).toFixed(2)
                this.couponMessage += this.coupon.value + '% OFF. New total is ' + total
            } else {
                total = (this.report.amount - this.coupon.value).toFixed(2)
                this.couponMessage += this.coupon.value + ' AUD OFF. New total is ' + total
            }

            this.$store.commit('SET_COUPON', this.coupon)
            this.$store.commit('SET_TOTAL', total)
        },

        reset () {
            this.couponMessage = ''
            this.coupon = {}
            this.errorMessage = ''
            this.$store.commit('SET_COUPON', '')
            this.$store.commit('SET_TOTAL', this.report.amount)
        }
    }
}
</script>
