let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register').default;
let logout = require('./components/auth/logout').default;
let forget = require('./components/auth/forget').default;
//----------End Authentication-------------

//----------home------------------
let home = require('./components/home').default;

//---------Employee---------------------
let add_employee = require('./components/Employee/create').default;
let all_employee = require('./components/Employee/view').default;
let edit_employee = require('./components/Employee/edit').default;

//---------Supplier---------------------
let add_supplier = require('./components/Supplier/create').default;
let all_supplier = require('./components/Supplier/view').default;
let edit_supplier = require('./components/Supplier/edit').default;

//---------Customer---------------------
let add_customer = require('./components/Customer/create').default;
let all_customer= require('./components/Customer/view').default;
let edit_customer = require('./components/Customer/edit').default;

//---------Category---------------------
let add_category = require('./components/Category/create').default;
let all_category = require('./components/Category/view').default;
let edit_category = require('./components/Category/edit').default;

//---------Product---------------------
let add_product = require('./components/Product/create').default;
let all_product = require('./components/Product/view').default;
let edit_product = require('./components/Product/edit').default;
let stock_product = require('./components/Product/product_stock').default;
let edit_stock = require('./components/Product/edit_stock').default;

//---------Expense---------------------
let add_expense = require('./components/Expense/create').default;
let all_expense = require('./components/Expense/view').default;
let edit_expense = require('./components/Expense/edit').default;

//---------Salary---------------------
let given_salary = require('./components/Salary/employee').default;
let pay_salary = require('./components/Salary/pay_salary').default;
let all_salary = require('./components/Salary/all_salary').default;
let view_salary = require('./components/Salary/view_salary_byMonth').default;
let edit_salary = require('./components/Salary/edit').default;

//--------------POS---------------------
let pos = require('./components/Pos/pos').default;

//-------------Order-------------
let order = require('./components/Order/today').default;
let viewdetails = require('./components/Order/viewdetails').default;
let search = require('./components/Order/search').default;


export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name:'/register' },
    { path: '/logout', component: logout, name:'/logout' },
    { path: '/forget', component: forget, name:'/forget' },
    { path: '/home', component: home, name:'/home' },


    //------------Employee
    { path: '/add-employee', component: add_employee, name:'/add_employee' },
    { path: '/all-employee', component: all_employee, name:'/all_employee' },
    { path: '/edit-employee/:id', component: edit_employee, name:'/edit_employee' },

    //------------Supplier
    { path: '/add-supplier', component: add_supplier, name:'/add_supplier' },
    { path: '/all-supplier', component: all_supplier, name:'/all_supplier' },
    { path: '/edit-supplier/:id', component: edit_supplier, name:'/edit_supplier' },

    //------------Customer
    { path: '/add-customer', component: add_customer, name:'/add_customer' },
    { path: '/all-customer', component: all_customer, name:'/all_customer' },
    { path: '/edit-customer/:id', component: edit_customer, name:'/edit_customer' },

    //------------Category
    { path: '/add-category', component: add_category, name:'/add_category' },
    { path: '/all-category', component: all_category, name:'/all_category' },
    { path: '/edit-category/:id', component: edit_category, name:'/edit_category' },

    //------------Product
    { path: '/add-product', component: add_product, name:'/add_product' },
    { path: '/all-product', component: all_product, name:'/all_product' },
    { path: '/edit-product/:id', component: edit_product, name:'/edit_product' },
    { path: '/stock', component: stock_product, name:'/stock_product' },
    { path: '/edit-stock/:id', component: edit_stock, name:'/edit_stock' },

    //------------Expense
    { path: '/add-expense', component: add_expense, name:'/add_expense' },
    { path: '/all-expense', component: all_expense, name:'/all_expense' },
    { path: '/edit-expense/:id', component: edit_expense, name:'/edit_expense' },

    //------------Salary
    { path: '/given-salary', component: given_salary, name:'/given_salary' },
    { path: '/pay-salary/:id', component: pay_salary, name:'/pay_salary' },
    { path: '/all-salary', component: all_salary, name:'/all_salary' },
    { path: '/view-salary/:id', component: view_salary, name:'/view_salary' },
    { path: '/edit-salary/:id', component: edit_salary, name:'/edit_salary' },

    //----------POS
    { path: '/pos', component: pos, name:'/pos' },

    //----------Order
    { path: '/today-order', component: order, name:'/order' },
    { path: '/view-order/:id', component: viewdetails, name:'/viewdetails' },
    { path: '/search', component: search, name:'/search' },
]
