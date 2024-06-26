<template>
    <div>
        <b-breadcrumb :items="breadcrumb"></b-breadcrumb>

        <h3 style="text-align: left;margin:5px">Email Receiver Configuration</h3>
        <b-table striped hover :items="items" :fields="fields" caption="Email Receiver Configuration Table">
            <template #cell(id)="data">
                {{ data.index + 1 }}
            </template>
            <template #cell(emails)="data">
                <div v-for="v,j in data.item.emails" :key="j">
                    {{ v.name }} [{{ v.email }}]
                </div>
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
export default {
  methods: {
    update(v) {
        this.$router.push({ name: 'category_list', params:{id: v.item.value} });
    }
  },
  data () {
    return {
        breadcrumb:[{
                text: 'Admin',
                href: '/feedback/#/feedback/admin/'
            },{
                text: 'Categories',
                href: '/feedback/#/admin/categories',
                active: true
            }],
        items:[],
        fields: [{key:'id',label:'#'},{ key:'value', label:'Category'}, 'emails','action'],
    }
  },
    created() {
        this.$api
            .get("/feedback/api/?action=categories")
            .then(resp => {
                this.items = resp.data.categories
            })
    }
}
</script>
