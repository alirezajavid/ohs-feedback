<template>
    <div style="text-align: left;">
        <b-breadcrumb :items="breadcrumb"></b-breadcrumb>
        <b-link href="#"  @click="goBack()">Back</b-link><br />
            <b>Category:</b> {{ item.value }}
            <b-form @submit="onSubmit" @reset="onReset">
                <b-form-group
                    id="input-group-1"
                    label="Email address:"
                    label-for="input-1"
                    description=""
                >
                    <b-form-input
                    id="input-1"
                    v-model="item.email"
                    type="email"
                    placeholder="Enter email"
                    required
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
                    <b-form-input
                    id="input-2"
                    v-model="item.name"
                    placeholder="Enter name"
                    required
                    ></b-form-input>
                </b-form-group>


                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
            <b-card class="mt-3" header="Form Data Result">
            <pre class="m-0">{{ item }}</pre>
        </b-card>
    </div>
</template>

<script>
import axios from 'axios'
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
            axios
                .get("/feedback/api/?action=categories")
                .then(resp => {
                    let a = resp.data.categories.filter(i=> i.value == id)
                    this.item = Array.isArray(a) ? a[0] : {}
                })
        },
        goBack() {
            this.$router.push({ name: 'categories'});
        }
    },
    data () {
        return {
            breadcrumb:[{
                text: 'Admin',
                href: '/#/admin/'
            },{
                text: 'Categories',
                href: '/#/admin/categories'
            },{
                text: 'Update',
                href: '#',
                active: true
            }],
            item:{}    
        }
    },
    created() {
        this.fetchConfig(this.$route.params.id)
    }
}
</script>
