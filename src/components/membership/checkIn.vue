<template>
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
                console.log(this.$cookies.get("username"));
            axios.get(this.$store.state.apiLocation + '/checkin.php',
            {
                params:{
                    username: this.$store.state.username
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
