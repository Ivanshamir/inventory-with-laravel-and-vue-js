<template>
    <div>
        <div class="row">
            <div class="col-md-12"> 
            <div class="card mx-auto mt-5">
            <div class="card-header">
                Insert Supplier
                <router-link to="/supplier" class="btn btn-info " style="float:right">All Supplier</router-link>
                </div>
            <div class="card-body">
                <form @submit.prevent="supplierInsert" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input class="form-control" id="fullName" type="text" v-model="form.name">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input class="form-control" id="email" type="email" v-model="form.email">
                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control" id="address" type="text" v-model="form.address">
                            <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary">Phone</label>
                            <input class="form-control" id="phone" type="text" v-model="form.phone">
                            <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Shop Name</label>
                            <input class="form-control" id="shopname" type="text" v-model="form.shopname">
                            <small class="text-danger" v-if="errors.shopname">{{ errors.shopname[0] }}</small>
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
        },
        data(){
            return{
                form:{
                    name: '',
                    email: '',
                    phone: '',
                    address: '',
                    photo: '',
                    shopname: ''
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
                        this.form.photo = event.target.result;
                        // console.log(event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            },
            supplierInsert(){
                axios.post('/api/supplier', this.form)
                .then(() => {
                    this.$router.push({ name: 'supplier' })
                    Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
