<template>
    <div>
        <div class="row">
            <div class="col-md-12"> 
            <div class="card mx-auto mt-5">
            <div class="card-header">
                Update Category
                <router-link to="/category" class="btn btn-info " style="float:right">All Category</router-link>
                </div>
            <div class="card-body">
                <form @submit.prevent="categoryUpdate">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input class="form-control" id="fullName" type="text" v-model="form.name">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                </div>
    
                <button class="btn btn-primary " type="submit">Submit</button>
                </form>
            </div>
        </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        created(){
            if(!User.loggedIn()){
                this.$router.push({name: '/' })
            }
            let id = this.$route.params.id;
            axios.get('/api/category/'+id)
            .then(( {data} ) => (this.form = data))
            .catch(console.log('error'))
        },
        data(){
            return{
                form:{
                    name: ''
                },
                errors: {}
            }
        },
        methods:{
            categoryUpdate(){
                let id = this.$route.params.id;
                axios.patch('/api/category/'+id, this.form)
                .then(() => {
                    this.$router.push({ name: 'category' })
                    Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
