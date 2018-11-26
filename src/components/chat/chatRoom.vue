<template>
    <div>
        <getMessages :style="{height:calcHeight}" id="chatRoom"/>
        <div id="loginMsg">
            <sendMessages v-if="this.$store.state.username!=''"/>
            <div v-else>
            Login to Participate in Chat
            </div>
        </div>
    </div>
</template>

<script>
import getMessages from './getMessages'
import sendMessages from './sendMessages'

export default {
  name: 'ChatClient',
  components: {
    getMessages,
    sendMessages
  },
  data(){
      return{
        calcHeight: 0
      }
  },
    mounted () {
        this.matchHeight()
    },
    methods: {
        matchHeight () {
            let msgHeight = document.getElementById('rightMenu').clientHeight
            let menuHeight = document.getElementById('loginMsg').clientHeight
            let windowHeight = window.innerHeight
            console.log(msgHeight + " " + menuHeight + " " + windowHeight)
            this.calcHeight = windowHeight - menuHeight - msgHeight
            this.calcHeight = this.calcHeight + "px"
            console.log(this.calcHeight)
        }
    }
}
</script>

<style lang="sass" scoped>
#rightMenu
    padding: 1em 0
#chatRoom
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
