<template>
    <form onsubmit="return false;">
        <input v-model="msg"/>
        <button @click="sendMsg" :disabled="msg.length<1">Send</button>
    </form>
</template>

<script>
import axios from 'axios'

export default {
    name: "sendMessages",
    data(){
        return{
            testNum: 5,
            msg: ""
        }
    },
    methods: {
        sendMsg: function(){
            const params = new URLSearchParams();
            params.append('username', this.$store.state.username);
            params.append('room', this.$store.state.room);
            params.append('msg', this.msg);
            var headers = {
                "Access-Control-Allow-Origin" : "*",
                "Access-Control-Allow-Methods" : "GET,POST,PUT,DELETE,OPTIONS",
                "Access-Control-Allow-Headers": "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"
            }
            axios.post('http://localhost/youtube_theater/api/postMsg.php',params,headers)
            .catch(error => {
                console.log(error);
            })
            this.msg = "";
        }
    }
}
</script>

<style lang="sass">

</style>
