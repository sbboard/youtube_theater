<template>
    <div>
        <login/>
        <checkin v-if="this.$store.state.username!=''"/>
    </div>
</template>

<script>
import login from './Login'
import checkin from './checkIn'

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