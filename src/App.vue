<template>
<v-app id="app">
    <Room/>
    <ProjFooter/>
</v-app>
</template>

<script>
import Room from './components/Rooms'
import ProjFooter from './components/Footer'
import Register from './components/Register'

export default {
  name: 'app',
  components: {
    Room,
    ProjFooter,
    Register
  }
}
</script>

<style>
</style>