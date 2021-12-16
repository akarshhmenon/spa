/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");



window.Vue = require("vue").default;
window.bus = new Vue();
export const bus = new Vue();

import VueRouter from 'vue-router'

import 'datatables.net-dt'


import jsZip from 'jszip';

import 'pdfmake'
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;


import 'datatables.net-buttons-dt'
import 'datatables.net-bs4'
import 'datatables.net-buttons-bs4'

import 'datatables.net-buttons/js/buttons.html5.js'
import 'datatables.net-buttons/js/buttons.print.js'
import 'datatables.net-buttons/js/buttons.colVis.js'





//for-excel
window.JSZip = jsZip;





// This line was the one missing

import Multiselect from 'vue-multiselect'
// register globally
Vue.component('multiselect', Multiselect)




import vSelect from 'vue-select'

Vue.component('v-select', vSelect);
import 'vue-select/dist/vue-select.css';

import moment from "moment";
//for show date in correct format on vue component
Vue.filter("myDate", function (dateFormatted) {
    return moment(dateFormatted).format("DD - MM - YYYY");
});



import 'vue-search-select/dist/VueSearchSelect.css'






Vue.use(VueRouter);

import Swal from "sweetalert2";
window.Swal = Swal;



const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
});
window.Toast = Toast;

const routes = [
    // { path: "/", component: require("./components/dashboard.vue").default },

    // {
    //     path: "/products",
    //     component: require("./components/productsTable.vue").default,
    // },
    // {
    //     path: "/customers",
    //     component: require("./components/customersTable.vue").default,

    // },
    // {
    //     path: "/sales",
    //     component: require("./components/salesTable.vue").default,
    // },
    // {
    //     path: "/purchase",
    //     component: require("./components/purchaseTable.vue").default,
    // },
    // {
    //     path: "/expense-categories",
    //     component: require("./components/expenseCategoriesTable.vue").default,

    // },
    // {
    //     path: "/income-categories",
    //     component: require("./components/incomeCategoriesTable.vue").default,

    // },

    // {
    //     path: "/expenses",
    //     component: require("./components/expenses.vue").default,

    // },

    // {
    //     path: "/incomes",
    //     component: require("./components/incomes.vue").default,

    // },

    // {
    //     path: "/sales-report",
    //     component: require("./components/salesReport.vue").default,
    // },

    // {
    //     path: "/purchase-report",
    //     component: require("./components/purchaseReport.vue").default,
    // },
    // {
    //     path: "/credit-report",
    //     component: require("./components/creditReport.vue").default,
    // },
    // {
    //     path: "/stock-report",
    //     component: require("./components/stockReport.vue").default,
    // },
    // {
    //     path: "/payment-report",
    //     component: require("./components/paymentReport.vue").default,
    // },
    // {
    //     path: "/expense-report",
    //     component: require("./components/expenseReport.vue").default,
    // },
    // {
    //     path: "/income-report",
    //     component: require("./components/incomeReport.vue").default,
    // },
    // {
    //     path: "/item-report",
    //     component: require("./components/itemReport.vue").default,
    // },
    // {
    //     path: "/stock-adjustments",
    //     component: require("./components/stockAdjustmentsTable.vue").default,
    // },
    // {
    //     path: "/reward-sale",
    //     component: require("./components/rewardSaleTable.vue").default,
    // },

    // {
    //     path: "/employees",
    //     component: require("./components/employeeTable.vue").default,
    // },


    // {
    //     path: "/jobcard",
    //     component: require("./components/jobcardTable.vue").default,
    // },
];

const router = new VueRouter({

    routes, // short for `routes: routes`
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component("add-product", require("./components/addProduct.vue").default);
// Vue.component("add-customer", require("./components/addCustomer.vue").default);
// Vue.component("add-purchase", require("./components/addPurchase.vue").default);
// Vue.component("add-sale", require("./components/addSale.vue").default);
// Vue.component("add-adjustment", require("./components/addAdjustment.vue").default);

// Vue.component("add-expense-category", require("./components/addExpenseCategory.vue").default);
// Vue.component("add-income-category", require("./components/addIncomeCategory.vue").default);
// Vue.component("add-expense", require("./components/addExpense.vue").default);
// Vue.component("add-income", require("./components/addIncome.vue").default);

// Vue.component("view-transactions", require("./components/viewTransactionsTable.vue").default);
// Vue.component("add-payment", require("./components/addPayment.vue").default);
// Vue.component("add-reward-sale", require("./components/addRewardSale.vue").default);

// Vue.component("sales-invoice", require("./components/salesInvoice.vue").default);
// Vue.component("payment-receipt", require("./components/paymentReceipt.vue").default);


// Vue.component("add-employee", require("./components/addEmployee.vue").default);

// Vue.component("add-jobcard", require("./components/addJobcard.vue").default);


// Vue.component("invoice-test", require("./components/salesInvoiceTest.vue").default);



// Vue.component("add-purchase-test", require("./components/addPurchaseTest.vue").default);



// Vue.component("add-test", require("./components/test.vue").default);








// Vue.component("change-password", require("./components/changePassword.vue").default);

// Vue.component("loader", require("./components/Loading.vue").default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
});
