<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> All Employee
          <router-link to="/store-employee" class="btn btn-info " style="float:right">Create Employee</router-link>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <label for="">Search</label>
              <input type="text" v-model="searchTerm" class="form-control"> <br>
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>Salary</th>
                  <th>Address</th>
                  <th>Joining Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>Salary</th>
                  <th>Address</th>
                  <th>Joining Date</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                <tr v-for="employee in filterSearch" :key="employee.id">
                  <td>{{ employee.name }}</td>
                  <td><img :src="employee.photo" height="40px" width="40px" ></td>
                  <td>{{employee.salary}}</td>
                  <td>{{employee.address}}</td>
                  <td>{{employee.joining_date}}</td>
                  <td>
                      <router-link :to="{ name: 'edit-employee', params:{id: employee.id} }" class="btn btn-success">Edit</router-link>
                      <a @click="deleteEmployee(employee.id)"  class="btn btn-danger">Delete</a>
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
                employees: [],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return this.employees.filter(employee => {
                    return employee.name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allEmployee(){
                axios.get('/api/employee')
                .then(( {data} )=> (this.employees = data))
                .catch()
            },
            deleteEmployee(id){
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
                        axios.delete('/api/employee/'+id)
                        .then(()=>{
                            this.employees = this.employees.filter(employee => {
                                return employee.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push( {name:'employee' } )
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
            this.allEmployee();
        }
    }
</script>
