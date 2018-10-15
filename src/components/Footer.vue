<template>
    <div>
        <login/>
        <checkin v-if="this.$store.state.username!=''"/>
    </div>
</template>

<script>
import login from './membership/Login'
import checkin from './membership/checkIn'

export default {
    name:"ProjFooter",
    components: {
        login,
        checkin
    }
}
</script>

<style lang="sass">

</style>