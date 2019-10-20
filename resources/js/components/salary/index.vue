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
                  <th>Month</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Month</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                <tr v-for="salary in filterSearch" :key="salary.salary_month">
                  <td>{{ salary.salary_month }}</td>
                  <td>
                      <router-link :to="{ name: 'view-salary', params:{id: salary.salary_month} }" class="btn btn-success">View Salary</router-link>
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
                salaries: [],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return this.salaries.filter(salary => {
                    return salary.salary_month.match(this.searchTerm)
                })
            }
        },
        methods:{
            allEmployee(){
                axios.get('/api/salary')
                .then(( {data} )=> (this.salaries = data))
                .catch()
            }
        },
        mounted(){
            this.allEmployee();
        }
    }
</script>
