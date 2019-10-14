<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Salary by Month</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row card container">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                <!--Employee Insert-->
                <!--<router-link to="/add-employee" id="emp_add"  class="btn btn-sm btn-info" > Add New</router-link>-->
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <label>Search</label>
                        <input type="text" v-model="searchTerm" class="form-control" style="width:200px; "><br>
                        <table class="table table-bordered" id="" width="100%" cellspacing="0">

                            <thead>
                            <tr style="text-align: center">
                                <th>Serial</th>
                                <th>Month</th>
                                <th>View</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(salary,index) in salaries" :key="salary.id"  style="text-align: center">
                                <td>{{index+1}}</td>
                                <td>{{salary.salary_month}}</td>
                                <td>
                                    <router-link  class="btn btn-success" :to="`/view-salary/${salary.salary_month}`">View</router-link>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "all_salary",
        data(){
            return{
                salaries:[],
                searchTerm:''
            }
        },
        methods:{
            getSalary(){
                axios.get('/api/salary')
                    .then(({data})=>this.salaries=data)
                    .catch()
            }
        },
        created(){
            this.getSalary()
        },
        computed:{
            filterSearch(){
                return this.salaries.filter(salary=>{
                    return   salary.salary_month.match(this.searchTerm)
                })
            }
        }
    }
</script>

<style scoped>
    #photo{
        height:40px;
        width:40px
    }
    #emp_add{
        float: right;
    }
</style>
