<template>
    <b-container>
        <br />
        <b-card
            header="Login"
            header-text-variant="white"
            header-tag="header"
            header-bg-variant="dark"            
        >
            <b-alert :show="showAlert" variant="danger">Invalid username or password!</b-alert>
          <b-row class="my-1">
            <b-col sm="2">
              <label for="username">Username:</label>
            </b-col>
            <b-col sm="10">
              <b-form-input v-model="username" id="username" placeholder="Username"></b-form-input>
            </b-col>
          </b-row>

          <b-row class="my-1">
            <b-col sm="2">
              <label for="password">Password:</label>
            </b-col>
            <b-col sm="10">
              <b-form-input v-model="password" type="password" id="password" placeholder="Password"></b-form-input>
            </b-col>
          </b-row>
          <b-button @click="login">Login</b-button>
        </b-card>

    </b-container>
</template>

<script>
import axios from 'axios'

export default {
    data()
    {
        return {
            showAlert: false,
            username: '',
            password: ''
        }  
    },
    methods: {
        login ()
        {
            var bodyFormData = new FormData();
            bodyFormData.append('username', this.username);
            bodyFormData.append('password', this.password);
            axios
                .post("/feedback/api/?action=login", bodyFormData)
                .then(
                    r =>
                    {
                        if (r.data.loggedin) {
                            localStorage.setItem('loggedIn', true)
                            this.$router.push({ path: this.$route.query.redirect });
                        } else
                            localStorage.removeItem('loggedIn')
                    }
                )
                .catch(
                    r =>
                    {
                        this.showAlert = true
                        localStorage.removeItem('loggedIn')
                    }
                )
            
        }
    }
}
 
</script>
