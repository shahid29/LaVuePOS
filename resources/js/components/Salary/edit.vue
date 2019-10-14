<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Pay Salary</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row container">
            <div class="card col-lg-12">
                <div class="card-header">
                    <i  class="fas fa-chart-area"></i>
                    Update Employee Salary
                    <router-link to="/all-salary"  class="btn btn-sm btn-info" id="add_emp"> Salary</router-link>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" @submit.prevent="salaryUpdate()">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input va id="firstName" v-model="form.name" type="text" class="form-control">
                                        <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                                        <label for="firstName">Full Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input v-model="form.phone" id="lastName" type="text" class="form-control" >
                                        <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                        <label for="lastName">Phone</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="form.salary_month">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="Agust">Agust</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input v-model="form.amount" id="lastName1" type="text" class="form-control" >
                                        <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>
                                        <label for="lastName">Amount</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "edit",

        data(){
            return{
                form:{
                    name:'',
                    amount:'',
                    salary_month:'',
                    phone:'',
                    employee_id:'',

                },
                salary:'',
                errors:{}
            }
        },
        created(){
                let id = this.$route.params.id;
                axios.get('/api/edit-salary/'+id)
                    .then(({data})=>this.form=data)
                    .catch()

        },
        methods:{
            salaryUpdate(){
                let id = this.$route.params.id;
                axios.post('/api/salary/update/'+id,this.form)
                    .then(res=>{
                        this.$router.push('/all-salary')
                        Toast.fire({
                            type: 'success',
                            title: 'Salary Update Successfully'
                        })
                    })
                    .catch(error=>this.errors=error.response.data.errors)
            },

            checkMonth(){
                let id = this.$route.params.id;
                axios.get('/api/check/month/'+id)
                    .then(({data})=>this.salary=data)
                    .catch()
            }
        }



    }
</script>

<style scoped>
    #add_emp{
        float: right;
    }
</style>
