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
                    this.$store.state.killed = response.data
                }
                else{
                    this.$store.state.killed = false
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
