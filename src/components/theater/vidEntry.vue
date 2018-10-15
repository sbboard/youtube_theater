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
            vidLength: ""
        }
    },
    methods:{
        submitVid(){
            this.vidId = getIdFromURL(this.vidEntered)
            this.vidLength = getTimeFromURL(this.vidLength)
            console.log(this.$store.state.youtube)
            axios.get(this.$store.state.youtube,
            {
                params:{
                    id: this.vidId,
                    part: 'snippet,contentDetails,statistics'
                }
            })
            .then(response => {
                console.log(response.data)
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
