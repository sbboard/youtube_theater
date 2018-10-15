<template>
  <div id="chatbox">
    <getMessages/>
  </div>
</template>

<script>
import getMessages from './getMessages'

export default {
  name: 'ChatClient',
  components: {
    getMessages
  }
}
</script>

<style lang="sass" scoped>
</style>
