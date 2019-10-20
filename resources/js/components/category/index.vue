<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> All Category
          <router-link to="/store-category" class="btn btn-info " style="float:right">Create Category</router-link>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <label for="">Search</label>
              <input type="text" v-model="searchTerm" class="form-control"> <br>
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="category in filterSearch" :key="category.id">
                  <td>{{ category.name }}</td>
                  <td>
                      <router-link :to="{ name: 'edit-category', params:{id: category.id} }" class="btn btn-success">Edit</router-link>
                      <a @click="deleteCategory(category.id)"  class="btn btn-danger">Delete</a>
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
                categories: [],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return this.categories.filter(category => {
                    return category.name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allCategory(){
                axios.get('/api/category')
                .then(( {data} )=> (this.categories = data))
                .catch()
            },
            deleteCategory(id){
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
                        axios.delete('/api/category/'+id)
                        .then(()=>{
                            this.categories = this.categories.filter(employee => {
                                return employee.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push( {name:'category' } )
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
            this.allCategory();
        }
    }
</script>
