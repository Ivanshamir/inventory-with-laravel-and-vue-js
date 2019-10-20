<template>
    <div>
        <div class="row">
            <div class="col-md-12"> 
            <div class="card mx-auto mt-5">
            <div class="card-header">
                Update Employee
                <router-link to="/employee" class="btn btn-info " style="float:right">All Employee</router-link>
                </div>
            <div class="card-body">
                <form @submit.prevent="employeeUpdate" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control" id="address" type="text" v-model="form.address">
                            <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input class="form-control" id="salary" type="text" v-model="form.salary">
                            <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Joining Date</label>
                            <input class="form-control" id="date" type="date" v-model="form.joining_date">
                            <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                            <label for="nid">NID Number</label>
                            <input class="form-control" id="nid" type="text" v-model="form.nid">
                            <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="btn btn-info" type="file" @change="onFIleSelected">
                            <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <img :src="form.photo" style="height: 40px; width: 40px">
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
                    salary: '',
                    address: '',
                    photo: '',
                    nid: '',
                    joining_date: ''
                },
                errors: {}
            }
        },
        methods:{
            onFIleSelected(event){
                let file = event.target.files[0];
                
                if(file.size > 1048770){
                    Notification.image_validation();
                }else{
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.photo = event.target.result;
                        // console.log(event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            },
            employeeUpdate(){
                let id = this.$route.params.id;
                axios.patch('/api/employee/'+id, this.form)
                .then(() => {
                    this.$router.push({ name: 'employee' })
                    Notification.success();
                })
                .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
