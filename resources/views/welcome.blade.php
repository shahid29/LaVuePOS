
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inventory</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- Custom fonts for this template-->
    <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('backend/css/sb-admin.css')}}" rel="stylesheet">

</head>

<body id="page-top">
<div id="app">
<nav class="navbar navbar-expand navbar-dark bg-dark static-top" id="topnav" style="display: none;" v-show="$route.path==='/'
|| $route.path==='/register' || $route.path==='/forget' ? flase:true">

    <a class="navbar-brand mr-1" href="index.html">Start Bootstrap</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger">9+</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger">7</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <router-link class="dropdown-item" to="/logout" data-toggle="modal" data-target="#logoutModal">Logout</router-link>
            </div>
        </li>
    </ul>

</nav>

<div id="wrapper" >

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav" id="sidenav" style="display: none"  v-show="$route.path==='/'
|| $route.path==='/register' || $route.path==='/forget' ? flase:true">
        <li class="nav-item active">
            <router-link class="nav-link" to="/home">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" to="/pos">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span style="color: red">POS</span>
            </router-link>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Employee</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <router-link class="dropdown-item" to="/add-employee">Add Employee</router-link>
                <router-link class="dropdown-item" to="/all-employee">All Employee</router-link>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Supplier</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <router-link class="dropdown-item" to="/add-supplier">Add Supplier</router-link>
                <router-link class="dropdown-item" to="/all-supplier">All Supplier</router-link>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Customer</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <router-link class="dropdown-item" to="/add-customer">Add Customer</router-link>
                <router-link class="dropdown-item" to="/all-customer">All Customer</router-link>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Category</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <router-link class="dropdown-item" to="/add-category">Add Category</router-link>
                <router-link class="dropdown-item" to="/all-category">All Category</router-link>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Product</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <router-link class="dropdown-item" to="/add-product">Add Product</router-link>
                <router-link class="dropdown-item" to="/all-product">All Product</router-link>
            </div>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" to="/stock">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Product Stock</span></router-link>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Expense</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <router-link class="dropdown-item" to="/add-expense">Add Expense</router-link>
                <router-link class="dropdown-item" to="/all-expense">All Expense</router-link>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Order</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <router-link class="dropdown-item" to="/today-order">Today</router-link>
                <router-link class="dropdown-item" to="/search">Search</router-link>
            </div>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Salary</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <router-link class="dropdown-item" to="/given-salary">Salary</router-link>
            <router-link class="dropdown-item" to="/all-salary">All Salary</router-link>
        </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">


    <router-view></router-view>


        </div>

    </div>
    <!-- /.content-wrapper -->

</div>
</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="{{asset('js/app.js')}}"></script>
<script>
    let token = localStorage.getItem('token');
    if(token){
        $('#topnav').css('display','');
        $('#sidenav').css('display','');
    }
</script>
<script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
{{--<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}

<!-- Core plugin JavaScript-->
<script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Page level plugin JavaScript-->
<script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('backend/js/sb-admin.min.js')}}"></script>

<!-- Demo scripts for this page-->
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
<script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>

</body>

</html>
