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
                        username: this.$store.getters.getUsername,
                        currentVidTime: this.$store.getters.getCurrentTime,
                        currentVid: this.$store.getters.getVidID,
                        placeholder: this.$store.getters.getPlaceholder
                    }
                })
                .then(response => {
                    if(this.$store.getters.getCurrentVid != "XqAX-xIFomw"){
                        this.$store.commit('setKill',JSON.parse(response.data.killed))
                        this.$store.commit('setDownvotes',response.data.downvotes)
                    }
                    else{
                        this.$store.commit('setKill',false)
                    }
                })
                .catch(error => {
                    console.log(error);
                })
                
                axios.get(process.env.VUE_APP_GFAPI + '/onlineCheck.php',
                {
                    params:{
                        room: this.$store.getters.getRoom
                    }
                })
                .then(response => {
                    this.$store.commit('setTotalUsers',response.data.online.length)
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
