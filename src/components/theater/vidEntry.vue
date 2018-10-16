<template>
    <div>
        <div v-if="this.$store.state.username!=''">
            <input type="text" v-model="vidEntered" /><button @click="submitVid()">submit</button>
        </div>
        <div v-else>
            <input type="text" placeholder="login or register to submit a video" disabled/><button disabled>submit</button>
        </div>
        Current Vid Limit: {{timeLimit/60}} minutes. {{error}}
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
            vidCreator: "",
            error: "",
            timeLimit: 480 //8 minutes
        }
    },
    methods:{
        submitVid(){
            this.vidId = getIdFromURL(this.vidEntered)
            this.vidEntered = ""
            //get info from youtube
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
                //checks for an hour mark in return
                if(this.vidLength.includes("H")){
                    this.error="Video is too long!"
                    console.log(this.error)
                }
                else{
                    let seconds = 0
                    let minutes = 0
                    let numCache = 0
                    let timeArray = this.vidLength.split('')
                    this.vidLength = 0
                    //return through time array
                    for(var i=0;i<=timeArray.length;i++){
                        //if you found the minute
                        if(!isNaN(timeArray[i])){
                            numCache += timeArray[i]   
                        }
                        if(timeArray[i]=="M"){
                            minutes = parseInt(numCache) * 60
                            numCache = 0
                        }
                        if(timeArray[i]=="S"){
                            seconds = numCache
                            numCache = 0
                        }
                        this.vidLength = minutes + parseInt(seconds)
                    } // end for loop
                    if(this.vidLength > this.timeLimit){
                        this.error="Video is too long!"
                        console.log(this.error)
                    }
                    else{
                        this.enterData(this.vidLength,this.vidName,this.vidCreator)
                    }
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        enterData(vidLength,vidName,vidCreator){
            //put info into database
            axios.get(this.$store.state.apiLocation + "/getVideoInfo.php",
            {
                params:{
                    vidId: this.vidId,
                    vidLength: vidLength,
                    vidName: vidName,
                    vidCreator: vidCreator,
                    username: this.$store.state.username
                }
            })
            .then(response => {
                if(response.data=="success"){
                    this.error= this.vidName + " added to queue"
                }
                else{
                    console.log(response.data)
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
