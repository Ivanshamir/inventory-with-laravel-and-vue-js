<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> All Customer
          <router-link to="/store-customer" class="btn btn-info " style="float:right">Create Customer</router-link>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <label for="">Search</label>
              <input type="text" v-model="searchTerm" class="form-control"> <br>
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Image</th>
                  <th>Phone </th>
                  <th>Address </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                 <th>Name</th>
                  <th>Email</th>
                  <th>Image</th>
                  <th>Phone </th>
                  <th>Address </th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="customer in filterSearch" :key="customer.id">
                  <td>{{ customer.name }}</td>
                  <td>{{ customer.email }}</td>
                  <td><img :src="customer.photo" height="40px" width="40px" ></td>
                  <td>{{customer.phone}}</td>
                  <td>{{customer.address}}</td>
                  <td>
                      <router-link :to="{ name: 'edit-customer', params:{id: customer.id} }" class="btn btn-success">Edit</router-link>
                      <a @click="deleteCustomer(customer.id)"  class="btn btn-danger">Delete</a>
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
                customers: [],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return this.customers.filter(customer => {
                    return customer.name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allCustomer(){
                axios.get('/api/customer')
                .then(( {data} )=> (this.customers = data))
                .catch()
            },
            deleteCustomer(id){
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
                        axios.delete('/api/customer/'+id)
                        .then(()=>{
                            this.customers = this.customers.filter(customer => {
                                return customer.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push( {name:'customer' } )
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
            this.allCustomer();
        }
    }
</script>
