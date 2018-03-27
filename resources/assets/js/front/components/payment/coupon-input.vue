<template lang="html">
  <input type="hidden" name="coupon" :value="coupon.name">
</template>

<script>
import { mapState } from 'vuex'

export default {
    name: 'coupon-input',
    computed: mapState(['coupon'])
}
</script>

<style lang="css">
</style>
