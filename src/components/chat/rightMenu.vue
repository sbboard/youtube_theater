<template>
    <div id="menuBoy" class="text-md-center">
        Hello {{this.$store.getters.getUsername}}!
        <v-btn to="/">Chat</v-btn>
        <v-btn to="/onlineNow">Online Now</v-btn>
        <v-btn d-inline-block @click.prevent="submitLogout()">Logout</v-btn>
        <checkin/>
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
            this.$store.commit('setUsername','')
            this.loginPass=""
            this.loginName=""
        }
    }
}
</script>

<style lang="sass" scoped>
</style>
