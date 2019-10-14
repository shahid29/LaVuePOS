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
                <router-link to="/add-category" id="emp_add"  class="btn btn-sm btn-info" > Add New</router-link>
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
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="(category,index) in filterSearch" :key="category.id"  style="text-align: center">
                                <td>{{index+1}}</td>
                                <td>{{category.category_name}}</td>
                                <td>
                                    <router-link  class="btn btn-success" :to="`/edit-category/${category.id}`">Edit</router-link>
                                    <a @click.prevent="deleteCategoryById(category.id)" class="btn btn-danger" href="">Delete</a>
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
                categories:[],
                searchTerm:''
            }
        },
        methods:{
            getCategory(){
                axios.get('/api/category')
                    .then(({data})=>this.categories=data)
                    .catch()
            },
            deleteCategoryById(id) {
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
                        axios.delete('/api/category/' + id)
                            .then(() => {
                                this.getCategory();
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
            this.getCategory()
        },
        computed:{
            filterSearch(){
               return this.categories.filter(category=>{
                 return   category.category_name.match(this.searchTerm)
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
