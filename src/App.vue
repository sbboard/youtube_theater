<template>
<v-app id="app">
    <template v-if="this.$store.state.username != ''">
      <Room id="room"/>
    </template>
    <template v-else>
      <login/>
      Regiser
    </template>
</v-app>
</template>

<script>
import onlineList from './components/membership/onlineList'
import Room from './components/Rooms'
import Register from './components/membership/Register'
import login from './components/membership/Login'

export default {
  name: 'app',
  components: {
    login,
    Room
  }
}
</script>

<style lang="sass" scoped>
#room
  height: 100vh
</style>