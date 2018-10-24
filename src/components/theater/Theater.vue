<template>
    <div>
        <youtube :video-id="videoId" @ended="ended" @playing="playing" :player-vars="playerVars" player-width="100%" player-height="100%" id="youtTubeVid"></youtube>
    </div>
</template>

<script>
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
            this.videoId= "EzKImzjwGyM"
    },
    methods: {
        ready (event) {
            this.player = event.player
        },
        playing() {
            console.log('\o/ we are watching!!!')
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
