<template>
    <div>
        <div id="register" v-if="success==false">
            <form @submit.prevent>
                <v-text-field 
                label="Username"
                v-model.lazy="username" 
                @blur="$v.username.$touch"
                id="usernameReg"/>
                <v-alert
                :value="!$v.username.checkSame"
                type="warning">
                    Username already taken
                </v-alert>
                <v-text-field 
                label="Password"
                v-model.lazy="password" 
                @blur="$v.password.$touch()" 
                type="password"/>
                <v-alert 
                :value="true"
                v-if="$v.password.$anyError && password.length > 0"
                type="warning">
                    password must be at least 6 characters
                </v-alert>
                <v-text-field 
                label="Confirm Password"
                v-model="passwordCheck" type="password" @input="$v.passwordCheck.$touch()"/><br/>
                <v-alert 
                v-if="$v.passwordCheck.$anyError && passwordCheck.length > 0"
                :value="true"
                type="warning">
                    passwords don't match
                </v-alert>
                <v-btn @click="submitRegister()" :disabled="$v.$invalid">Register</v-btn>
            </form>
        </div>
        <v-alert :value="errorCheck" type="warning">
            {{errorCheck}}
        </v-alert>
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
    beforeCreate() {
      if (this.$store.state.username != "") {
        this.$router.replace('/')
      }
    },
    validations:{
            username: {
                required,
                checkSame: val => {
                    return axios.get(process.env.VUE_APP_GFAPI + '/checkUsernameDupe.php',
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
                axios.post(process.env.VUE_APP_GFAPI + '/register.php',params,headers)
                .then(response => {
                    console.log(response.data);
                    if(response.data=="success"){
                        this.success=true;
                        this.$store.state.username=this.username
                        this.$router.push('/');
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
    },
}
</script>

<style lang="sass">

</style>
