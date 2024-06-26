<template>
    <div style="text-align: left;">
        <b-breadcrumb :items="breadcrumb"></b-breadcrumb>
            <b>Category:</b> {{ $route.params.category }}
            <br />
            <b-form @submit="onSubmit" @reset="onReset">
                <b-form-group
                    id="input-group-1"
                    label="Email address:"
                    label-for="input-1"
                    description=""
                >
                    <b-form-input
                    id="input-1"
                    v-model="email"
                    type="email"
                    placeholder="Enter email"
                    required
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
                    <b-form-input
                    id="input-2"
                    v-model="name"
                    placeholder="Enter name"
                    required
                    ></b-form-input>
                </b-form-group>
                <b-button type="submit" variant="primary">Save</b-button>&nbsp;
            </b-form>
            <b-card class="mt-3" header="Form Data Result">
            <pre class="m-0">{{ name }} {{ email }}</pre>
        </b-card>
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
            this.$api
                .post("/feedback/api/?action=categories",{
                    'category' : this.$route.params.category,
                    'name': this.name,
                    'email': this.email
                })
                .then(() => {
                    this.$router.push({ name: 'category_list', params:{ id: this.$route.params.category} });
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
                text: 'Emails of '  + this.$route.params.category,
                href: '/feedback/#/admin/categories/' + this.$route.params.category
            },{
                text: 'New',
                href: '#',
                active: true
            }],
            name: '',
            email: ''    
        }
    },
    created() {
    }
}
</script>
