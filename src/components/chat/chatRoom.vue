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
        calcHeight: 0,
        msgHeight: 0,
        menuHeight: 0,
        windowHeight: 0,
        windowWidth: 0
      }
  },
  created(){
            this.windowHeight = window.innerHeight
  },
  watch: {
      windowHeight(){
          this.matchHeight()
      },
      windowWidth(){
          this.matchHeight()
      }
  },
    mounted () {
        this.msgHeight = document.getElementById('rightMenu').clientHeight
        this.menuHeight = document.getElementById('loginMsg').clientHeight
        this.$nextTick(() => {
            window.addEventListener('resize', () => {
            this.windowHeight = window.innerHeight
            this.windowWidth = window.innerWidth
            this.msgHeight = document.getElementById('rightMenu').clientHeight
            this.menuHeight = document.getElementById('loginMsg').clientHeight
            this.windowHeight = window.innerHeight
        })})
        this.matchHeight()
    },
    methods: {
        matchHeight () {
            this.calcHeight = this.windowHeight - this.menuHeight - this.msgHeight
            this.calcHeight = this.calcHeight + "px"
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
