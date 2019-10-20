<template>
    <div>
        <div class="row">
            <div class="col-md-12"> 
            <div class="card mx-auto mt-5">
            <div class="card-header">
                Search Order
                <router-link to="/today-order" class="btn btn-info " style="float:right">Today Order</router-link>
                </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form @submit.prevent="searchDate">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fullName">Search By Date</label>
                                        <input class="form-control" id="fullName" type="date" v-model="form.date">
                                    </div>
                                </div>
                            </div>
                        
                            <button class="btn btn-primary " type="submit">Search</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form @submit.prevent="searchMonth">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Search By Month</label>
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="form.month">
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
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary " type="submit">Search</button>
                        </form>
                    </div>
                </div>
                
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
                    date: '',
                    month: ''
                },
                errors: {}
            }
        },
        methods:{
            searchDate(){
                axios.post('/api/searchorder/date', this.form)
                .then(() => {
                    // this.$router.push({ name: 'category' })
                    // Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            },
            searchMonth(){
                axios.post('/api/searchorder/month', this.form)
                .then(() => {
                    // this.$router.push({ name: 'category' })
                    // Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
