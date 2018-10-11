<template>
  <div id="app">
    <Chat/>
    <ProjFooter/>
  </div>
</template>

<script>
import Chat from './components/chat/Chat'
import ProjFooter from './components/Footer'
import Register from './components/Register'

export default {
  name: 'app',
  components: {
    Chat,
    ProjFooter,
    Register
  }
}
</script>

<style>
</style>