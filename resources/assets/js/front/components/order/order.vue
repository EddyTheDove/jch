<template lang="html">
    <div class="home-reports">
        <h4 class="bold">Select a type of report</h4>

        <div class="row mt-30">
            <div class="col-sm-4 col-md-3">
                <ReportTypes :reports="reports" :report="report" @selected="selectType"></ReportTypes>
            </div>


            <div class="col-sm-8 col-md-9">
                <Report :report="report" @next="showCar" v-show="step == 1"></Report>
                <JapanCar @next="showUser" v-show="step == 2"></JapanCar>
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
        step: 1,
        token: ''
    }),

    mounted () {
        this.getReportTypes()
        const _token = document.head.querySelector('meta[name="csrf-token"]');
        this.token = _token.content
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
            this.user = user
            this.submitForm()
        },

        getReportTypes () {
            this.reports = _reports || []
            this.report = this.reports[0]

            if (_report) this.report = _report
        },

        async submitForm () {
            try {
                const response = await axios.post('/report', {
                    car: this.car,
                    user: this.user,
                    report: this.report
                })

                window.location = '/checkout'
            } catch (error) {
                console.log(error);
            }
        }
    }
}
</script>
