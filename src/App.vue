<template>
  <div id="app">
    <Room/>
    <ProjFooter/>
  </div>
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