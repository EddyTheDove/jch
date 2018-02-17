<template lang="html">
    <div class="_order">
        <h3 class="bold">Personal Details</h3>
        <span class="primary pointer" @click="previous"><i class="ion-chevron-left"></i> Edit car details</span>

        <form class="_form mt-20" @prevent.submit>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>First name *</label>
                        <input type="text"
                            name="firstname"
                            class="form-control input-lg input-white"
                            placeholder="e.g: John"
                            v-validate="'required'"
                            data-vv-as="First name"
                            v-model="user.firstname">
                        <span v-show="errors.has('firstname')" class="has-error">{{ errors.first('firstname') }}</span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Last name *</label>
                        <input type="text"
                            name="lastname"
                            class="form-control input-lg input-white"
                            placeholder="e.g: Doe"
                            v-validate="'required'"
                            data-vv-as="Last name"
                            v-model="user.lastname">
                        <span v-show="errors.has('firstname')" class="has-error">{{ errors.first('firstname') }}</span>
                    </div>
                </div>
            </div>
        </form>

        <div class="order-btns mt-40">
            <z-btn elevated class="mr-10" @clicked="nextStep()">
                <i class="ion-chevron-right"></i>
                Submit Report Request
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
    name: 'ReportTypes',

    data: () => ({
        user: {}
    }),

    methods: {
        async nextStep () {
            const result = await this.$validator.validateAll()
            if (!result) {
                return console.log('VeeValidate found some errors')
            }

            this.$emit('next', this.user)
        },

        previous () {
            this.$emit('previous')
        }
    }
}
</script>
