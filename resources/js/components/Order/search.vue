<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Search Order</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row container">
            <div class="card col-lg-12">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Search Orders
                    <router-link to="/today-order" class="btn btn-sm btn-info" id="add_new"> Today Order</router-link>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <form @submit.prevent="searchDate()">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect2">Search By Date</label>
                                                <input type="date" required="" class="form-control" v-model="form.date">
                                            </div>
                                        </div><br>
                                        <button type="submit" class="btn btn-success">Search</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form @submit.prevent="searchMonth()">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect2">Search By Month</label>
                                                <select  class="form-control" id="exampleFormControlSelect2" v-model="form.month">
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="june">june</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                            </div>
                                        </div><br>
                                        <button type="submit" class="btn btn-success">Search</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <label>Search Result</label><br>
                        <table class="table table-bordered" id="" width="100%" cellspacing="0">

                            <thead>
                            <tr style="text-align: center">
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Pay</th>
                                <th>Due</th>
                                <th>PayBy</th>
                                <th>Date</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="(order,index) in orders" :key="order.id"  style="text-align: center">
                                <td>{{index+1}}</td>
                                <td>{{order.customer.name}}</td>
                                <td>{{order.qty}}</td>
                                <td>{{order.total}}</td>
                                <td>{{order.pay}}</td>
                                <td>{{order.due}}</td>
                                <td>{{order.payby}}</td>
                                <td>{{order.order_date}}</td>
                            </tr>

                            </tbody>
                            <tfoot>
                            <tr style="text-align: center" >
                                <td style="border: none"></td>
                                <td style="border: none"></td>
                                <td>Total: {{quantity}} Ps</td>
                                <td>Total: {{Total}} Tk</td>
                                <td>Pay: {{Pay}} Tk</td>
                                <td>Due: {{Due}} Tk</td>
                            </tr>
                            </tfoot>
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
        name: "search",

        data(){
            return{
                form:{
                   date:'',
                    month:''
                },
                orders:''
            }
        },

        computed:{
          quantity(){
              let sum=0;
              let i=0;
              for (i;i<this.orders.length;i++){
                  sum+=parseFloat((this.orders[i].qty))
              }
              return sum;
          },
            Total(){
                let sum = 0;
                let i=0;
                for (i;i<this.orders.length;i++){
                    sum+=parseFloat(this.orders[i].total)
                }
                return sum;
            },
            Pay(){
                let sum = 0;
                let i=0;
                for (i;i<this.orders.length;i++){
                    sum+=parseFloat(this.orders[i].pay)
                }
                return sum;
            },
            Due(){
                let sum = 0;
                let i=0;
                for (i;i<this.orders.length;i++){
                    sum+=parseFloat(this.orders[i].due)
                }
                return sum;
            },
        },

        methods:{
            searchDate(){
                axios.post('/api/search/date',this.form)
                    .then(({data})=>this.orders=data)
                    .catch(error => this.errors = error.response.data.errors)
            },

            searchMonth(){
                axios.post('/api/search/month',this.form)
                    .then(({data})=>this.orders=data)
                    .catch(error => this.errors = error.response.data.errors)
            },
        }



    }
</script>

<style scoped>
    #add_emp{
        float: right;
    }
</style>
