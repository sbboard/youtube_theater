<template>
    <div>
        <getMessages id="chatRoom"/>
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
  }
}
</script>

<style lang="sass" scoped>
#rightMenu
    padding: 1em 0
#chatRoom
  background-color: red
  height: calc(100vh - 7em)
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
