<template>
    <div>
        <div v-if="this.$store.state.username==''">
            <form v-on:click.self.prevent>
            Login:
            <input type='text' required v-model.lazy='loginName'/>
            Password:{{this.$store.state.username}}
            <input type='password' v-model.lazy='loginPass' required/>
            <button @click="submitLogin()">Send</button>
            </form>
            {{loginError}}
        </div>
        <div v-else>
            Hello {{this.$store.state.username}}!
            <button @click.prevent="submitLogout()">Logout</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'login',
    data(){
        return{
            loginPass:"",
            loginName:"",
            loginError:""
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
                }
                else{
                    this.loginError=response.data
                    this.passwordCheck=""
                    this.password=""
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        submitLogout(){
            this.$store.state.username=""
            this.loginPass=""
            this.loginName=""
        }
    }
}
</script>

<style lang="sass">

</style>
