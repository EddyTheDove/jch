<template lang="html">
    <div class="_order">
        <h3 class="bold">Car Details</h3>

        <form class="_form mt-20" @prevent.submit>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" v-tooltip="{
                            content: 'The original VIN or Chassis number used in Japan, as shown on the manufacturer build plate',
                            placement: 'top-center',
                            classes: ['info'],
                            targetClasses: ['it-has-a-tooltip']
                            }">
                            VIN or Chassis Number *
                            <i class="ion-help-circled"></i>
                        </label>

                        <input
                            type="text"
                            name="vin_chassis"
                            class="form-control input-lg input-white"
                            placeholder="e.g: BNR32-305366"
                            v-validate="'required'"
                            data-vv-as="VIN or Chassis number"
                            v-model="car.vin_chassis">
                            <span v-show="errors.has('vin_chassis')" class="has-error">{{ errors.first('vin_chassis') }}<br> </span>
                        <a href="">Where to find my VIN or Chassis number?</a>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Year of make *</label>
                        <select class="form-control input-lg input-white"
                            name="year"
                            v-validate="'required'"
                            v-model="car.year">
                            <option value="">Select Year</option>
                            <option v-for="y in years" :value="y">{{ y }}</option>
                        </select>
                        <span v-show="errors.has('year')" class="has-error">{{ errors.first('year') }}</span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Car make *</label>
                        <input type="text"
                            name="make"
                            class="form-control input-lg input-white"
                            placeholder="e.g: Nissan"
                            v-validate="'required'"
                            v-model="car.make">
                        <span v-show="errors.has('make')" class="has-error">{{ errors.first('make') }}</span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Car model *</label>
                        <input type="text"
                            name="model"
                            class="form-control input-lg input-white"
                            placeholder="e.g: Elgrand"
                            v-validate="'required'"
                            v-model="car.model">
                        <span v-show="errors.has('model')" class="has-error">{{ errors.first('model') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Original Colour from Japan</label>
                        <input type="text" class="form-control input-lg input-white" placeholder="e.g: Blue" v-model="car.colour">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Year of export from Japan</label>
                        <select class="form-control input-lg input-white" name="year" v-model="car.export_year">
                            <option value="">Select Year</option>
                            <option v-for="y in exportYears" :value="y">{{ y }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>


        <div class="order-btns mt-40">
            <z-btn elevated class="mr-10" @clicked="nextStep()">
                <i class="ion-chevron-right"></i>
                Continue with {{ report.name }}
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
    name: 'car-japan',
    props: ['report'],

    data () {
        return {
            car: {},
            years: [],
            exportYears: [],
        }
    },

    mounted () {
        this.makeYears()
        this.reinitialiseCar()
    },

    methods: {
        makeYears () {
            const year = new Date().getFullYear()
            for (let y = year; y > 1949; y--) {
                this.years.push(y)
            }

            for (let y = year; y > 2006; y--) {
                this.exportYears.push(y)
            }
        },

        reinitialiseCar () {
            this.car = {
                year: '',
                model: '',
                make: '',
                color: '',
                export_year: '',
                vin_chassis: ''
            }
        },

        showSample () {
            this.$emit('showSample')
        },

        async nextStep () {
            const result = await this.$validator.validateAll()
            if (!result) {
                return console.log('VeeValidate found some errors')
            }

            this.$emit('next', this.car)
        }
    }
}
</script>
