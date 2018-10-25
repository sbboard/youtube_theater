<template>
    <div>
        <Chat id="chatRoom"/>
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
import Chat from './Chat'
import sendMessages from './sendMessages'

export default {
  name: 'ChatClient',
  components: {
    getMessages,
    Chat,
    sendMessages
  }
}
</script>

<style lang="sass" scoped>
</style>
