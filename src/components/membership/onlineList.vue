<template>
    <div>
        <h3>Online:</h3>
        <table>
            <tr v-for="(value, key) in onlineList.online" :key=key>
                <td>{{onlineList.online[key].username}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "checkin",
    created(){
        this.checkOnline() 
    },
    data(){
        return{
            onlineList: {}
        }
    },
    methods: {
        checkOnline: function(){           
            setInterval(function(){
            axios.get(this.$store.state.apiLocation + '/onlineCheck.php',{
                params: {
                    room: this.$store.state.room
                }   
            })
            .then(response => {
                this.onlineList = response.data
            })
            .catch(error => {
                console.log(error);
            })
            }.bind(this), 500);
        }
    }
}
</script>

<style lang="sass">

</style>
