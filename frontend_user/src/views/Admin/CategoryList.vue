<template>
    <div style="text-align: left;">
        <b-breadcrumb :items="breadcrumb"></b-breadcrumb>
        <b>Category:</b> {{ $route.params.id }}
        <br />
        <b-button 
                    variant="outline-primary" 
                    @click="addRec" >Add</b-button>
        <b-table striped hover :items="items" :fields="fields">
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
                    @click="update(data.index)">Update</b-button>
                &nbsp;&nbsp;
                <b-button 
                    variant="outline-danger" 
                    @click="deleteRec(data.index)">Delete</b-button>
            </template>
        </b-table>
    </div>
</template>

<script>
export default {
    watch: {
        '$route.params.id': function(newId) {
            this.fetchConfig(newId);
        } 
    },
    methods: {
        onReset() {},
        onSubmit() {
            this.goBack();
        },
        fetchConfig(id) {
            this.$api
                .get("/feedback/api/?action=categories")
                .then(resp => {
                    let a = resp.data.categories.filter(i=> i.value == id)
                    this.items = Array.isArray(a) ? a[0].emails : []
                })
        },
        goBack() {
            this.$router.push({ name: 'categories'});
        },
        update(v) {
            this.$router.push({ 
                name: 'category_update', 
                params:{
                    category: this.$route.params.id,
                    id: v
                } 
            });
        },
        addRec() {
            this.$router.push({ name: 'category_new', params:{ category: this.$route.params.id} });
        },
        deleteRec(v) {
            this.$api
                .delete("/feedback/api/?action=categories&category="+this.$route.params.id+"&id=" + v)
                .then(() => {
                    this.fetchConfig(this.$route.params.id);
                })
        }
    },
    data () {
        return {
            breadcrumb:[{
                text: 'Admin',
                href: '/feedback/#/admin/'
            },{
                text: 'Categories',
                href: '/feedback/#/admin/categories'
            },{
                text: 'Emails of '  + this.$route.params.id,
                href: '/feedback/#/admin/categories/' + this.$route.params.id,
                active: true
            }],
            items:[],
            fields:['name','email','action']
        }
    },
    created() {
        this.fetchConfig(this.$route.params.id)
    }
}
</script>
