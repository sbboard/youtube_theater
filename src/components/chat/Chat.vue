<template>
  <div id="chatbox">
    <getMessages/>
    <sendMessages/>
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

<style>
</style>
