<template>
<v-layout row>
    <v-flex xs8>
    <Theater/>
    </v-flex>
    <v-flex xs4>
    <Chat/>
    </v-flex>
</v-layout>
</template>

<script>
import Chat from './chat/Chat'
import Theater from './Theater'
import axios from 'axios'

export default {
    name: "room",
    components: {
        Chat,
        Theater
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