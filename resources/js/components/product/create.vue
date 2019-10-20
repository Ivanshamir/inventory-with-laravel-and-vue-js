<template>
    <div>
        <div class="row">
            <div class="col-md-12"> 
            <div class="card mx-auto mt-5">
            <div class="card-header">
                Insert Product
                <router-link to="/product" class="btn btn-info " style="float:right">All Product</router-link>
                </div>
            <div class="card-body">
                <form @submit.prevent="productInsert" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label for="category">Category</label> <br>
                            <select v-model="form.category_id" class="custom-select" id="inputGroupSelect02">
                                <option :value="category.id" v-for="category in categories">{{ category.name }}</option>
                            </select>
                            <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="input-group mb-3">
                            <label for="supplier">Supplier</label> <br>
                            <select v-model="form.supplier_id" class="custom-select" id="inputGroupSelect02">
                                <option :value="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>
                            </select>
                            <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullName">Product Name</label>
                            <input class="form-control" id="fullName" type="text" v-model="form.product_name">
                            <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Product Code</label>
                            <input class="form-control" id="email" type="text" v-model="form.product_code">
                            <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Root</label>
                            <input class="form-control" id="address" type="text" v-model="form.root">
                            <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary">Buying Price</label>
                            <input class="form-control" id="salary" type="text" v-model="form.buying_price">
                            <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                         <div class="form-group">
                            <label for="nid">Selling Price</label>
                            <input class="form-control" id="nid" type="text" v-model="form.selling_price">
                            <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="form-group">
                            <label for="nid">Product Quantity</label>
                            <input class="form-control" id="nid" type="text" v-model="form.product_quantity">
                            <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date">Buying Date</label>
                            <input class="form-control" id="date" type="date" v-model="form.buying_date">
                            <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="btn btn-info" type="file" @change="onFIleSelected">
                            <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <img :src="form.image" style="height: 40px; width: 40px">
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
            axios.get('/api/category')
            .then(({data}) => (this.categories = data))
            .catch(console.log('error'))

            axios.get('/api/supplier')
            .then(({data}) => (this.suppliers = data))
            .catch(console.log('error'))
        },
        data(){
            return{
                form:{
                    category_id: '',
                    product_name: '',
                    product_code: '',
                    root: '',
                    buying_price: '',
                    selling_price: '',
                    supplier_id: '',
                    buying_date: '',
                    image: '',
                    product_quantity:''
                },
                errors: {},
                categories: {},
                suppliers:{}
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
                        this.form.image = event.target.result;
                        // console.log(event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            },
            productInsert(){
                axios.post('/api/product', this.form)
                .then(() => {
                    this.$router.push({ name: 'product' })
                    Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
