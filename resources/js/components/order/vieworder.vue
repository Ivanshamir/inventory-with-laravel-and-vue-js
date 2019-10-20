<template>
    <div>
        <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> All Product
          <router-link to="/store-product" class="btn btn-info " style="float:right">Create Product</router-link>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-6">
                    <ul class="list-group">
                        <li class="list-group-item bg-info text-white">Customer Details</li>
                        <li class="list-group-item">Name: {{orders.name}}</li>
                        <li class="list-group-item">Phone: {{orders.phone}}</li>
                        <li class="list-group-item">Address: {{orders.address}}</li>
                        <li class="list-group-item">Date: {{orders.order_date}}</li>
                        <li class="list-group-item">Quantity: {{orders.qty}}</li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-6">
                    <ul class="list-group">
                       <li class="list-group-item">Sub Total: {{orders.sub_total}}</li>
                        <li class="list-group-item">Vat: {{orders.vat}} %</li>
                        <li class="list-group-item">Total: {{orders.total}}</li>
                        <li class="list-group-item">Pay: {{orders.pay}}</li>
                        <li class="list-group-item">Due: {{orders.due}}</li>
                        <li class="list-group-item">Pay Through: {{orders.payby}}</li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div><br>
        <div class="row container">
            <div class="card col-lg-12">
                <div class="card-header">
          <i class="fa fa-table"></i> Today Order
          
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <label for="">Search</label>
              <!-- <input type="text" v-model="searchTerm" class="form-control"> <br> -->
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Image</th>
                  <th>Qty</th>
                  <th>Unit Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                   <th>Name</th>
                  <th>Code</th>
                  <th>Image</th>
                  <th>Qty</th>
                  <th>Unit Price</th>
                  <th>Total</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="detail in details" :key="detail.id">
                  <td>{{ detail.product_name }}</td>
                  <td>{{detail.product_code}}</td>
                  <td><img :src="'/'+detail.image" height="40px" width="40px"></td>
                  <td>{{detail.pro_quantity}}</td>
                  <td>{{detail.product_price}}</td>
                  <td>{{detail.sub_total}}</td>
                </tr>

              </tbody>
            </table>
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

            axios.get('/api/order/'+id)
            .then(( {data} ) => (this.orders = data))
            .catch(console.log('error'))

            axios.get('/api/orderdetails/'+id)
            .then(({data}) => (this.details = data))
            .catch(console.log('error'))
        },
        data(){
            return{
                orders: [],
                details:[],
                errors:{}
            }
        },
        methods:{

        }
    }
</script>