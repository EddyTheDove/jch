<template lang="html">
    <div class="home-reports">
        <h4 class="bold">Select a type of report</h4>

        <div class="row mt-30">
            <div class="col-sm-4 col-md-3">
                <ReportTypes :reports="reports" :report="report" @selected="selectType"></ReportTypes>
            </div>


            <div class="col-sm-8 col-md-9">
                <Report :report="report" @next="showCar" v-show="step == 1"></Report>
                <JapanCar :report="report" @next="showUser" v-show="step == 2"></JapanCar>
                <UserDetails @next="showPayment" @previous="showCar" v-show="step == 3"></UserDetails>
            </div>
        </div>
    </div>
</template>

<script>
import Report from './components/report'
import JapanCar from './components/car-jp'
import UserDetails from './components/user'
import ReportTypes from './components/report-types'

export default {
    name: 'new-order',
    components: {
        Report,
        JapanCar,
        ReportTypes,
        UserDetails
    },

    data: () => ({
        reports: [],
        report: {},
        user: {},
        car: {},
        step: 1
    }),

    mounted () {
        this.getReportTypes()
    },

    methods: {
        selectType (r) {
            this.report = r
            this.step = 1
        },

        showCar () {
            this.step = 2
        },

        showUser (car) {
            this.step = 3
            this.car = car
        },

        showPayment (user) {
            this.step = 4
            this.user = user
        },

        async getReportTypes () {
            this.reports = [
                {
                    id: 'cf08c0cc-12e4-11e8-b642-0ed5f89f718b',
                    name: 'Basic Report',
                    amount: '40.00',
                    description: ''

                }, {
                    id: '14971328-12e5-11e8-b642-0ed5f89f718b',
                    name: 'Intermediate Report',
                    amount: '85.00',
                    description: ''

                }, {
                    id: '1c9839f8-12e5-11e8-b642-0ed5f89f718b',
                    name: 'Full Report',
                    amount: '110.00',
                    description: ''

                }, {
                    id: '24460590-12e5-11e8-b642-0ed5f89f718b',
                    name: 'Australian PPSR',
                    amount: '25.00',
                    description: ''
                }
            ]

            this.report = this.reports[0]
        }
    }
}
</script>
