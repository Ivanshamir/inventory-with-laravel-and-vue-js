<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>Stock Lict
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <label for="">Search</label>
              <input type="text" v-model="searchTerm" class="form-control"> <br>
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Image</th>
                  <th>Category </th>
                  <th>Buying Price</th>
                  <th>Status</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Image</th>
                  <th>Category </th>
                  <th>Buying Price</th>
                  <th>Status</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="product in filterSearch" :key="product.id">
                  <td>{{ product.product_name }}</td>
                  <td>{{ product.product_code }}</td>
                  <td><img :src="product.image" height="40px" width="40px" ></td>
                  <td>{{product.category_name}}</td>
                  <td>{{product.buying_price}}</td>
                  <td>{{product.product_quantity}}</td>
                  <td v-if="product.product_quantity >= 1">
                      <span class="badge badge-success">Available</span>
                  </td>
                  <td v-else="">
                      <span class="badge badge-danger">Stock Out</span>
                  </td>
                  <td>
                      <router-link :to="{ name: 'edit-stock', params:{id: product.id} }" class="btn btn-info">Update Stock</router-link>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
                products: [],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return this.products.filter(product => {
                    return product.product_name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allProduct(){
                axios.get('/api/product')
                .then(( {data} )=> (this.products = data))
                .catch()
            }
        },
        mounted(){
            this.allProduct();
        }
    }
</script>
