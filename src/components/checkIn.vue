<template>
    <div>Bop</div>
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
            axios.get('http://localhost/youtube_theater/api/checkin.php',
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
