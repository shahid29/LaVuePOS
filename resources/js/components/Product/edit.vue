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
                    <router-link to="/all-product" class="btn btn-sm btn-info" id="add_new"> All Product</router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="productUpdate()" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" v-model="form.product_name" class="form-control"   required="">
                                        <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                        <label for="product_name">Product Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" v-model="form.product_code" class="form-control" >
                                        <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                        <label for="product_code">Product Code</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Category</label>
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="form.category_id">
                                            <option :value="category.id" v-for="category in categories">{{category.category_name}}</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Supplier</label>
                                        <select class="form-control" id="exampleFormControlSelect2" v-model="form.supplier_id">
                                            <option :value="supplier.id" v-for="supplier in suppliers">{{supplier.name}}</option>

                                        </select>
                                        <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-label-group">
                                        <input type="text" v-model="form.root" class="form-control"  autofocus="autofocus" required="">
                                        <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                                        <label for="root">Root</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-label-group">
                                        <input type="text" v-model="form.buying_price" class="form-control"  required="">
                                        <label for="buying_price">Buying Price</label>
                                        <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-label-group">
                                        <input type="text" v-model="form.selling_price" class="form-control"  required="">
                                        <label for="selling_price">Selling Price </label>
                                        <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="date" v-model="form.buying_date" class="form-control"  required="">
                                        <label for="buying_date">Buying Date</label>
                                        <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" v-model="form.product_quantity" class="form-control"  required="">
                                        <label for="product_quantity">Quantity  </label>
                                        <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <div class="form-row">

                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="file" class="btn btn-info" @change="changePhoto">

                                        <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img :src="updateImage()" style="height:40px; width: 40px;">
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
                    product_name :'',
                    product_code :'',
                    category_id:'',
                    supplier_id:'',
                    root :'',
                    buying_price:'',
                    selling_price : '',
                    buying_date:'',
                    image:'',
                    newphoto:'',
                    product_quantity:''
                },
                errors:{},
                categories:{},
                suppliers:{},
            }
        },

        methods:{
            changePhoto(event){
                let file = event.target.files[0];
                if (file.size>1048576){
                    Swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                } else {
                    let reader = new FileReader();
                    reader.onload = event=> {
                        // The file's text will be printed here
                        this.form.image =event.target.result
                        this.form.newphoto =event.target.result
                    };

                    reader.readAsDataURL(file);
                }

            },
            productUpdate(){
                let id = this.$route.params.id;
                axios.patch('/api/product/'+id,this.form)
                    .then(res=>{
                        this.$router.push('/all-product')
                        Toast.fire({
                            type: 'success',
                            title: 'Product Added Successfully'
                        })
                    })
                    .catch(error=>this.errors=error.response.data.errors)
            },
            updateImage(){
                let img = this.form.image;
                if (img.length>100){
                    return this.form.image
                }else {
                    return  `/${ this.form.image}`
                }
            }
        },


        created(){
            axios.get('/api/category')
                .then(({data}) => this.categories = data)
                .catch()

            axios.get('/api/supplier')
                .then(({data}) => this.suppliers = data)
                .catch()

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
