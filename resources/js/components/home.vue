<template>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-comments"></i>
                        </div>
                        <div class="mr-5">{{todaysell}} Taka</div>
                    </div>
                    <router-link class="card-footer text-white clearfix small z-1" to="/today-order">
                        <span class="float-left">Today Sell</span>
                        <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                    </router-link>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-list"></i>
                        </div>
                        <div class="mr-5"> {{todayincome}} Taka</div>
                    </div>
                    <router-link class="card-footer text-white clearfix small z-1" to="/today-order">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                    </router-link>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-shopping-cart"></i>
                        </div>
                        <div class="mr-5">{{due}} Taka</div>
                    </div>
                    <router-link class="card-footer text-white clearfix small z-1" to="/today-order">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                    </router-link>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-life-ring"></i>
                        </div>
                        <div class="mr-5">{{expense}} Taka</div>
                    </div>
                    <router-link class="card-footer text-white clearfix small z-1" to="/all-expense">
                        <span class="float-left">All Expense</span>
                        <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                    </router-link>
                </div>
            </div>
        </div>

        <!-- Area Chart Example-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Product Stock Out</div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--<label>Search</label>-->
                    <!--<input type="text" v-model="searchTerm" class="form-control" style="width:200px; "><br>-->
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
                        <tr v-for="(product,index) in products" :key="product.id"  style="text-align: center">
                            <td>{{index+1}}</td>
                            <td>{{product.product_name}}</td>
                            <td>
                                <img id="photo" :src="product.image" alt="">
                            </td>
                            <td>{{product.product_quantity}}</td>
                            <td v-if="product.product_quantity>=1 && product.product_quantity<11" ><span class="badge badge-warning">Very Few Left</span></td>
                            <td v-else="product.product_quantity<1" ><span class="badge badge-danger">Stock Out</span></td>
                            <td>
                                <router-link  class="btn btn-success" :to="`/edit-stock/${product.id}`">Load</router-link>
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
        name: "home",

        created(){
            if(!User.loggedIn()){
                this.$router.push({name:'/'})
            }

        },
mounted(){
    this.TodaySell();
    this.TodayIncome();
    this.TodayExpense();
    this.TodayDue();
    this.getProduct();
},
        data(){
            return{
                todaysell:'',
                due:'',
                expense:'',
                todayincome:'',
                products:''
            }
        },

       methods:{
           TodaySell(){
               axios.get('/api/today-sell/')
                   .then(({data})=>this.todaysell=data)
           },
           TodayIncome(){
               axios.get('/api/today-income/')
                   .then(({data})=>this.todayincome=data)
           },
           TodayDue(){
               axios.get('/api/today-due/')
                   .then(({data})=>this.due=data)
           },
           TodayExpense(){
               axios.get('/api/today-expense/')
                   .then(({data})=>this.expense=data)
           },
           getProduct(){
               axios.get('/api/product-out')
                   .then(({data})=>this.products=data)
                   .catch()
           },
       },

    }
</script>

<style scoped>
    #photo{
        height:40px;
        width:40px
    }
</style>
