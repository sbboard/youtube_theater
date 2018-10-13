<template>
<div>
    Old:{{oldName}} New:{{newName}}
    <Chat/>
    </div>
</template>

<script>
import Chat from './chat/Chat'
import axios from 'axios'

export default {
    name: "room",
    components: {
        Chat
    },
    data(){
        return{
            oldName:"",
            newName:""
        }
    },
    created(){
        this.$store.watch(
        (state)=>{
            return this.$store.state.username
        },
        (newValue, oldValue)=>{
            this.oldName=oldValue;
            this.newName=newValue;
            this.sendLogStatus();
        })
    },
    methods: {
        sendLogStatus(){
            axios.get('http://localhost/youtube_theater/api/logMsg.php',
            {
                params:{
                    room: this.$store.state.room,
                    newvalue: this.newName,
                    oldvalue: this.oldName
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style lang="sass">

</style>