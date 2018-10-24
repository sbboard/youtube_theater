<template>
    <div>
        <youtube :video-id="videoId" @ended="ended" :player-vars="playerVars" player-width="100%" player-height="100%" id="youtTubeVid"></youtube>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "theater",
    data(){
        return{
            videoId: "",
            playerVars: {
                'autoplay': 1,
                'controls': 0, 
                'disablekb': 1,
                'fs': 1,
                'modestbranding': 1
            }
        }
    },
    created(){
            //get vid Info
            axios.get(this.$store.state.apiLocation + '/getCurrentVid.php',
            {
                params:{
                    room: this.$store.state.room
                }
            })
            .then(response => {
                console.log(response.data)
                if(response.data==""){
                    this.videoId= "EzKImzjwGyM"
                }
                else{
                    this.videoId = response.data.currentVid
                }
            })
            .catch(error => {
                console.log(error);
            })
    },
    methods: {
        ready (event) {
            this.player = event.player
        },
        ended(){
            console.log("it's over")
        }
    }
}
</script>

<style lang="sass" scoped>
#youtTubeVid
    height: 100%
</style>
