<template>
<v-app id="app">
    <onlineList/>
    <Room/>
    <ProjFooter/>
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

<style>
</style>