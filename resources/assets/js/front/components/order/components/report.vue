<template lang="html">
    <div class="_order">
        <h3 class="bold">{{ report.name }}</h3>
        <h4><span class="bold primary">${{ report.amount }} AUD</span>  </h4>


        <div class="mt-20">
            Our BASIC Report for AUD 40 is the best option if you’re not sure where to start.

            <ul class="list-styled mt-10 ml-20">
                <li>Japanese Auction Records</li>
                <li>English translation available</li>
                <li>Ideal pre-purchase check</li>
                <li>Get your report within 24 hours</li>
                <li>Past repairs, true kms, condition, auction report, pictures, sale price</li>
            </ul>

            Reports typically include the following details for auction events in Japan:
<br>Location, date, grade (condition), sale price#, auction report & pictures
<br><br>Detailed notes on the auction report (written in Japanese) may state:
<br>Extras fitted, odometer replacements & total kms, extent & location of past repairs, repaint, rust, dents, scratches, interior & body condition
<br><br>This information is often very revealing and may be all you need to know about a vehicle, particularly if you are considering buying it. Obtaining the auction records independently is a good way to check whether a seller is telling you the truth about kms and condition or has supplied a genuine auction report (these are often digitally falsified – changing grade R (repaired) to grade 4 for example).
        </div>


        <div class="order-btns mt-40">
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
