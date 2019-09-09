<template>
    <div>
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Forget Password</div>
            <div class="card-body">
                <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Existing Email address</label>
                    <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
            
                <button class="btn btn-primary btn-block" type="submit">Forget Password</button>
                </form>
                <div class="text-center">
                <router-link to="/" class="d-block small mt-3" >Back to login</router-link>
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
