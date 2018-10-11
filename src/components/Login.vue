<template>
    <div>
        <div v-if="this.$store.state.username==''">
            <form onsubmit="return false;">
            Login:
            <input type='text' required v-model='loginName'/>
            Password:{{this.$store.state.username}}
            <input type='password' v-model='loginPass' required/>
            <button @click="submitRegister()">Send</button>
            </form>
        </div>
        <div v-else>
            Hello {{this.$store.state.username}}!
        </div>
    </div>
</template>

<script>
export default {
    name: 'login',
    data(){
        return{
            loginPass:"",
            loginName:""
        }
    }
}
</script>

<style lang="sass">

</style>
