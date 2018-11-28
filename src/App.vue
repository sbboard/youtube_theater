<template>
<v-app dark id="app">
    <!-- logo -->
    <div class="text-xs-center mt-2" id="logoGuy" v-if="this.$store.state.username == ''">YouTube Theater</div>
    <!-- display room if logged in -->
    <template v-if="this.$store.state.username != ''">
      <Room id="room"/>
    </template>
  
    <!--ELSE-->
    <template v-else>
      <v-layout row class="mt-4">
        <v-flex xs4></v-flex>
      <!-- display log in/register options -->
      <v-flex xs4>
      <v-card v-if="currentMenu == 'cookie'">
        <v-container
          fluid
          grid-list-lg
        >
        <v-layout row wrap>
        <v-flex xs12 class="text-xs-center">
        Use YouTube Theater as {{this.$cookies.get('username')}}?
        </v-flex>
        <v-flex v-if="alreadyLogged == false" class="mx-auto text-xs-center">
          <v-btn @click="checkOnline">yes</v-btn><v-btn @click="logout">no</v-btn>
        </v-flex>
        <v-flex v-else xs12 class="text-xs-center">
          <v-alert
        :value="true"
        type="warning"
      >
          {{this.$cookies.get('username')}} is already logged in.
          </v-alert>
        <v-btn @click="checkOnline">retry</v-btn><v-btn @click="logout">use another account</v-btn>
        </v-flex>
        </v-layout>
        </v-container>
      </v-card>

      <!-- display log in/register options -->
      <template v-else-if="currentMenu == 'login'">
        <login/><v-btn @click="()=>currentMenu='register'">Register</v-btn>
      </template>
      
      <!-- login page -->
      <template v-else-if="currentMenu == 'register'">
        <register/>
        <v-btn @click="()=>currentMenu='login'">Back to Login</v-btn>
      </template>
      </v-flex>
        <v-flex xs4></v-flex>
      </v-layout>
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
      currentMenu: "login",
      alreadyLogged: false
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
      this.autologout()
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
            this.alreadyLogged = true
          }
          else{
            this.$store.state.username = this.$cookies.get('username')
            this.logged()
          }
        })
        .catch(error => {
            console.log(error);
        })
      },
      autologout(){
            setInterval(function(){
              
            if(this.$store.state.username == ""){
            axios.get(process.env.VUE_APP_GFAPI + '/autologout.php')
            .catch(error => {
                console.log(error);
            })
            }
            }.bind(this), 2500)
      }
  }
}
</script>

<style lang="sass" scoped>
@import url('https://fonts.googleapis.com/css?family=Montserrat')
#room
  height: 100vh
#logoGuy
  font-family: 'Montserrat', sans-serif
  font-size: 3em
  font-weight: 800
</style>