<template>
    <div class="mx-4">
        <template v-if="this.$store.getters.getVidID != this.$store.getters.getPlaceholder">
        <v-layout row>
            <v-flex xs8>
            {{this.$store.getters.getCurrentVid}} 
            </v-flex>
            <v-flex xs4 class="text-xs-right">
            <v-btn v-if="this.$store.getters.getVoted == false" @click="vote('downvote')">VOTE TO SKIP</v-btn>
            <v-btn v-if="this.$store.getters.getVoted == true" @click="vote('fix')">VOTED TO SKIP</v-btn>
            {{this.$store.getters.getTotalDownvotes}} / {{Math.ceil(this.$store.getters.getTotalUsers/2)}}
            </v-flex>
        </v-layout>
        </template>
        <v-layout row wrap v-if="this.$store.getters.getUsername!=''">
            <v-flex xs12>
                <v-layout row wrap>
                    <template v-if="this.$store.getters.getQueueSize < queueMax">
                        <v-flex xs10>
                            <v-text-field type="text" 
                            label="Submit a YouTube Video"
                            v-model="vidEntered" @blur="$v.vidEntered.$touch()" />
                        </v-flex>
                        <v-flex xs2 class="text-xs-center">
                            <v-btn
                            @click="submitVid()" :disabled="$v.$invalid">submit</v-btn>
                        </v-flex>
                    </template>
                    <template v-else>
                    <v-flex xs10>
                        <v-text-field type="text" label="Queue is Full" disabled/>
                    </v-flex>
                    <v-flex xs2>
                        <v-btn
                            class="mx-auto"
                            disabled>submit</v-btn>
                    </v-flex>
                    </template>
                </v-layout>
            </v-flex>
        </v-layout>
        <v-alert :value="true" type="warning" v-if="$v.$error && vidEntered.length > 0">
            Must be a youtube video
        </v-alert>
        Current Time Limit: {{timeLimit/60}} minutes. {{error}}<br/>
        Video Queue: {{this.$store.getters.getQueueSize}}/{{queueMax}} <span v-if="this.$store.getters.getQueueSize == queueMax">(full)</span>
    </div>
</template>

<script>
import { getIdFromURL } from 'vue-youtube-embed'
import { required, url, } from 'vuelidate/lib/validators'
import axios from 'axios'

const checkTube = (value) => value.indexOf('youtube.com') >= 0 || value.indexOf('youtu.be') >= 0
var ErrorClear

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
            timeLimit: 30 * 60,
            queueMax: 10
        }
    },
    watch:{
        error: function(){
            clearTimeout(ErrorClear)
            this.killError()
        }
    },
    validations() {
        return{
            vidEntered: {
                required,
                url,
                checkTube
            }
        }
    },
    methods:{
        vote(direction){
            axios.get(process.env.VUE_APP_GFAPI + '/downvote.php',
            {
                params:{
                    instructions: direction
                }
            })
            .then(response => {
                this.$store.commit('setVoted',response.data)
            })
            .catch(error => {
            })
        },
        killError(){         
            var self = this;
            ErrorClear =setTimeout(function(){self.error = "";}, 5000);
        },
        submitVid(){
            this.vidId = getIdFromURL(this.vidEntered)
            this.vidEntered = ""
            //get info from youtube
            axios.get(this.$store.getters.getYouTubeAPI,
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
                    }
                    else{
                        this.enterData(this.vidLength,this.vidName,this.vidCreator)
                    }
                }
            })
            .catch(error => {
                console.log(error);
                this.error = "Not a proper youtube video"
            })
        },
        enterData(vidLength,vidName,vidCreator){
            //put info into database
            axios.get(process.env.VUE_APP_GFAPI + "/getVideoInfo.php",
            {
                params:{
                    vidId: this.vidId,
                    vidLength: vidLength,
                    vidName: vidName,
                    vidCreator: vidCreator,
                    username: this.$store.getters.getUsername
                }
            })
            .then(response => {
                if(response.data=="success"){
                    this.error= this.vidName + " added to queue"
                }
                else{
                    this.error=response.data
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        queueCheck: function(){           
            setInterval(function(){
            axios.get(process.env.VUE_APP_GFAPI + '/getQueueSize.php',
            {
                params:{
                    room: this.$store.getters.getRoom
                }
            })
            .then(response =>{
                this.$store.commit('setQueueSize',response.data)
            })
            .catch(error => {
                console.log(error);
            })
            }.bind(this), 500);
        }
    },
    created(){
        this.queueCheck() 
    }
}
</script>

<style lang="sass" scoped>

</style>
