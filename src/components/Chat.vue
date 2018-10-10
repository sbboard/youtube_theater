<template>
    <div>
        {{chatLog}}
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "chat",
    data(){
        return{
            testNum: 5,
            intervalid1:'',
            chatLog:{}
        }
    },
    created(){
        this.getChat()     
    },
    methods: {
        getChat: function(){           
            setInterval(function(){
            axios.get('http://localhost/youtube_theater/api/text.php')
            .then(response => {
                this.chatLog = response.data
            })
            .catch(error => {
                console.log(error);
            })
            }.bind(this), 500);
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
