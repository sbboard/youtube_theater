<template>
    <div class="mx-4">
        <h3>{{onlineList.online.length}} user<template v-if="onlineList.online.length>1">s</template> online:</h3>
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
            onlineList: {"online":[{"username":"Loading..."}]}
        }
    },
    methods: {
        checkOnline: function(){           
            setInterval(function(){
            axios.get(process.env.VUE_APP_GFAPI + '/onlineCheck.php',{
                params: {
                    room: this.$store.getters.getRoom
                }   
            })
            .then(response => {
                this.onlineList = response.data
                if(this.onlineList.online.length == ""){
                    this.onlineList = {"online":[{"username":"No one is here."}]}
                }
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
