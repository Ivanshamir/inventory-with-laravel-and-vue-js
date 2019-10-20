<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> All Supplier
          <router-link to="/store-supplier" class="btn btn-info " style="float:right">Create Supplier</router-link>
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
                  <th>Photo</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Shop Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Name</th>
                  <th>Email</th>
                  <th>Photo</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Shop Name</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                <tr v-for="supplier in filterSearch" :key="supplier.id">
                  <td>{{ supplier.name }}</td>
                  <td>{{ supplier.email }}</td>
                  <td><img :src="supplier.photo" height="40px" width="40px" ></td>
                  <td>{{supplier.phone}}</td>
                  <td>{{supplier.address}}</td>
                  <td>{{supplier.shopname}}</td>
                  <td>
                      <router-link :to="{ name: 'edit-supplier', params:{id: supplier.id} }" class="btn btn-success">Edit</router-link>
                      <a @click="deleteSupplier(supplier.id)"  class="btn btn-danger">Delete</a>
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
                suppliers: [],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return this.suppliers.filter(supplier => {
                    return supplier.name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allSupplier(){
                axios.get('/api/supplier')
                .then(( {data} )=> (this.suppliers = data))
                .catch()
            },
            deleteSupplier(id){
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
                        axios.delete('/api/supplier/'+id)
                        .then(()=>{
                            this.suppliers = this.suppliers.filter(supplier => {
                                return supplier.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push( {name:'supplier' } )
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
            this.allSupplier();
        }
    }
</script>
