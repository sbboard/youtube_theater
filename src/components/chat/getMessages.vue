<template>
    <div>
        <p class="bladerunner">All those moments will be lost in time, like tears in rain.</p>
        <table>
            <tr v-for="(value, key) in chatLog.chatlog" :key=key>
                <td class="nameField">{{chatLog.chatlog[key].username}}</td>
                <td class="msgField">{{chatLog.chatlog[key].message}}</td>
                <td class="datefield">{{chatLog.chatlog[key].time}}</td>
            </tr>
        </table>
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
            axios.get(this.$store.state.apiLocation + '/text.php',
            {
                params:{
                    room: this.$store.state.room
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
    table
        width: 100%
        .nameField
            font-weight: 800
        .msgField
        .datefield
            text-align: right
</style>
