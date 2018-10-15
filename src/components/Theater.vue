<template>
    <div>
        <youtube :video-id="videoId" player-width="100%"></youtube>
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
    }
}
</script>

<style lang="sass" scoped>
</style>
