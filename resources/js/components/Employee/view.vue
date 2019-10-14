<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Employee</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row card container">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Employee Insert
                <router-link to="/add-employee" id="emp_add"  class="btn btn-sm btn-info" > Add New</router-link>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <label>Search</label>
                        <input type="text" v-model="searchTerm" class="form-control" style="width:200px; "><br>
                        <table class="table table-bordered" id="" width="100%" cellspacing="0">

                            <thead>
                            <tr style="text-align: center">
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Phone</th>
                                <th>Salary</th>
                                <th>Joining date</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="employee in employees" :key="employee.id"  style="text-align: center">
                                <td>{{employee.name}}</td>
                                <td>
                                    <img id="photo" :src="employee.photo" alt="">
                                </td>
                                <td>{{employee.phone}}</td>
                                <td>{{employee.salary}}</td>
                                <td>{{employee.joinning_date}}</td>
                                <td>
                                    <router-link  class="btn btn-success" :to="`/edit-employee/${employee.id}`">Edit</router-link>
                                    <a @click.prevent="deleteEmployeeById(employee.id)" class="btn btn-danger" href="">Delete</a>
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
        name: "view",
        data(){
            return{
                employees:[],
                searchTerm:''
            }
        },
        methods:{
            getEmployee(){
                axios.get('/api/employee')
                    .then(({data})=>this.employees=data)
                    .catch()
            },
            deleteEmployeeById(id) {
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
                        axios.delete('/api/employee/' + id)
                            .then(() => {
                                this.getEmployee();
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }


                })

            },
        },
        created(){
            this.getEmployee()
        },
        computed:{
            filterSearch(){
               return this.employees.filter(employee=>{
                 return   employee.name.match(this.searchTerm)
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
