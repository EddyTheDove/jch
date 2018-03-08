<template lang="html">
    <div class="_order">
        <h3 class="bold">Personal Details</h3>
        <span class="primary pointer" @click="previous">
            <i class="ion-chevron-left"></i> Edit car details
        </span>

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
                        <span v-show="errors.has('lastname')" class="has-error">{{ errors.first('lastname') }}</span>
                    </div>
                </div>
            </div>

            <!-- Contacts  -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email"
                            name="email"
                            class="form-control input-lg input-white"
                            placeholder="e.g: johndoe@email.com"
                            v-validate="'required|email'"
                            v-model="user.email">
                        <span v-show="errors.has('email')" class="has-error">{{ errors.first('email') }}</span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Mobile *</label>
                        <input type="text"
                            name="mobile"
                            class="form-control input-lg input-white"
                            placeholder="e.g: 0422 334 455"
                            v-validate="'required'"
                            v-model="user.mobile">
                        <span v-show="errors.has('mobile')" class="has-error">{{ errors.first('mobile') }}</span>
                    </div>
                </div>
            </div>
            <!-- End of contacts  -->


            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text"
                            name="address"
                            class="form-control input-lg input-white"
                            placeholder="e.g: 23 Jump St"
                            v-validate="'required'"
                            v-model="user.address">
                            <span v-show="errors.has('address')" class="has-error">{{ errors.first('address') }}</span>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Suburb</label>
                        <input type="text"
                            name="suburb"
                            class="form-control input-lg input-white"
                            placeholder="e.g: Liverpool"
                            v-validate="'required'"
                            v-model="user.suburb">
                            <span v-show="errors.has('suburb')" class="has-error">{{ errors.first('suburb') }}</span>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control input-lg input-white" name="state" v-model="user.state">
                            <option v-for="s in states" :value="s">{{ s }}</option>
                        </select>
                        <!-- <input type="text"
                            name="state"
                            class="form-control input-lg input-white"
                            placeholder="e.g: NSW"
                            v-validate="'required'"
                            v-model="user.state">
                            <span v-show="errors.has('state')" class="has-error">{{ errors.first('state') }}</span> -->
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Postcode</label>
                        <input type="text"
                            name="postcode"
                            class="form-control input-lg input-white"
                            placeholder="e.g: 2000"
                            v-validate="'required'"
                            v-model="user.postcode">
                            <span v-show="errors.has('postcode')" class="has-error">{{ errors.first('postcode') }}</span>
                    </div>
                </div>
            </div>
            <!-- End of address  -->
        </form>

        <div class="order-btns mt-40">
            <z-btn elevated class="mr-10" @clicked="nextStep()">
                <i class="ion-checkmark"></i>
                Confirm Personal Details
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
        user: {
            state: 'NSW'
        },
        states: ['ACT', 'NSW', 'NT', 'QLD', 'SA', 'TAS', 'VIC', 'WA']
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
        },

        showSample () {
            this.$emit('showSample')
        }
    }
}
</script>
