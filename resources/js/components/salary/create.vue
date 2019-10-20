<template>
    <div>
        <div class="row">
            <div class="col-md-12"> 
            <div class="card mx-auto mt-5">
            <div class="card-header">
                Pay Salary
                <router-link to="/given-salary" class="btn btn-info " style="float:right">Pay Salary</router-link>
                </div>
            <div class="card-body">
                <form @submit.prevent="salaryPaid">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input class="form-control" id="fullName" type="text" v-model="form.name">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input class="form-control" id="email" type="email" v-model="form.email">
                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label for="category">Month</label> <br>
                            <select v-model="form.salary_month" class="custom-select" id="inputGroupSelect02">
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                            <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input class="form-control" id="salary" type="text" v-model="form.amount">
                            <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                        </div>
                    </div>
                </div>
    
                <button class="btn btn-primary " type="submit">Submit</button>
                </form>
            </div>
        </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        created(){
            if(!User.loggedIn()){
                this.$router.push({name: '/' })
            }

            let id = this.$route.params.id;
            axios.get('/api/employee/'+id)
            .then(( {data} ) => (this.form = data))
            .catch(console.log('error'))
        },
        data(){
            return{
                form:{
                    name: '',
                    email: '',
                    amount: '',
                    salary_month: ''
                },
                errors: {}
            }
        },
        methods:{
            salaryPaid(){
                 let id = this.$route.params.id;
                axios.post('/api/salary/paid/'+id, this.form)
                .then(() => {
                    this.$router.push({ name: 'given-salary' })
                    Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
