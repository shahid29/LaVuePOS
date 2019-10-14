<template>
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Register A New Account</div>
        <div class="card-body">
            <form @submit.prevent="signup">
                <div class="form-group">
                    <div class="form-label-group">
                        <input v-model="form.name" type="text" name="name" id="inputName" class="form-control" placeholder="Full Name"  autofocus="autofocus">
                        <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                        <label for="inputName">Full Name</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input v-model="form.email" type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address"  autofocus="autofocus">
                        <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                        <label for="inputEmail">Email address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input v-model="form.password" type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" >
                        <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input v-model="form.password_confirmation" type="password" name="confirmation_password" id="inputPassword2" class="form-control" placeholder="Re-type Password">
                        <small class="text-danger" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</small>
                        <label for="inputPassword2">Confirm Password</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            <div class="text-center">
                <router-link to="/" class="d-block small mt-3" >Already Have an Account</router-link>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "register",

        data(){
          return{
              form:{
                  name:null,
                  email:null,
                  password:null,
                  password_confirmation:null,
              },
              errors:{}
          }
        },

        methods:{
            signup(){
                axios.post('/api/auth/signup',this.form)
                    .then(res=>{User.responseAfterLogin(res)
                        Toast.fire({
                            type: 'success',
                            title: 'Signed in successfully'
                        })
                        this.$router.push({name:'/home'})
                    })
                    .catch(error=>this.errors=error.response.data.errors)

            }
        },
        created(){
            if(User.loggedIn()){
                this.$router.push({name:'/home'})
            }
        },
    }
</script>

<style scoped>

</style>
