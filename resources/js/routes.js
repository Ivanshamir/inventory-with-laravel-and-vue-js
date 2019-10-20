let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
let home = require('./components/home.vue').default;

//employee component
let employee = require('./components/employee/index.vue').default;
let storeemployee = require('./components/employee/create.vue').default;
let editemployee = require('./components/employee/edit.vue').default;

//supplier component
let supplier = require('./components/supplier/index.vue').default;
let storesupplier = require('./components/supplier/create.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;

//category component
let category = require('./components/category/index.vue').default;
let storecategory = require('./components/category/create.vue').default;
let editcategory = require('./components/category/edit.vue').default;

//product component
let product = require('./components/product/index.vue').default;
let storeproduct = require('./components/product/create.vue').default;
let editproduct = require('./components/product/edit.vue').default;

//expense component
let expense = require('./components/expense/index.vue').default;
let storeexpense = require('./components/expense/create.vue').default;
let editexpense = require('./components/expense/edit.vue').default;

//salary component
let salary = require('./components/salary/all_employee.vue').default;
let paysalary = require('./components/salary/create.vue').default;
let allsalary = require('./components/salary/index.vue').default;
let viewsalary = require('./components/salary/view.vue').default;

//stock component
let stock = require('./components/product/stock.vue').default;
let editstock = require('./components/product/editstock.vue').default;

//customer component
let customer = require('./components/customer/index.vue').default;
let storecustomer = require('./components/customer/create.vue').default;
let editcustomer = require('./components/customer/edit.vue').default;

//pos
let pos = require('./components/pos/pointofsale.vue').default;

//order
let todayorder = require('./components/order/todayorder.vue').default;
let vieworder = require('./components/order/vieworder.vue').default;
let searchorder = require('./components/order/search.vue').default;

export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/logout', component: logout, name:'logout' },
    { path: '/home', component: home, name:'home' },
    { path: '/employee', component: employee, name:'employee' },
    { path: '/store-employee', component: storeemployee, name:'store-employee' },
    { path: '/edit-employee/:id', component: editemployee, name:'edit-employee' },
    { path: '/supplier', component: supplier, name:'supplier' },
    { path: '/store-supplier', component: storesupplier, name:'store-supplier' },
    { path: '/edit-supplier/:id', component: editsupplier, name:'edit-supplier' },
    { path: '/category', component: category, name:'category' },
    { path: '/store-category', component: storecategory, name:'store-category' },
    { path: '/edit-category/:id', component: editcategory, name:'edit-category' },
    { path: '/product', component: product, name:'product' },
    { path: '/store-product', component: storeproduct, name:'store-product' },
    { path: '/edit-product/:id', component: editproduct, name:'edit-product' },
    { path: '/expense', component: expense, name:'expense' },
    { path: '/store-expense', component: storeexpense, name:'store-expense' },
    { path: '/edit-expense/:id', component: editexpense, name:'edit-expense' },
    { path: '/given-salary', component: salary, name:'given-salary' },
    { path: '/pay-salary/:id', component: paysalary, name:'pay-salary' },
    { path: '/salary', component: allsalary, name:'salary' },
    { path: '/view-salary/:id', component: viewsalary, name:'view-salary' },
    { path: '/stock', component: stock, name:'stock' },
    { path: '/edit-stock/:id', component: editstock, name:'edit-stock' },
    { path: '/customer', component: customer, name:'customer' },
    { path: '/store-customer', component: storecustomer, name:'store-customer' },
    { path: '/edit-customer/:id', component: editcustomer, name:'edit-customer' },
    { path: '/pos', component: pos, name:'pos' },
    { path: '/today-order', component: todayorder, name:'today-order' },
    { path: '/view-order/:id', component: vieworder, name:'view-order' },
    { path: '/search-order', component: searchorder, name:'search-order' }
  ]