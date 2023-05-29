<template>
  <b-container>
    <div class="m-4" style="text-align:left">
      <div style="text-align:center">
        <img src="../assets/logoheader.png" class="img-fluid w-50 w-md-50" />
      </div>
      <div class="mt-5">
        <p>
          CHB Project appreciates the feedback and
          input from everyone to have a positive work
          environment where everyone is appreciated,
          Your Say Matters!!!
        </p>
      </div>
      
      <div class="mt-3" style="text-align:left">
        <b-form-group
          v-slot="{ ariaDescribedby }"
        > 
          <b-form-checkbox
            v-for="option in categories"
            v-model="selected"
            :key="option.value"
            :value="option.value"
            :aria-describedby="ariaDescribedby"
            name="flavour-3a"
          >&nbsp;
            {{ option.text }}
          </b-form-checkbox>
        </b-form-group>
      </div>

      <div class="mt-5" style="text-align:left">
        <span>
          Is your feedback positive, would you like to
          acknowledge one of the team or do you have an
          opportunity for improvement
        </span>
      </div>
      <div class="mt-3" style="text-align:left">
          <b-form-select v-model="selected_feedback" :options="types"></b-form-select>&nbsp;
          <div class="col-md-6 mt-3">
            <b-form-group
              label="Comment :"
              label-for="textarea-formatter"
              class="mb-0"
            >
            <b-form-textarea
              id="textarea-formatter"
              v-model="comment"
              placeholder=""              
              size="sm"
              rows="4"
            ></b-form-textarea>
            </b-form-group>
        </div>
        <div class="mt-3" style="text-align:center">
          <b-button class="w-50" @click="nextPage()" variant="secondary">Next</b-button>
        </div>


      </div>
    </div>
  </b-container>
</template>
<script>
import axios from 'axios'
export default {
  data() {
    return {
      comment: '',
      selected: [], 
      selected_feedback: null,
      categories:[],
      types: []
    }
  },
  created()
  {
    localStorage.removeItem('category');
    //localStorage.removeItem('comment');
    this.comment = localStorage.getItem('comment');
    localStorage.removeItem('type');
    this.loadOptions();
  },
  methods:{
    loadOptions() {
      axios
        .get('/feedback/api/?action=categories')
        .then(
          r => {
            this.categories = r.data.categories
          }
        )
      axios
        .get('/feedback/api/?action=types')
        .then(
          r => {
            this.types = r.data.types
            this.selected_feedback = this.types[0].value
          }
        )
    },
    nextPage(){
      localStorage.setItem('category', this.selected);
      localStorage.setItem('comment', this.comment);
      localStorage.setItem('type', this.selected_feedback);
      this.$router.push("/sender");
    }
  }
}
</script>

