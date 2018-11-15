<template>
    <div>
      Welcome to YouTube Theater. Please login to begin.
            <form @submit.prevent>
            Login:
            <input type="text" id="username" value="peen" v-model="loginName" @blur="$v.loginName.$touch()">
            Password:
            <input type='password' v-model='loginPass' @blur="$v.loginPass.$touch()">
            <button @click="submitLogin()" :disabled="$v.$invalid">Login</button>
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
        submitLogin(){
            const params = new URLSearchParams();
            params.append('username', this.loginName);
            params.append('password', this.loginPass);
            var headers = {
                "Access-Control-Allow-Origin" : "*",
                "Access-Control-Allow-Methods" : "GET,POST,PUT,DELETE,OPTIONS",
                "Access-Control-Allow-Headers": "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"
            }
            axios.post(this.$store.state.apiLocation + '/login.php',params,headers)
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
