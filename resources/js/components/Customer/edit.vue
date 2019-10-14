<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Customer</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row container">
            <div class="card col-lg-12">
                <div class="card-header">
                    <i  class="fas fa-chart-area"></i>
                    Customer Update
                    <router-link to="/all-customer"  class="btn btn-sm btn-info" id="add_emp"> All Customer</router-link>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" @submit.prevent="customerUpdate()">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input id="firstName" v-model="form.name" type="text" class="form-control">
                                        <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                                        <label for="firstName">Full Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input v-model="form.email" id="lastName" type="text" class="form-control" >
                                        <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                                        <label for="lastName">Email</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input v-model="form.phone" type="text" class="form-control">
                                        <label for="lastName">Phone</label>
                                        <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input v-model="form.address" type="text" class="form-control">
                                        <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                                        <label for="firstName">Address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-8">
                                    <div class="form-label-group">
                                        <input @change="changePhoto($event)" name="photo[]" type="file"  class="btn btn-info">

                                        <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
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
                    name:'',
                    email:'',
                    address:'',
                    phone:'',
                    newphoto:'',
                    photo:''

                },
                errors:{}
            }
        },
        created(){
            let id = this.$route.params.id;
                axios.get('/api/customer/'+id)
                    .then(({data})=>this.form=data)
                    .catch()
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
                        this.form.newphoto =event.target.result
                        this.form.photo =event.target.result
                    };

                    reader.readAsDataURL(file);
                }

            },
            updateImage(){
                let img = this.form.photo;
                if (img.length>100){
                    return this.form.photo
                }else {
                    return  `/${ this.form.photo}`
                }
            },
            customerUpdate(){
                let id = this.$route.params.id;
                axios.patch('/api/customer/'+id,this.form)
                    .then(res=>{
                        this.$router.push('/all-customer')
                        Toast.fire({
                            type: 'success',
                            title: 'Customer Update Successfully'
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
