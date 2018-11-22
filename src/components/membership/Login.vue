<template>
    <div>
      Welcome to YouTube Theater. Please login to begin.
            <form @submit.prevent>
            Login:
            <input type="text" id="username" value="peen" v-model="loginName" @blur="$v.loginName.$touch()">
            Password:
            <input type='password' v-model='loginPass' @blur="$v.loginPass.$touch()">
            <button @click="checkOnline()" :disabled="$v.$invalid">Login</button>
            </form>
            {{loginError}}
    </div>
</template>

<script>
import axios from 'axios'
import { required } from 'vuelidate/lib/validators'

export default {
    name: 'login',
    data(){
        return{
            loginPass:"",
            loginName:"",
            loginError:""
        }
    },
    validations: {
        loginName: {
            required
        },
        loginPass: {
            required
        }
    },
    methods:{
    checkOnline(){
        axios.get(process.env.VUE_APP_GFAPI + '/onlineCheck.php',{
        params: {
            room: this.$store.state.room
        }})
        .then(response => {
          var badBoy = false
          var i
          for(i=0;i<response.data.online.length;i++){
            if(response.data.online[i].username == this.loginName){
              badBoy = true;
            }
          }
          if(badBoy == true){
            console.log('already logged in');
          }
          else{
            this.submitLogin()
          }
        })
        .catch(error => {
            console.log(error);
        })},
        submitLogin(){
            const params = new URLSearchParams();
            params.append('username', this.loginName);
            params.append('password', this.loginPass);
            var headers = {
                "Access-Control-Allow-Origin" : "*",
                "Access-Control-Allow-Methods" : "GET,POST,PUT,DELETE,OPTIONS",
                "Access-Control-Allow-Headers": "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"
            }
            axios.post(process.env.VUE_APP_GFAPI + '/login.php',params,headers)
            .then(response => {
                console.log(response.data);
                if(response.data==""){
                    this.$store.state.username=this.loginName
                    this.$cookies.set('username',this.$store.state.username);
                    if(this.$router.currentRoute.name == "register"){
                        this.$router.push('/');
                    }
                }
                else{
                    this.loginError=response.data
                    this.loginPass=""
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style lang="sass">

</style>
