<template>
    <div class="user-poll-vote">
        <form @submit.prevent="handleSubmit">
            <div v-for="poll in polls" :key="poll.id">
                <strong> {{ poll.question }}</strong>
                <div class="ermsg"  v-for="list in poll.option" :key="list.id">
                    <input type="radio" v-model="formData.answer[poll.id]" class="form-check-input" :value="list.id" :id="poll.id" :name="'answer['+poll.id+']'" />
                    <label for="answer">
                      &nbsp;  {{ list.name }}
                    </label>
                    <div style="clear:both;height:2px;"></div>
                </div>
                <div v-if="submitted && $v.formData.answer.$error">
                  <div class="form-error" v-if="submitted && !$v.formData.answer.required">Field is required</div>       
                </div>
            </div>
            <button class="btn btn-primary btn-block" >Submit</button>
        </form>
   </div>
</template>
<script>
import { required, email, numeric,minLength, maxLength, sameAs, requiredIf } from "vuelidate/lib/validators";
    export default {
        data() {
            return { 
              polls: {},   
              formData:{        
                answer:[]   
              },
              submitted:false,
            }
        },
        created() {           
            this.axios.get('/laraveltest/api/get-polls')
                .then((response) => {
                    this.polls = response.data.data;
                    console.log(response.data)
                });
        },
        validations(){
          return { 
                formData:{       
                    answer:{required},    
                },
        } 
      },
        methods: {
            handleSubmit(e) {
              this.submitted = true;          
              this.$v.formData.$touch();  
              if (this.$v.formData.$invalid) {
                this.submitStatus = "ERROR";            
              } else {
                this.axios.post('/laraveltest/api/update-user-polls-vote',this.formData,
                  { 
                    headers: {
                      Authorization: 'Bearer ' 
                    }
                })
                .then((response) => {
                    this.polls = response.data.data;
                    console.log(response.data)
                });
              }  
           },
        }
    }
</script>
