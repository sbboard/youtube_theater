<template>
    <div id="menuBoy" class="text-md-center">
        Hello {{this.$store.state.username}}!
        <v-btn to="/">Chat</v-btn>
        <v-btn to="/onlineNow">Online Now</v-btn>
        <template v-if="this.$store.state.username!=''">
            <v-btn d-inline-block @click.prevent="submitLogout()">Logout</v-btn>
        </template>
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
    },
    methods: {
        submitLogout(){
            this.$cookies.remove('username')
            this.$store.state.username=""
            this.loginPass=""
            this.loginName=""
        }
    }
}
</script>

<style lang="sass" scoped>
</style>
