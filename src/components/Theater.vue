<template>
    <div>
        <youtube :video-id="videoId" player-width="100%" :player-height="desiredHeight"></youtube>
    </div>
</template>

<script>
export default {
    name: "theater",
    data(){
        return{
            videoId: "02gys42cYmk",
            desiredHeight: 0
        }
    },
    created(){
            this.videoId= "02gys42cYmk"
            this.desiredHeight= document.getElementById('chatRoom').clientHeight
    }
}
</script>

<style lang="sass" scoped>
</style>
