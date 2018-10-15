<template>
<v-app id="app">
    <Room id="room"/>
    <ProjFooter id="footer"/>
</v-app>
</template>

<script>
import onlineList from './components/onlineList'
import Room from './components/Rooms'
import ProjFooter from './components/Footer'
import Register from './components/Register'

export default {
  name: 'app',
  components: {
    Room,
    ProjFooter,
    Register,
    onlineList
  }
}
</script>

<style lang="sass" scoped>
#room
  height: calc(100vh - 75px)
#footer
  height: 75px
  background-color: blue
</style>
