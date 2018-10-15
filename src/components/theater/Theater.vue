<template>
    <div>
        <youtube :video-id="videoId" player-width="100%" player-height="100%" id="youtTubeVid"></youtube>
    </div>
</template>

<script>
export default {
    name: "theater",
    data(){
        return{
            videoId: "02gys42cYmk"
        }
    },
    created(){
            this.videoId= "02gys42cYmk"
    }
}
</script>

<style lang="sass" scoped>
#youtTubeVid
    height: 100%
</style>
