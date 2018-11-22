<template>
<v-app id="app">
    <div v-if="this.$store.state.username == ''">YOUTUBE THEATER WOW</div>
    <!-- display room if logged in -->
    <template v-if="this.$store.state.username != ''">
      <Room id="room"/>
    </template>

    <!-- display log in/register options -->
    <template v-else-if="currentMenu == 'cookie'">
      Use YouTube Theater as {{this.$cookies.get('username')}}?
      <span @click="checkOnline">yes</span>   ...   <span @click="logout">no</span>
    </template>

    <!-- display log in/register options -->
    <template v-else-if="currentMenu == 'login'">
      <login/>
      <span @click="()=>currentMenu='register'">Register</span>
    </template>
    
    <!-- login page -->
    <template v-else-if="currentMenu == 'register'">
      <register/>
      <span @click="()=>currentMenu='login'">Back to Login</span>
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
      currentMenu: "login"
    }
  },
  components: {
    login,
    Room,
    Register
  },
  mounted(){
      if(this.$cookies.isKey('username')){
        this.currentMenu='cookie'
      }
  },
  methods:{
    logged(){
      if(this.$cookies.isKey('username')){
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
    },
    logout(){
        this.$cookies.remove('username')
        this.currentMenu='login'
    },
    checkOnline(){
        axios.get(process.env.VUE_APP_GFAPI + '/onlineCheck.php',{
        params: {
            room: this.$store.state.room
        }})
        .then(response => {
          var badBoy = false
          var i
          for(i=0;i<response.data.online.length;i++){
            if(response.data.online[i].username == this.$cookies.get('username')){
              badBoy = true;
            }
          }
          if(badBoy == true){
            console.log('already logged in');
          }
          else{
            this.$store.state.username = this.$cookies.get('username')
            this.logged()
          }
        })
        .catch(error => {
            console.log(error);
        })}
  }
}
</script>

<style lang="sass" scoped>
#room
  height: 100vh
</style>