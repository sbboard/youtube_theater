<template>
    <div>
        <p class="bladerunner">All those moments will be lost in time, like tears in rain.</p>
        <span v-if="firstTime < 1">Loading...</span>
        <table>
            <tr v-box-shadow v-for="(value, key) in chatLog.chatlog" :key=key>
                <td class="nameField">{{chatLog.chatlog[key].username}}</td>
                <td class="msgField" v-html="chatLog.chatlog[key].message"></td>
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
            axios.get(process.env.VUE_APP_GFAPI + '/text.php',
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
        padding-top: 1em
    table
        width: 100%
        .nameField
            font-weight: 800
        .msgField
        .datefield
            text-align: right
tr:nth-of-type(1)
    opacity: .10
tr:nth-of-type(2)
    opacity: .20
tr:nth-of-type(3)
    opacity: .30
tr:nth-of-type(4)
    opacity: .40
tr:nth-of-type(5)
    opacity: .50
tr:nth-of-type(6)
    opacity: .60
tr:nth-of-type(7)
    opacity: .70
tr:nth-of-type(8)
    opacity: .80
tr:nth-of-type(9)
    opacity: .90
    
</style>
