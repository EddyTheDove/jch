<template lang="html">
    <div class="_order">
        <h3 class="bold">{{ report.name }}</h3>
        <h4><span class="bold primary">${{ report.amount }} AUD</span>  </h4>

        <div class="_text mt-20" v-html="report.description"></div>

        <div class="order-btns mt-20">
            <z-btn elevated class="mr-10" @clicked="nextStep()">
                <i class="ion-plus"></i>
                Request {{ report.name }}
            </z-btn>

            <z-btn elevated :colour="'teal'" @clicked="showSample()">
                <i class="ion-clipboard"></i>
                Sample Report
            </z-btn>
        </div>

    </div>
</template>

<script>

export default {
    name: 'Report',
    props: ['report'],

    methods: {
        showSample () {
            this.$emit('showSample')
        },

        nextStep () {
            this.$emit('next')
        }
    }

}
</script>
