<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Product</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row container">
            <div class="card col-lg-12">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Edit Product
                    <router-link to="/stock" class="btn btn-sm btn-info" id="add_new"> Stock Product</router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="stockUpdate()">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" v-model="form.product_quantity" class="form-control"  required="">
                                        <label for="product_quantity">Quantity  </label>
                                        <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div><br>

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
        name: "edit_stock",

        data(){
            return{
                form:{
                    product_quantity:''
                },
                errors:{},
                categories:{},
                suppliers:{},
            }
        },

        methods:{
            stockUpdate(){
                let id = this.$route.params.id;
                axios.post('/api/stock/update/'+id,this.form)
                    .then(res=>{
                        this.$router.push('/stock')
                        Toast.fire({
                            type: 'success',
                            title: 'Product Added Successfully'
                        })
                    })
                    .catch(error=>this.errors=error.response.data.errors)
            },
        },


        created(){
            let id = this.$route.params.id;
            axios.get('/api/product/'+id)
                .then(({data})=>this.form=data)
                .catch()
        }



    }
</script>

<style scoped>
    #add_emp{
        float: right;
    }
</style>
