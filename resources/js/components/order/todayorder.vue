<template>
    <div>
           <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Today Order
          
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <label for="">Search</label>
              <input type="text" v-model="searchTerm" class="form-control"> <br>
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Total Amount</th>
                  <th>Pay</th>
                  <th>Due</th>
                  <th>PayBy</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Total Amount</th>
                  <th>Pay</th>
                  <th>Due</th>
                  <th>PayBy</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                <tr v-for="order in filterSearch" :key="order.id">
                  <td>{{ order.name }}</td>
                  <td>{{order.total}}</td>
                  <td>{{order.pay}}</td>
                  <td>{{order.due}}</td>
                  <td>{{order.payby}}</td>
                  <td>
                      <router-link :to="{ name: 'view-order', params:{id: order.id} }" class="btn btn-success">View</router-link>
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
                orders: [],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return this.orders.filter(order => {
                    return order.name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allOrder(){
                axios.get('/api/todayorder')
                .then(( {data} )=> (this.orders = data))
                .catch()
            }
        },
        mounted(){
            this.allOrder();
        }
    }
</script>
