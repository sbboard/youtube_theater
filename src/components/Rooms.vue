<template>
<v-layout row>
    <v-flex xs8 class="largeFlex">
        <Theater id="theater"/>
        <ProjFooter id="footer"/>
    </v-flex>
    <v-flex xs4 class="largeFlex">
        <rightMenu id="rightMenu"/>
        <Chat id="chatRoom"/>
        <div id="loginMsg">
        <sendMessages v-if="this.$store.state.username!=''"/>
        <div v-else>
        Login to Participate in Chat
        </div>
        </div>
    </v-flex>
</v-layout>
</template>

<script>
import Chat from './chat/Chat'
import Theater from './theater/Theater'
import ProjFooter from './Footer'
import sendMessages from './chat/sendMessages'
import rightMenu from './chat/rightMenu'
import axios from 'axios'

export default {
    name: "room",
    components: {
        Chat,
        ProjFooter,
        Theater,
        sendMessages,
        rightMenu
    },
    data(){
        return{
            oldName:"",
            newName:""
        }
    },
    created(){
        this.$store.watch(
        (state)=>{
            return this.$store.state.username
        },
        (newValue, oldValue)=>{
            this.oldName=oldValue;
            this.newName=newValue;
            this.sendLogStatus();
        })
    },
    methods: {
        sendLogStatus(){
            axios.get('http://localhost/youtube_theater/api/logMsg.php',
            {
                params:{
                    room: this.$store.state.room,
                    newvalue: this.newName,
                    oldvalue: this.oldName
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style lang="sass" scoped>
#rightMenu
    padding: 1em 0
#chatRoom
  background-color: red
  height: calc(100% - 7em)
  overflow-y: scroll
#footer
    background-color: blue
    width: 100%
    padding: 1em 0
    position: absolute
    bottom: 0
#theater
    background-color: black
    height: calc(100% - 3.5em)
.largeFlex
    position: relative
#loginMsg
  display: block
  padding-top: 1em
  padding-bottom: 1em
  text-align: center
  background-color: green
  position: absolute
  bottom: 0
  width: 100%
</style>