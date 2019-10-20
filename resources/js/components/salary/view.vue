<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Saalry View
         
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <label for="">Search</label>
              <input type="text" v-model="searchTerm" class="form-control"> <br>
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Month</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Month</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                <tr v-for="salary in filterSearch" :key="salary.salary_month">
                  <td>{{ salary.name }}</td>
                  <td>{{ salary.salary_month }}</td>
                  <td>{{ salary.amount }}</td>
                  <td>{{ salary.salary_date }}</td>
                  <td>
                      <!-- <router-link :to="{ name: 'edit-salary', params:{id: salary.salary_month} }" class="btn btn-success">View Salary</router-link> -->
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
                    return salary.name.match(this.searchTerm)
                })
            }
        },
        methods:{
            viewSalary(){
                 let id = this.$route.params.id;
                axios.get('/api/salary/view/'+id)
                .then(( {data} )=> (this.salaries = data))
                .catch()
            }
        },
        mounted(){
            
            this.viewSalary();
        }
    }
</script>
