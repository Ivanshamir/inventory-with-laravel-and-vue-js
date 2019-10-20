<template>
    <div>
        <div class="row">
            <div class="col-md-12"> 
            <div class="card mx-auto mt-5">
            <div class="card-header">
                Update Stock
                <router-link to="/stock" class="btn btn-info " style="float:right">All Stock </router-link>
                </div>
            <div class="card-body">
                <form @submit.prevent="stockUpdate" > <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fullName">Product Quantity</label>
                            <input class="form-control" id="fullName" type="text" v-model="form.product_quantity">
                            <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                        </div>
                    </div>
                </div>
    
                <button class="btn btn-primary " type="submit">Update</button>
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

            axios.get('/api/product/'+id)
            .then(( {data} ) => (this.form = data))
            .catch(console.log('error'))

        
        },
        data(){
            return{
                form:{
                    product_quantity:''
                },
                errors: {}
            }
        },
        methods:{
            stockUpdate(){
                let id = this.$route.params.id;
                axios.post('/api/product/stockupdate/'+id, this.form)
                .then(() => {
                    this.$router.push({ name: 'stock' })
                    Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
