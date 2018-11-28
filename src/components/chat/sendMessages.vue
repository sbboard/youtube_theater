<template>
<v-layout class="mx-4" row wrap>
        <v-flex xs12>
    <form onsubmit="return false;">
        <v-layout row wrap>
        <v-flex xs10>
            <v-text-field
            label="Message"
            v-model="msg"/>
        </v-flex>
        <v-flex xs2 class="text-xs-center">
            <v-btn 
            @click="sendMsg" :disabled="msg.length<1">Send</v-btn>
        </v-flex>
        </v-layout>
    </form>
        </v-flex>
</v-layout>
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
            axios.post(process.env.VUE_APP_GFAPI + '/postMsg.php',params,headers)
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
