<template>
    <div>
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form @submit.prevent="login">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="form.email">
                    <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" v-model="form.password">
                    <small class="text-danger" v-if="errors.email">{{ errors.password[0] }}</small>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Login</button>
                </form>
                <div class="text-center">
                <router-link to="/register" class="d-block small mt-3" >Register an Account</router-link>
                <router-link to="/forget" class="d-block small" >Forgot Password?</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created(){
            if(User.loggedIn()){
                this.$router.push({name: 'home' })
            }
        },
        data(){
            return{
                form:{
                    email: '',
                    password: ''
                },
                errors: {}
            }
        },
        methods:{
            login(){
                axios.post('/api/auth/login', this.form)
                .then(res => {
                    User.responseAfterLogin(res)
                    this.$router.push({ name: 'home'})
                    Toast.fire({
                        type: 'success',
                        title: 'Signed in successfully'
                    })
                })
                // .catch(error => )
                .catch(error => {
                    this.errors = error.response.data.errors
                    if(error.response.data.error){
                       Toast.fire({
                        type: 'error',
                        title: error.response.data.error
                    })
                    }
                })
                // .catch(
                //     Toast.fire({
                //         type: 'error',
                //         title: 'Invalid Credentials'
                //     })
                // )

            }
        },
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
