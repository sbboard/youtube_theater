<template>
    <div>
        <youtube :video-id="videoId" @ended="ended" @playing="playing" :player-vars="playerVars" player-width="100%" player-height="100%" id="youtTubeVid" ref="youtube"></youtube>
    </div>
</template>

<script>
import axios from 'axios'

var CheckQueue

export default {
    name: "theater",
    data(){
        return{
            videoId: "",
            initTime: "",
            firstPunch: 0,
            placeHolderVidID: this.$store.state.placeholder,
            nextVidId: "",
            onDefault: false,
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
    watch:{
        onDefault: function(){
            //if the default video is playing
            if(this.onDefault){
                this.runCheck()
            }
            //if it is not
            else{
                clearInterval(CheckQueue)
            }
        },
        killed(){
            if(this.$store.state.killed==true){
                console.log("KILLED")
                this.$store.state.voted = false
                this.jumpStart()
            }
        }
    },
    created(){
        this.jumpStart()
    },
    methods: {
        runCheck(){         
            var self = this;
            CheckQueue =setInterval(function(){
                if(self.$store.state.queueSize > 0){
                    self.jumpStart()
                }
            }, 500);
        },
        jumpStart(){
            //get vid Info
            axios.get(process.env.VUE_APP_GFAPI + '/getCurrentVid.php',
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
                    this.$store.state.currentVid = response.data.currentName
                    this.onDefault = false
                    if(response.data.nextVid){
                        this.nextVidId = response.data.nextVid
                    }
                    this.initTime = response.data.currentTime
                    console.log(this.initTime)
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        ended(){
            console.log("dig")
            axios.get(process.env.VUE_APP_GFAPI + '/nextVid.php',
            {
                params:{
                    endedVid: this.videoId
                }
            })
            .then(response => {
                //define current video
                //if there's a next vid in cue
                if(this.nextVidId != ""){
                    this.videoId = this.nextVidId
                    //if the new video is the placeholder
                    if(this.nextVidId != this.placeHolderVidID){
                        this.onDefault = false
                    }
                    //if the new vid is the placeholder
                    else{
                        this.onDefault = true
                    }
                }
                else{
                    this.$store.state.voted = false
                    this.videoId = this.placeHolderVidID
                    this.onDefault = true
                }
                //define next video
                if(response.data != ""){
                    this.nextVidId = response.data
                }else{
                    this.nextVidId = ""
                }
            })
            .catch(error => {
                console.log(error);
            })
            this.player.seekTo(0, true)
        },
        playing(){
            this.$store.state.vidID = this.videoId
            if(this.firstPunch < 1){
                this.player.seekTo(this.initTime, true)
                this.firstPunch++
            }
            var self = this;
            setInterval(function(){
                self.$store.state.currentTime = self.player.getCurrentTime()
            }, 500);
        }
    },
    computed: {
        player() {
            return this.$refs.youtube.player
        },
        killed() {
            return this.$store.state.killed
        }
    }
}
</script>

<style lang="sass" scoped>
#youtTubeVid
    height: 100%
    pointer-events: none
</style>
