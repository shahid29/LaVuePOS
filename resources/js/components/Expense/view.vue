<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Expense</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row card container">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Expense Insert
                <router-link to="/add-expense" id="emp_add"  class="btn btn-sm btn-info" > Add New</router-link>
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
                                <th>Details</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="(expense,index) in filterSearch" :key="expense.id"  style="text-align: center">
                                <td>{{index+1}}</td>
                                <td>{{expense.details}}</td>
                                <td>{{expense.amount}}</td>
                                <td>{{expense.expense_date}}</td>
                                <td>
                                    <router-link  class="btn btn-success" :to="`/edit-expense/${expense.id}`">Edit</router-link>
                                    <a @click.prevent="deleteExpenseById(expense.id)" class="btn btn-danger" href="">Delete</a>
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
                expenses:[],
                searchTerm:''
            }
        },
        methods:{
            getExpense(){
                axios.get('/api/expense')
                    .then(({data})=>this.expenses=data)
                    .catch()
            },
            deleteExpenseById(id) {
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
                        axios.delete('/api/expense/' + id)
                            .then(() => {
                                this.getExpense();
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
            this.getExpense()
        },
        computed:{
            filterSearch(){
               return this.expenses.filter(expense=>{
                 return   expense.expense_date.match(this.searchTerm)
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
