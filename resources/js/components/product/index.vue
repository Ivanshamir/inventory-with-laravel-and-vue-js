<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> All Product
          <router-link to="/store-product" class="btn btn-info " style="float:right">Create Product</router-link>
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
                  <th>Selling Price</th>
                  <th>Root</th>
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
                  <th>Selling Price</th>
                  <th>Root</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                <tr v-for="product in filterSearch" :key="product.id">
                  <td>{{ product.product_name }}</td>
                  <td>{{ product.product_code }}</td>
                  <td><img :src="product.image" height="40px" width="40px" ></td>
                  <td>{{product.category_name}}</td>
                  <td>{{product.buying_price}}</td>
                  <td>{{product.selling_price}}</td>
                  <td>{{product.root}}</td>
                  <td>
                      <router-link :to="{ name: 'edit-product', params:{id: product.id} }" class="btn btn-success">Edit</router-link>
                      <a @click="deleteProduct(product.id)"  class="btn btn-danger">Delete</a>
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
            },
            deleteProduct(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/product/'+id)
                        .then(()=>{
                            this.products = this.products.filter(product => {
                                return product.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push( {name:'product' } )
                        })
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                })
            }
        },
        mounted(){
            this.allProduct();
        }
    }
</script>