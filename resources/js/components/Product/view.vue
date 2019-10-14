<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Product</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row card container">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Product Insert
                <router-link to="/add-product" id="emp_add"  class="btn btn-sm btn-info" > Add New</router-link>
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
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Photo</th>
                                <th>Product Category</th>
                                <th>Product Supplier Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(product,index) in filterSearch" :key="product.id"  style="text-align: center">
                                <td>{{index+1}}</td>
                                <td>{{product.product_name}}</td>
                                <td>{{product.product_code}}</td>
                                <td>{{product.buying_price}}</td>
                                <td>{{product.selling_price}}</td>
                                <td>
                                    <img id="photo" :src="product.image" alt="">
                                </td>
                                <td>{{product.category.category_name}}</td>
                                <td>{{product.supplier.name}}</td>
                                <td>
                                    <router-link  class="btn btn-success" :to="`/edit-product/${product.id}`">Edit</router-link>
                                    <a @click.prevent="deleteProductById(product.id)" class="btn btn-danger" href="">Delete</a>
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
                products:[],
                searchTerm:''
            }
        },
        methods:{
            getProduct(){
                axios.get('/api/product')
                    .then(({data})=>this.products=data)
                    .catch()
            },
            deleteProductById(id) {
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
                        axios.delete('/api/product/' + id)
                            .then(() => {
                                this.getProduct();
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
            this.getProduct()
        },
        computed:{
            filterSearch(){
                return this.products.filter(product=>{
                    return   product.product_name.match(this.searchTerm)
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
