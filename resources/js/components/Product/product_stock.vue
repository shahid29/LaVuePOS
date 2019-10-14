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
                                <th>Photo</th>
                                <th>Product Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(product,index) in filterSearch" :key="product.id"  style="text-align: center">
                                <td>{{index+1}}</td>
                                <td>{{product.product_name}}</td>
                                <td>
                                    <img id="photo" :src="product.image" alt="">
                                </td>
                                <td>{{product.product_quantity}}</td>
                                <td v-if="product.product_quantity >10"><span class="badge badge-success">Available</span></td>
                                <td v-else-if="product.product_quantity >=1 && product.product_quantity <=10"><span class="badge badge-warning">Nearly Stock Out</span></td>
                                <td v-else="product.product_quantity <1"><span class="badge badge-danger">Stock Out</span></td>
                                <td>
                                    <router-link  class="btn btn-success" :to="`/edit-stock/${product.id}`">Edit</router-link>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
</template>

<script>
    export default {
        name: "product_stock",
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
