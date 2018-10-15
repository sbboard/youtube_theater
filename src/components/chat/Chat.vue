<template>
  <div id="chatbox">
    <getMessages/>
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
#loginMsg
  display: block
  padding-top: 1em
  padding-bottom: 1em
  text-align: center
  background-color: green
</style>
