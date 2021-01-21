<template>
        <form @submit.prevent="handleSubmit">
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                <div class="col-md-6 ermsg">
                     <input type="text" v-model="formData.email" name="email" value="" v-on:input="$v.formData.email.$touch" class="form-control" :class="{ 'input--error': $v.formData.email.$error}"/>
                    <div v-if="$v.formData.email.$error">
		              <div class="form-error" v-if="!$v.formData.email.required">Email is required</div>       
		              <div class="form-error" v-if="!$v.formData.email.email">Enter valid email</div>       
		            </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                <div class="col-md-6 ermsg">
                    <input id="password" type="password" class="form-control" v-model="formData.password" name="password" autocomplete="current-password">
                     <div v-if="submitted && $v.formData.password.$error">
	                  <div class="form-error" v-if="submitted && !$v.formData.password.required">Password is required</div>       
	                </div>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary formsubmit">
                        Login
                    </button>
                </div>
            </div>
        </form>
</template>
<script>
import { required, email, numeric,minLength, maxLength, sameAs, requiredIf } from "vuelidate/lib/validators";
    export default {
        data() {
            return { 
              user: {},   
              formData:{        
                email:'',
                password:'',
              },
              submitted:false,
            }
        },
        created() {           
            //
        },
        validations(){
          return { 
            formData:{       
                email:{required,email}, 
                password:{required},    
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
                this.axios.post('/laraveltest/api/login',this.formData)
                .then((response) => {
                    this.user = response.data.data;
                    localStorage.setItem('access_token', response.data.data['access_token']);
                  
                    //console.log(response.data.data['access_token'])
                });
              }  
           },
        }
    }
</script>
