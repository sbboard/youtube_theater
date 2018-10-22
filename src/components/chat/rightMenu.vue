<template>
    <div>
        <!--Playlist
        Chat
        Online Now-->
        <!--<login/>-->
        <router-link to="/register">Register</router-link>
        <checkin v-if="this.$store.state.username!=''"/>
    </div>
</template>

<script>
import login from '../membership/Login'
import checkin from '../membership/checkIn'

export default {
    name:"RightMenu",
    components: {
        login,
        checkin
    }
}
</script>

<style lang="sass" scoped>

</style>
