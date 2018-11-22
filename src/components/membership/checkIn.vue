<template>
    <div></div>
</template>

<script>
import axios from 'axios'
export default {
    name: "checkin",
    created(){
        this.beginCheck() 
    },
    methods: {
        beginCheck: function(){           
            setInterval(function(){
                axios.get(process.env.VUE_APP_GFAPI + '/checkin.php',
                {
                    params:{
                        username: this.$store.state.username,
                        currentVidTime: this.$store.state.currentTime,
                        currentVid: this.$store.state.vidID,
                        placeholder: this.$store.state.placeholder
                    }
                })
                .then(response => {
                    if(this.$store.state.currentVid != "XqAX-xIFomw"){
                        this.$store.state.killed = JSON.parse(response.data.killed)
                        this.$store.state.totalDownvotes = response.data.downvotes
                    }
                    else{
                        this.$store.state.killed = false
                    }
                })
                .catch(error => {
                    console.log(error);
                })
                
                axios.get(process.env.VUE_APP_GFAPI + '/onlineCheck.php',
                {
                    params:{
                        room: this.$store.state.room
                    }
                })
                .then(response => {
                    this.$store.state.totalUsers = response.data.online.length
                })
                .catch(error => {
                    console.log(error);
                })
            }.bind(this), 500);
        }
    }
}
</script>

<style lang="sass">

</style>
