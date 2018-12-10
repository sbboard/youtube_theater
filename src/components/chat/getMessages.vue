<template>
    <div style="background-color:#212121" class="mx-2 pb-2">
        <p class="bladerunner">All those moments will be lost in time, like tears in rain.</p>
        <div v-if="firstTime < 1" class="text-xs-center w-100">Loading...</div>
        <v-layout row wrap v-for="(value, key) in chatLog.chatlog" :key=key v-bottom-line>
                <v-flex xs2 class="nameField text-xs-center">{{chatLog.chatlog[key].username}}</v-flex>
                <v-flex xs8 style="word-wrap:break-word" class="msgField" :class="{compMsg:!chatLog.chatlog[key].username}" v-html="chatLog.chatlog[key].message"></v-flex>
                <v-flex xs2 class="datefield text-xs-center">{{chatLog.chatlog[key].time}}</v-flex>
        </v-layout>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "getMessages",
    data(){
        return{
            testNum: 5,
            intervalid1:'',
            chatLog:{},
            firstTime: 0
        }
    },
    created(){
        this.getChat() 
    },
    methods: {
        getChat: function(){           
            setInterval(function(){
            axios.get(process.env.VUE_APP_GFAPI + '/text.php',
            {
                params:{
                    room: this.$store.getters.getRoom
                }
            })
            .then(response => {
                this.chatLog = response.data
            })
            .catch(error => {
                console.log(error);
            })
            if(this.firstTime < 2){
                document.getElementById("chatRoom").scrollTop = document.getElementById("chatRoom").scrollHeight
                this.firstTime++;
            }
            }.bind(this), 500);
        }
    }
}
</script>

<style lang="sass" scoped>
div
    .bladerunner
        text-align: center
        color: white
        padding-top: 1em
    .nameField
        font-weight: 800
    .msgField
        display: inline-block
    .datefield
        text-align: right
.layout:nth-of-type(1)
    opacity: .10
.layout:nth-of-type(2)
    opacity: .20
.layout:nth-of-type(3)
    opacity: .30
.layout:nth-of-type(4)
    opacity: .40
.layout:nth-of-type(5)
    opacity: .50
.layout:nth-of-type(6)
    opacity: .60
.layout:nth-of-type(7)
    opacity: .70
.layout:nth-of-type(8)
    opacity: .80
.layout:nth-of-type(9)
    opacity: .90

.compMsg
    font-weight: 800
</style>
