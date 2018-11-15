<template>
    <div>
        <!--Playlist
        Chat
        Online Now-->
        Hello {{this.$store.state.username}}!
        <router-link to="/">Chat</router-link> . 
        <router-link to="/onlineNow">Online Now</router-link> . 
        <router-link to="/register" v-if="this.$store.state.username==''">Register</router-link>
        <div v-if="this.$store.state.username!=''">
            <button @click.prevent="submitLogout()">Logout</button>
        </div>
        <!--<router-link to="/login">Login</router-link>-->
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
            this.$store.state.username=""
            this.loginPass=""
            this.loginName=""
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
