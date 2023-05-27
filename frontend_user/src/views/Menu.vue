<template>
    <div class="container">
        <b-img fluid-grow src="@/assets/critRisk.png" alt="" style="max-width: 400px;" /><br clear="all" />
        <center>

            <div v-for="item in items" :key="item.id" class="menu" @click="onClick(item.id)">
                <div class="menu2">
                    {{ item.id}}# {{ item.name }}
                </div>
            </div>
        </center>
        <img src="@/assets/logo.png"  width='100%' style="max-width: 350px;" />
    </div>
</template>

<script>
import axios from 'axios'
export default ({
    data() {
        return {
            items : []
        }
    },
    created(){
        localStorage.removeItem('id');
        this.getMenu()
    },
    methods: {
        getMenu() {
            axios.get('/rules/api/?action=menu')
                .then( r => {
                    this.items = r.data
                });
        },
        onClick(i) {
            localStorage.setItem('id', i);
            this.$router.push({path: '/feed_back'})
        }
    }
})
</script>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
    .container {
        background: url(@/assets/bg.png);
        opacity: 90%;
    }
    div{ 
        padding: 20px;
    }
    a {
        margin-top: 15px;
    }
    
    .menu {
        max-width: 450px;
        font-family: 'Anton', sans-serif;
        text-transform: uppercase;
        background-color: black;
        color: #e0e0e0;
        font-size: 24px;
        border-radius: 6px;
        padding: 2px;
        text-align: left;
        margin: 3px;
        cursor: pointer;
    }
    .menu2 {
        border: solid 2px #2a7ccd;
        border-radius: 5px;
        padding: 1px;
        padding-left: 5px;
    }

</style>