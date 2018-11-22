<template>
<v-app id="app">
    <div v-if="this.$store.state.username == ''">YOUTUBE THEATER WOW</div>
    <template v-if="this.$store.state.username != ''">
      <Room id="room"/>
    </template>
    <template v-else-if="registerClick == false">
      <login/>
      <span @click="()=>registerClick=!registerClick">Regiser</span>
    </template>
    <template v-else-if="registerClick == true">
      <register/>
      <span @click="()=>registerClick=!registerClick">Back to Login</span>
    </template>
</v-app>
</template>

<script>
import axios from 'axios'
import onlineList from './components/membership/onlineList'
import Room from './components/Rooms'
import Register from './components/membership/Register'
import login from './components/membership/Login'

export default {
  name: 'app',
  data(){
    return{
      registerClick: false
    }
  },
  components: {
    login,
    Room,
    Register
  },
  mounted(){
    if(this.$cookies.isKey('username')){
      this.$store.state.username = this.$cookies.get('username')
      const params = new URLSearchParams();
      params.append('username', "");
      params.append('room', this.$store.state.room);
      params.append('msg', this.$cookies.get('username')+" has entered the room");
      var headers = {
        "Access-Control-Allow-Origin" : "*",
        "Access-Control-Allow-Methods" : "GET,POST,PUT,DELETE,OPTIONS",
        "Access-Control-Allow-Headers": "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"
      }
      axios.post(process.env.VUE_APP_GFAPI + '/postMsg.php',params,headers)
      .catch(error => {
        console.log(error);
      })
    }
  }
}
</script>

<style lang="sass" scoped>
#room
  height: 100vh
</style>