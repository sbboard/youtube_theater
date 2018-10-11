<template>
    <div>
        <div v-if="document.cookie==null">
            <form onsubmit="return false;">
            Login:
            <input type='text' required v-model='loginName'/>
            Password:
            <input type='password' v-model='loginPass' required/>
            <button @click="submitRegister()">Send</button>
            </form>
        </div>
        <div v-else>
            Hello
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
