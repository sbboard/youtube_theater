<template>
    <div>
        <div id="register" v-if="success==false">
            <div v-if="errorCheck">
                {{errorCheck}}
            </div>
            <form>
                <label>Username</label>
                <input v-model.lazy="username" @blur="$v.username.$touch()" id="username" type="text"/> <br/>
                <span v-if="$v.username.checkSame === false && username.length > 0">
                    Username already taken
                </span>
                <label>Password</label>
                <input v-model.lazy="password" @blur="$v.password.$touch()" type="password"/><br/>
                <span v-if="$v.password.$anyError && password.length > 0">
                    password must be at least 6 characters
                </span>
                <label>Confirm Password</label>
                <input v-model.lazy="passwordCheck" type="password" @blur="$v.passwordCheck.$touch()"/><br/>
                <span v-if="$v.passwordCheck.$anyError && passwordCheck.length > 0">
                    passwords don't match
                </span>
                <button @click.prevent="submitRegister()" :disabled="$v.$invalid">Register</button>
            </form>
        </div>
        <div id="success" v-else>
            You are now registered!
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { required, sameAs, minLength } from 'vuelidate/lib/validators'

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
    validations:{
            username: {
                required,
                checkSame: val => {
                    if(val.length === 0) return false
                    return axios.get('http://localhost/youtube_theater/api/checkUsernameDupe.php',
                    {
                    params:{
                        name: val
                    }
                    })
                    .then(res => {
                        return (res.data === true)? true:false
                    })
                }
            },
            password: {
                required,
                minLength: minLength(6)
            },
            passwordCheck: {
                required,
                sameAs: sameAs('password')
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
                axios.post(this.$store.state.apiLocation + '/register.php',params,headers)
                .then(response => {
                    console.log(response.data);
                    if(response.data=="success"){
                        this.success=true;
                        this.$store.state.username=this.username
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
