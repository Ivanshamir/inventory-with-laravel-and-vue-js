<template>
    <div>
        <div class="row">
            <div class="col-md-12"> 
            <div class="card mx-auto mt-5">
            <div class="card-header">
                Update Customer
                <router-link to="/customer" class="btn btn-info " style="float:right">All Customer</router-link>
                </div>
            <div class="card-body">
                <form @submit.prevent="customerUpdate" enctype="multipart/form-data"> 
            
                 <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullName">Customer Name</label>
                            <input class="form-control" id="fullName" type="text" v-model="form.name">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="email" v-model="form.email">
                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Phone</label>
                            <input class="form-control" id="address" type="text" v-model="form.phone">
                            <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary">Address</label>
                            <input class="form-control" id="salary" type="text" v-model="form.address">
                            <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="btn btn-info" type="file" @change="onFIleSelected">
                            <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <img :src="form.photo" style="height: 40px; width: 40px">
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

            axios.get('/api/customer/'+id)
            .then(( {data} ) => (this.form = data))
            .catch(console.log('error'))
        },
        data(){
            return{
                form:{
                     name: '',
                    email: '',
                    phone: '',
                    address: '',
                    photo: '',
                    new_photo:''
                },
                errors: {}
            }
        },
        methods:{
            onFIleSelected(event){
                let file = event.target.files[0];
                
                if(file.size > 1048770){
                    Notification.image_validation();
                }else{
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.new_photo = event.target.result;
                        // console.log(event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            },
            customerUpdate(){
                let id = this.$route.params.id;
                axios.patch('/api/customer/'+id, this.form)
                .then(() => {
                    this.$router.push({ name: 'customer' })
                    Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
