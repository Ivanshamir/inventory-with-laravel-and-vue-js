<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
        
        </div>
        <div class="card-body">
            <div class="row">
                <div class="card col-lg-5 col-md-5">
                    <div class="card-header">
                        <i class="fas fa-chart-area"></i>
                        POS
                    
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float:right">
                            Create Customer
                        </button>
                    </div>

                    
                        <div class="card-body">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th class="col" style="width:30%">Name</th>
                                        <th class="col">Qty</th>
                                        <th class="col">Unit</th>
                                        <th class="col">Total</th>
                                        <th class="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="card in cards" :key="card.id">
                                        <td>{{card.pro_name}}</td>
                                        <td>
                                            <input type="text" readonly style="width:20px" :value="card.pro_quantity">
                                            <button @click.prevent="increment(card.id)" class="btn btn-sm btn-success">+</button>
                                            <button @click.prevent="decrement(card.id)" class="btn btn-sm btn-danger" v-if="card.pro_quantity >= 2">-</button>
                                             <button @click.prevent="decrement(card.id)" class="btn btn-sm btn-danger" v-else="" disabled>-</button>
                                        </td>
                                        <td>{{ card.product_price }}</td>
                                        <td>{{ card.sub_total }}</td>
                                        <td><a @click="removeItem(card.id)" class="btn btn-sm btn-danger">x</a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>

                        </div>

                        
                        <div class="card-footer">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Quantity:
                                    <strong>{{ qty }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Sub Total:
                                    <strong>{{ subTotal }} Tk.</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    VAT:
                                    <strong> {{ vats.vat }} %</strong>
                                </li>
                                 <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total:
                                    <strong>{{ subTotal*vats.vat / 100 + subTotal }} Tk.</strong>
                                </li>
                            </ul>
                            <br>

                            <form @submit.prevent="orderdone">
                            <label for="">Customer Name</label>
                            <select class="form-control" v-model="customer_id">
                                <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{ customer.name }}</option>
                            </select>

                            <label for="">Pay</label>
                            <input type="text" class="form-control" required v-model="pay">

                            <label for="">Due</label>
                            <!-- <input type="text" class="form-control" required v-model="due"> -->
                            <input type="text" class="form-control" required name="due" :value="duee">

                            <label for="">Pay By</label>
                             <select class="form-control" v-model="payby">
                                <option value="Hand Cash">Hand Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Gift Card">Gift Card</option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-success"> Submit</button>
                            </form>
                            </div>
                    

                    <!--Customer Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" id="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <form @submit.prevent="customerInsert" enctype="multipart/form-data">
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
                
                            <button class="btn btn-primary " type="submit">Submit</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-7">
                    <div class="row card container">
                        <div class="card-header">
                            <i class="fas fa-chart-area"> </i> Products
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                       All Product
                                    </a>
                                </li>

                                <li class="nav-item" v-for="category in categories" :key="category.id">
                                    <a href="#pills-profile" class="nav-link" id="pills-profile-tab" data-toggle="pill" role="tab" aria-controls="pills-profile" aria-selected="false" @click="subproduct(category.id)" >
                                      {{category.name}}
                                    </a>
                                </li>                                                      
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <input type="text" v-model="searchTerm" class="form-control"> <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch" :key="product.id">
                                            <button @click.prevent="AddToCart(product.id)">
                                                <div class="card" style="width:9rem; height: 180px">
                                                    <img :src="product.image" class="card-img-top" style="height:100 px; width: 100px">
                                                    <div class="card-body">
                                                        <small class="card-title">{{ product.product_name }}</small>
                                                        <span v-if="product.product_quantity >= 1"  class="badge badge-success">Available ( {{product.product_quantity}} )</span>
                                                        <span v-else="" class="badge badge-danger">Stock Out</span>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <input type="text" v-model="getSearchTerm" class="form-control"> <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getFilterSearch" :key="getproduct.id">
                                            <button @click.prevent="AddToCart(getproduct.id)">
                                                <div class="card" style="width:9rem; height: 180px">
                                                    <img :src="getproduct.image" class="card-img-top" style="height:100 px; width: 100px">
                                                    <div class="card-body">
                                                        <small class="card-title">{{ getproduct.product_name }}</small>
                                                        <span v-if="getproduct.product_quantity >= 1"  class="badge badge-success">Available ( {{getproduct.product_quantity}} )</span>
                                                        <span v-else="" class="badge badge-danger">Stock Out</span>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                             
                        </div>
                    </div>
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
                    photo: ''
                },
                customer_id:'',
                pay:'',
                due:'',
                payby:'',
                errors: {},
                products: [],
                categories:'',
                searchTerm:'',
                getproducts: [],
                getSearchTerm:'',
                customers: [],
                cards: [],
                vats: []
            }
        },
        computed:{
            filterSearch(){
                return this.products.filter(product => {
                    return product.product_name.match(this.searchTerm)
                })
            },
            getFilterSearch(){
                return this.getproducts.filter(getproduct => {
                    return getproduct.product_name.match(this.getSearchTerm)
                })
            },
            qty(){
                let sum = 0;
                for(let i=0; i < this.cards.length; i++){
                    sum += (parseFloat(this.cards[i].pro_quantity));
                }
                return sum;
            },
            subTotal(){
                let sum = 0;
                for(let i=0; i < this.cards.length; i++){
                    sum += (parseFloat(this.cards[i].pro_quantity) * parseFloat(this.cards[i].product_price));
                }
                return sum;
            },
            duee() {
                 return this.due = (this.subTotal*this.vats.vat / 100 + this.subTotal) - this.pay;
            }
        },
        methods:{
            AddToCart(id){
                axios.post('/api/addToCart/'+id)
                 .then(() => {
                    Reload.$emit('AfterAdd');
                    Notification.cart_success();
                })
            },
            removeItem(id){
                axios.get('/api/remove/cart/'+id)
                .then(() => {
                    Reload.$emit('AfterAdd');
                   Notification.success();
                })
            },
            cartProduct(){
                axios.get('/api/cart/product')
                .then(( {data} )=> (this.cards = data))
                .catch()
            },
            increment(id){
                axios.get('/api/cart/increment/'+id)
                .then(() => {
                    Reload.$emit('AfterAdd');
                   Notification.success();
                })
            },
            decrement(id){
                axios.get('/api/cart/decrement/'+id)
                .then(() => {
                    Reload.$emit('AfterAdd');
                   Notification.success();
                })
            },
            allProduct(){
                axios.get('/api/product')
                .then(( {data} )=> (this.products = data))
                .catch()
            },
            allCategory(){
                axios.get('/api/category')
                .then(( {data} )=> (this.categories = data))
                .catch()
            },
            subproduct(id){
                axios.get('/api/getting/product/'+id)
                .then(( {data} )=> (this.getproducts = data))
                .catch(error => this.errors = error.response.data.errors)
            },
            orderdone(){
                let total =  this.subTotal*this.vats.vat / 100 + this.subTotal;
                var data = { qty:this.qty, subtotal: this.subTotal, customer_id: this.customer_id, payby: this.payby, pay: this.pay, due: this.due, vat: this.vats.vat, total:total};

                axios.post('/api/orderdone', data)
                .then(() => {
                    Notification.success();
                    this.$router.push({ name: 'home' })
                })
                .catch(console.log(error))

            },
            //for customer
            allCustomer(){
                axios.get('/api/customer')
                .then(( {data} )=> (this.customers = data))
                .catch()
            },
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
             customerInsert(){
                axios.post('/api/customer', this.form)
                .then(() => {
                    $('#closeModal').click();
                    Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            },
            getVats(){
                 axios.get('/api/cart/vats')
                .then(( {data} )=> (this.vats = data))
                .catch(error => this.errors = error.response.data.errors)
            }
        },
        mounted(){
            this.allProduct();
            this.allCategory();
            this.allCustomer();
            this.cartProduct();
            this.getVats();
            Reload.$on('AfterAdd', ()=>{
                this.cartProduct();
            })
        }
    }
</script>
