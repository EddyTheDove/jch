<template lang="html">
    <div class="_radios-group _radios-vertical pb-20">
        <div class="_radio _radio-lg"
            v-for="r in reports"
            @click="selectType(r)"
            :class="{'_radio-checked': isSelected(r) }">
            <div class="_radio-text">
                <span class="_radio-label">
                    <i class="ion-chevron-right" v-if="isSelected(r)"></i>
                    {{ r.name }}
                </span>
                <span class="_radio-value"> {{ r.amount | currency(rate) }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ReportTypes',
    props: ['reports', 'report'],

    computed: {
        currency () {
            return this.$store.state.currency
        },

        rate () {
            return this.currency.rate
        }
    },

    methods: {
        isSelected (r) {
            return this.report.id === r.id
        },

        selectType (r) {
            this.$emit('selected', r)
        }
    }
}
</script>
