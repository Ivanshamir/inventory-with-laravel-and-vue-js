<template>
    <div>
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form @submit.prevent="signup">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Enter Full Name" v-model="form.name">
                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="form.email">
                    <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" v-model="form.password">
                    <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Confirm Password" v-model="form.password_confirmation">
                </div>
                <button class="btn btn-primary btn-block" type="submit">Signup</button>
                </form>
                <div class="text-center">
                <router-link to="/" class="d-block small mt-3" >Already have an account</router-link>
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
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: {}
            }
        },
        methods:{
            signup(){
                axios.post('/api/auth/signup', this.form)
                .then(res => {
                    User.responseAfterLogin(res)
                    this.$router.push({ name: 'home'})
                    Toast.fire({
                        type: 'success',
                        title: 'Register successfully'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)

            }
        }
    }
</script>
