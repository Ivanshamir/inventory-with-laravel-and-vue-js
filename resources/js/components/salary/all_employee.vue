<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> All Employee
         
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
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>Salary</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                <tr v-for="employee in filterSearch" :key="employee.id">
                  <td>{{ employee.name }}</td>
                  <td><img :src="employee.photo" height="40px" width="40px" ></td>
                  <td>{{employee.salary}}</td>
                  <td>
                      <router-link :to="{ name: 'pay-salary', params:{id: employee.id} }" class="btn btn-success">Pay Salary</router-link>
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
            }
        },
        mounted(){
            this.allEmployee();
        }
    }
</script>
