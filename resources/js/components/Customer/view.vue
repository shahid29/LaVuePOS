<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Customer</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row card container">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Customer Insert
                <router-link to="/add-customer" id="emp_add"  class="btn btn-sm btn-info" > Add New</router-link>
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
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="(customer,index) in filterSearch" :key="customer.id"  style="text-align: center">
                                <td>{{index+1}}</td>
                                <td>{{customer.name}}</td>
                                <td>
                                    <img id="photo" :src="customer.photo" alt="">
                                </td>
                                <td>{{customer.phone}}</td>
                                <td>{{customer.address}}</td>
                                <td>
                                    <router-link  class="btn btn-success" :to="`/edit-customer/${customer.id}`">Edit</router-link>
                                    <a @click.prevent="deleteCustomerById(customer.id)" class="btn btn-danger" href="">Delete</a>
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
                customers:[],
                searchTerm:''
            }
        },
        methods:{
            getCustomer(){
                axios.get('/api/customer')
                    .then(({data})=>this.customers=data)
                    .catch()
            },
            deleteCustomerById(id) {
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
                        axios.delete('/api/customer/' + id)
                            .then(() => {
                                this.getCustomer();
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
            this.getCustomer()
        },
        computed:{
            filterSearch(){
               return this.customers.filter(customer=>{
                 return   customer.name.match(this.searchTerm)
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
