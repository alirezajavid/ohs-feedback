<template>
    <div>
        <b-breadcrumb :items="breadcrumb"></b-breadcrumb>

        <h3 style="text-align: left;margin:5px">Email Receiver Configuration</h3>
        <b-table striped hover :items="items" :fields="fields" caption="Email Receiver Configuration Table">
            <template #cell(id)="data">
                {{ data.index + 1 }}
            </template>
            <template #cell(action)="data">
                <b-button 
                    variant="outline-primary" 
                    @click="update(data)">Update</b-button>
            </template>
        </b-table>
                
    </div>
</template>

<script>
import axios from 'axios'
export default {
  methods: {
    update(v) {
        this.$router.push({ name: 'update_category', params:{id: v.item.value} });
        console.log(v.item.value)
    }
  },
  data () {
    return {
        breadcrumb:[{
                text: 'Admin',
                href: '/#/admin/'
            },{
                text: 'Categories',
                href: '/#/admin/categories',
                active: true
            }],
        items:[],
        fields: [{key:'id',label:'#'},{ key:'value', label:'Category'}, 'name', 'email','action'],
    }
  },
    created() {
        axios
            .get("/feedback/api/?action=categories")
            .then(resp => {
                this.items = resp.data.categories
            })
    }
}
</script>
