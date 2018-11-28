<template>
<v-layout row>
    <v-flex xs8 class="largeFlex">
        <Theater id="theater"/>
        <ProjFooter id="footer"/>
    </v-flex>
    <v-flex xs4 class="largeFlex">
        <rightMenu id="rightMenu"/>
        <router-view></router-view>
    </v-flex>
</v-layout>
</template>

<script>
import Theater from './theater/Theater'
import ProjFooter from './Footer'
import sendMessages from './chat/sendMessages'
import rightMenu from './chat/rightMenu'
import axios from 'axios'

export default {
    name: "room",
    components: {
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
            axios.get(process.env.VUE_APP_GFAPI + '/logMsg.php',
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
  height: calc(100% - 7em)
  overflow-y: scroll
#footer
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
  position: absolute
  bottom: 0
  width: 100%
</style>