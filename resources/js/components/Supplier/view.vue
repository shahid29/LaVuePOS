<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Supplier</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row card container">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Supplier Insert
                <router-link to="/add-supplier" id="emp_add"  class="btn btn-sm btn-info" > Add New</router-link>
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
                                <th>Email</th>
                                <th>Shop Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="supplier in filterSearch" :key="supplier.id"  style="text-align: center">
                                <td>{{supplier.name}}</td>
                                <td>
                                    <img id="photo" :src="supplier.photo" alt="">
                                </td>
                                <td>{{supplier.phone}}</td>
                                <td>{{supplier.email}}</td>
                                <td>{{supplier.shopname}}</td>
                                <td>
                                    <router-link  class="btn btn-success" :to="`/edit-supplier/${supplier.id}`">Edit</router-link>
                                    <a @click.prevent="deleteSupplierById(supplier.id)" class="btn btn-danger" href="">Delete</a>
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
                suppliers:[],
                searchTerm:''
            }
        },
        methods:{
            getSupplier(){
                axios.get('/api/supplier')
                    .then(({data})=>this.suppliers=data)
                    .catch()
            },
            deleteSupplierById(id) {
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
                        axios.delete('/api/supplier/' + id)
                            .then(() => {
                                this.getSupplier();
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
            this.getSupplier()
        },
        computed:{
            filterSearch(){
               return this.suppliers.filter(supplier=>{
                 return   supplier.name.match(this.searchTerm)
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
