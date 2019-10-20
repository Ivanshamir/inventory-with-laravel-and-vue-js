<template>
    <div>
        <div class="row">
            <div class="col-md-12"> 
            <div class="card mx-auto mt-5">
            <div class="card-header">
                Insert Expense
                <router-link to="/expense" class="btn btn-info " style="float:right">All Expense</router-link>
                </div>
            <div class="card-body">
                <form @submit.prevent="expenseInsert" >
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullName">Details</label>
                            <input class="form-control" id="fullName" type="text" v-model="form.details">
                            <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Amount</label>
                            <input class="form-control" id="email" type="text" v-model="form.amount">
                            <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Expense Date</label>
                            <input class="form-control" id="address" type="date" v-model="form.expense_date">
                            <small class="text-danger" v-if="errors.expense_date">{{ errors.expense_date[0] }}</small>
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
        },
        data(){
            return{
                form:{
                    details: '',
                    amount: '',
                    expense_date: ''
                },
                errors: {}
            }
        },
        methods:{
            expenseInsert(){
                axios.post('/api/expense', this.form)
                .then(() => {
                    this.$router.push({ name: 'expense' })
                    Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
