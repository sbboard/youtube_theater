<template>
    <div>
        <textarea v-model="msg"></textarea>
        <button @click="sendMsg">Send</button>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "sendMessages",
    data(){
        return{
            testNum: 5,
            tempUsername: "pauly",
            tempRoom: 1,
            msg: ""
        }
    },
    methods: {
        sendMsg: function(){
            const params = new URLSearchParams();
            params.append('username', this.tempUsername);
            params.append('room', this.tempRoom);
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
        }
    }
}
</script>

<style lang="sass">

</style>
