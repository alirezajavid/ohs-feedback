<template>
  <b-container>
    <div class="m-4" style="text-align:left;">
      <div style="text-align:center">
        <img src="../assets/logoheader.png" class="img-fluid w-50 w-md-50" />
      </div>
      <div class="mt-5 text-center">
        <p>
          CHB Project appreciates the feedback and
          input from everyone to have a positive work
          environment where everyone is appreciated,
          You Say Matters!!!
      </p>
      </div>
      <center>
        <b-button v-if="!showDismissibleAlert" @click="onSendClick" variant="secondary"><b-icon-upload /> Send</b-button>
      </center>
      <b-alert 
        fade
        :show="showDismissibleAlert" variant="secondary">
        <div class="mt-3 text-center">
          <h4>Thankyou for your feedback</h4>
        </div>
        <div class="mt-3 text-center">
          <h4>
            We appreciate the comments and
            thoughts of everyone on our project
          </h4>
          <b-button  @click="$router.push({'name' : 'menu'})" variant="secondary"><b-icon-house /> Home</b-button>
        </div> 
      </b-alert>
    </div>
  </b-container>
</template>
<script>
import axios from 'axios'
export default {
  data() {
    return {
      showDismissibleAlert: false
    }
  },
  methods: {
    onSendClick() {
      let params = {
        name: localStorage.getItem('name'),
        email: localStorage.getItem('email'),
        mobile: localStorage.getItem('mobile'),
        category: localStorage.getItem('category'),
        comment: localStorage.getItem('comment'),
        type: localStorage.getItem('type'),
        id: localStorage.getItem('id'),
      }
      axios.post('/rules/api/?action=send', params)
        .then(
          r => {
            if (r.status == 201)
            {
              this.showDismissibleAlert = true
            }
          }
        )

    }
  }
}
</script>