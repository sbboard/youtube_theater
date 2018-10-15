<template>
<v-app id="app">
    <Room id="room"/>
</v-app>
</template>

<script>
import onlineList from './components/onlineList'
import Room from './components/Rooms'
import Register from './components/Register'

export default {
  name: 'app',
  components: {
    Room
  }
}
</script>

<style lang="sass" scoped>
#room
  height: 100vh
</style>