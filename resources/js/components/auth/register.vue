<template>
    <div>
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Confirm Password">
                </div>
                <button class="btn btn-primary btn-block" type="submit">Login</button>
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
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
