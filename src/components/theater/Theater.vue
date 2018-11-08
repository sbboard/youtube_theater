<template>
    <div>
        <youtube :video-id="videoId" @ended="ended" @playing="playing" :player-vars="playerVars" player-width="100%" player-height="100%" id="youtTubeVid" ref="youtube"></youtube>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "theater",
    data(){
        return{
            videoId: "",
            nextVidId: "",
            initTime: "",
            firstPunch: 0,
            placeHolderVidID: "EzKImzjwGyM",
            playerVars: {
                'autoplay': 1,
                'controls': 0, 
                'disablekb': 1,
                'fs': 1,
                'modestbranding': 1,
                'startSeconds': 15
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
                    this.videoId= this.placeHolderVidID
                }
                else{
                    this.videoId = response.data.currentVid
                    if(response.data.nextVid){
                        this.nextVidId = response.data.nextVid
                    }
                    else{
                        this.nextVidId= this.placeHolderVidID
                    }
                    this.initTime = response.data.currentTime
                }
            })
            .catch(error => {
                console.log(error);
            })
    },
    methods: {
        ended(){
            console.log("ended")
            //start to play next vid
            axios.get(this.$store.state.apiLocation + '/nextVid.php',
            {
                params:{
                    endedVid: this.videoId
                }
            })
            .then(response => {
                console.log(response.data)
                this.videoId = this.nextVidId
                if(response.data != ""){
                    this.nextVidId = response.data
                }
                else{
                    this.nextVid = this.placeHolderVidID
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        playing(){
            if(this.firstPunch < 1){
                this.player.seekTo(this.initTime, true)
                this.firstPunch++
            }
        },
        beginNextVid(){
            console.log(this.videoId)
        }
    },
    computed: {
        player() {
            return this.$refs.youtube.player
        }
    }
}
</script>

<style lang="sass" scoped>
#youtTubeVid
    height: 100%
    pointer-events: none
</style>
