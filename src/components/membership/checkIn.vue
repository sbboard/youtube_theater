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
                    currentVidTime: this.$store.state.currentTime
                }
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
