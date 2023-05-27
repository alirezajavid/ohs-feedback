<template>
  <b-container>
    <div  class="m-4" style="text-align:left">
      <div style="text-align:center">
        <img src="../assets/logoheader.png" class="img-fluid w-50 w-md-50" />
      </div>
      <div class="mt-5">
        <p>
          CHB Project appreciates the feedback and
          input from everyone to have a positive work
          environment where everyone is appreciated,
          You Say Matters!!!
        </p>
      </div>
      <div table-responsive-lg>
      <table class="table table-sm">
        <tr>
          <td style="width:300px;">
            <label class="form-check-label" for="switchToggle">Would you like feedback?</label>  
          </td>
          <td  class="form-check form-switch text-center">
              <input class="form-check-input" type="checkbox" id="switchToggle" checked>
          </td>
        </tr>
      </table>
      </div>
    <div class="mt-3">
      <b-row class="my-1">
        <b-col sm="2" lg="1">
          <label for="input-small">Name</label>
        </b-col>
        <b-col sm="10" lg="5">
          <b-form-input id="input-small" size="sm"  v-model="name"></b-form-input>
        </b-col>
      </b-row>

      <b-row class="my-1">
        <b-col sm="2" lg="1">
          <label for="input-small">Email</label>
        </b-col>
        <b-col sm="10" lg="5">
          <b-form-input id="input-small" size="sm" type="email" v-model="email"></b-form-input>
        </b-col>
      </b-row>

      <b-row class="my-1">
        <b-col sm="2" lg="1">
          <label for="input-small">Mobile</label>
        </b-col>
        <b-col sm="10" lg="5">
          <b-form-input id="input-small" size="sm" type="number" v-model="mobile" ></b-form-input>
        </b-col>
      </b-row>
    </div>

    <div class="mt-3 " style="text-align:center">
        <b-button  class="w-50" variant="secondary" @click="nextPage()">Next</b-button>
      </div>

    </div>
  </b-container>
</template>

<script>
export default {
  created () {
    this.name = localStorage.getItem('name') && localStorage.getItem('name') != 'null'  ? localStorage.getItem('name') : ''
    this.email = localStorage.getItem('email') && localStorage.getItem('email') != 'null' ? localStorage.getItem('email') : ''
    this.mobile = localStorage.getItem('mobile') && localStorage.getItem('mobile') != 'null' ? localStorage.getItem('mobile') : ''
  },
  data() {
    return {
      name: '',
      email: '',
      mobile: ''
    }
  },
  methods:{
    nextPage(){
      localStorage.setItem('name', this.name)
      localStorage.setItem('email', this.email)
      localStorage.setItem('mobile', this.mobile)
      this.$router.push("/submit");
    }
  }
}
</script>
<style>
  .form-switch .form-check-input:checked {
    background-color: #167c13;
  }  
</style>