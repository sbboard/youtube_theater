<template>
  <div id="chatbox">
    <getMessages/>
    <sendMessages v-if="this.$store.state.username!=''"/>
    <div v-else>
      Login to Participate in Chat
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

<style scoped>
div{
  background-color: red;
}
</style>
