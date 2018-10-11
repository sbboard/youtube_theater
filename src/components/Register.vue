<template>
    <div>
        <div id="register" v-if="success==false">
            <div v-if="errorCheck">
                {{errorCheck}}
            </div>
            <form onsubmit="return false;">
                <label>Username</label>
                <input v-model="username" type="text" required/>
                <label>Password</label>
                <input v-model="password" type="password" required/>
                <label>Confirm Password</label>
                <input v-model="passwordCheck" type="password" required/>
                <button @click="submitRegister()">Send</button>
            </form>
        </div>
        <div id="success" v-else>
            You are now registered!
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name:"Register",
    data(){
        return{
            success:false,
            errorCheck:"",
            username:"",
            password:"",
            passwordCheck:""
        }
    },
    methods:{
        submitRegister: function(){
            if(this.username=="" || this.password=="" || this.passwordCheck==""){
                this.errorCheck="Please complete form"
            }
            else if(this.passwordCheck != this.password){
                this.errorCheck="Passwords don't match"
                this.passwordCheck=""
                this.password=""
            }
            else{
                const params = new URLSearchParams();
                params.append('username', this.username);
                params.append('password', this.password);
                var headers = {
                    "Access-Control-Allow-Origin" : "*",
                    "Access-Control-Allow-Methods" : "GET,POST,PUT,DELETE,OPTIONS",
                    "Access-Control-Allow-Headers": "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"
                }
                axios.post('http://localhost/youtube_theater/api/register.php',params,headers)
                .then(response => {
                    console.log(response.data);
                    if(response.data=="success"){
                        this.success=true;
                    }
                    else{
                        this.errorCheck=response.data
                        this.passwordCheck=""
                        this.password=""
                    }
                })
                .catch(error => {
                    console.log(error);
                })
                this.msg = "";
                }
        }
    }
    
}
</script>

<style lang="sass">

</style>
