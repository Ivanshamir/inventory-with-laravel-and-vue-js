<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> All Expense
          <router-link to="/store-expense" class="btn btn-info " style="float:right">Create Expense</router-link>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <label for="">Search</label>
              <input type="text" v-model="searchTerm" class="form-control"> <br>
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Details</th>
                  <th>Amount</th>
                  <th>Expense Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Details</th>
                  <th>Amount</th>
                  <th>Expense Date</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                <tr v-for="expense in filterSearch" :key="expense.id">
                  <td>{{ expense.details }}</td>
                  <td>{{expense.amount}}</td>
                  <td>{{expense.expense_date}}</td>
                  <td>
                      <router-link :to="{ name: 'edit-expense', params:{id: expense.id} }" class="btn btn-success">Edit</router-link>
                      <a @click="deleteExpense(expense.id)"  class="btn btn-danger">Delete</a>
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
                expenses: [],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return this.expenses.filter(expense => {
                    return expense.details.match(this.searchTerm)
                })
            }
        },
        methods:{
            allExpense(){
                axios.get('/api/expense')
                .then(( {data} )=> (this.expenses = data))
                .catch()
            },
            deleteExpense(id){
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
                        axios.delete('/api/expense/'+id)
                        .then(()=>{
                            this.expenses = this.expenses.filter(expense => {
                                return expense.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push( {name:'expense' } )
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
            this.allExpense();
        }
    }
</script>
