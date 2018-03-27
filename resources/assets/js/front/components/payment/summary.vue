<template lang="html">
    <div class="_block _block-radius _block-grey elevated">
        <div class="_block-title">
            ORDER SUMMARY
        </div>

        <div class="pl-20 pb-20">
            <div>{{ report.name }}</div>
            <div class="fw-500">Amount: ${{ report.amount }} AUD</div>

            <div class="" v-show="coupon.name">
                <div >Discount: {{ discount }}</div>
            </div>

            <h5 class="fw-600 mt-20">Total: ${{ total }} AUD</h5>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    data () {
        return {
            report: {}
        }
    },

    mounted () {
        this.report = _report
        this.$store.commit('SET_TOTAL', this.report.amount)
    },

    computed: {
        discount () {
            if (this.coupon.value) {
                if (this.coupon.type ===  'percentage') {
                    return this.coupon.value + '%'
                } else {
                    return '$' + this.coupon.value + ' AUD'
                }
            }
            return 0
        },
        ...mapState(['total', 'coupon'])
    }

}
</script>
