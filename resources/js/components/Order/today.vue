<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Today Order</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row card container">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Order Table
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
                                <th>Total</th>
                                <th>Pay</th>
                                <th>Due</th>
                                <th>PayBy</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="(order,index) in filterSearch" :key="order.id"  style="text-align: center">
                                <td>{{index+1}}</td>
                                <td>{{order.customer.name}}</td>
                                <td>{{order.total}}</td>
                                <td>{{order.pay}}</td>
                                <td>{{order.due}}</td>
                                <td>{{order.payby}}</td>
                                <td>
                                    <router-link  class="btn btn-success" :to="`/view-order/${order.id}`">View</router-link>
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
        name: "today",
        data(){
            return{
                orders:[],
                searchTerm:'',
            }
        },
        methods:{
            getOrder(){
                axios.get('/api/order')
                    .then(({data})=>this.orders=data)
                    .catch()
            }
        },
        created(){
            this.getOrder()
        },
        computed:{
            filterSearch(){
                return this.orders.filter(order=>{
                    return  order.order_date.match(this.searchTerm)
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
