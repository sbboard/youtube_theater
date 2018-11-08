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
            initTime: "",
            firstPunch: 0,
            placeHolderVidID: "EzKImzjwGyM",
            nextVidId: "",
            playerVars: {
                'autoplay': 1,
                'controls': 0, 
                'disablekb': 1,
                'fs': 1,
                'modestbranding': 1,
                'startSeconds': 15,
                'onDefault': false
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
                if(response.data==""){
                    this.videoId= this.placeHolderVidID
                    this.onDefault = true
                }
                else{
                    this.videoId = response.data.currentVid
                    this.onDefault = false
                    if(response.data.nextVid){
                        this.nextVidId = response.data.nextVid
                    }
                    else{
                        this.nextVidId= this.placeHolderVidID
                    }
                    this.initTime = response.data.currentTime
                }
                this.DefaultCheck(this.onDefault)
            })
            .catch(error => {
                console.log(error);
            })
    },
    methods: {
        ended(){
            //start to play next vid
            axios.get(this.$store.state.apiLocation + '/nextVid.php',
            {
                params:{
                    endedVid: this.videoId
                }
            })
            .then(response => {
                //define current video
                console.log(response.data)
                if(this.nextVidId != ""){
                    console.log("1")
                    console.log(this.nextVidId)
                    this.videoId = this.nextVidId
                    if(this.nextVidId != this.placeHolderVidID){
                        this.onDefault = false
                    }
                    else{
                        this.onDefault = true
                    }
                }
                else{
                    console.log("2")
                    this.videoId = this.placeHolderVidID
                    this.player.seekTo(0, true)
                    this.onDefault = true
                }
                //define next video
                if(response.data != ""){
                    console.log("3")
                    this.nextVidId = response.data
                    this.onDefault = false
                }
                this.DefaultCheck(this.onDefault)
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
        },
        DefaultCheck(bool){
            if(bool){
                console.log(bool)
            }
            else{
                console.log(bool)
            }
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
