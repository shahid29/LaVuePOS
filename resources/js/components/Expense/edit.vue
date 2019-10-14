<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Expense</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row container">
            <div class="card col-lg-12">
                <div class="card-header">
                    <i  class="fas fa-chart-area"></i>
                    Expense Update
                    <router-link to="/all-category"  class="btn btn-sm btn-info" id="add_emp"> All Expense</router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="expenseUpdate()">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="firstName">Expense Details</label>
                                        <textarea id="firstName1" rows="3" v-model="form.details" type="text" class="form-control" />
                                        <small class="text-danger" v-if="errors.details">{{errors.details[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input id="firstName" v-model="form.amount" type="text" class="form-control">
                                        <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>
                                        <label for="firstName">Expense Amount</label>
                                    </div>
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
                    details:'',
                    amount:'',

                },
                errors:{}
            }
        },
        created(){
            let id = this.$route.params.id;
                axios.get('/api/expense/'+id)
                    .then(({data})=>this.form=data)
                    .catch()
        },
        methods:{
            expenseUpdate(){
                let id = this.$route.params.id;
                axios.patch('/api/expense/'+id,this.form)
                    .then(res=>{
                        this.$router.push('/all-expense')
                        Toast.fire({
                            type: 'success',
                            title: 'Expense Update Successfully'
                        })
                    })
                    .catch(error=>this.errors=error.response.data.errors)
            }
        }



    }
</script>

<style scoped>
    #add_emp{
        float: right;
    }
</style>
