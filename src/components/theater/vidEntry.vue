<template>
    <div>
        <div v-if="this.$store.state.username!=''">
            <input type="text" v-model="vidEntered" /><button @click="submitVid()">submit</button>
        </div>
        <div v-else>
            <input type="text" placeholder="login or register to submit a video" disabled/><button disabled>submit</button>
        </div>
    </div>
</template>

<script>
import { getIdFromURL, getTimeFromURL } from 'vue-youtube-embed'
import axios from 'axios'
export default {
    name: "vidEntry",
    data(){
        return{
            vidEntered: "",
            vidId: "",
            vidLength: "",
            vidDetails: "",
            vidName: "",
            vidCreator: ""
        }
    },
    methods:{
        submitVid(){
            this.vidId = getIdFromURL(this.vidEntered)
            this.vidLength = getTimeFromURL(this.vidLength)
            axios.get(this.$store.state.youtube,
            {
                params:{
                    id: this.vidId,
                    part: 'snippet,contentDetails'
                }
            })
            .then(response => {
                this.vidDetails = response.data
                this.vidLength = this.vidDetails.items[0].contentDetails.duration
                this.vidName = this.vidDetails.items[0].snippet.title
                this.vidCreator = this.vidDetails.items[0].snippet.channelTitle
            })
            .catch(error => {
                console.log(error);
            })

            //console.log(this.vidId + " " + this.vidLength)
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
