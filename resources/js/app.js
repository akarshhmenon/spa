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


//multiple image upload
import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)


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

Vue.filter('formatDate', function(value) {
    return moment(value).format("dddd");
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
    { path: "/", component: require("./components/dashboard/dashboard.vue").default },
    { path: "/customer", component: require("./components/masters/customer/CustomerTable.vue").default },
    { path: "/category", component: require("./components/masters/category/CategoryTable.vue").default },
    { path: "/designation", component: require("./components/masters/designation/DesignationTable.vue").default },
    { path: "/service", component: require("./components/masters/service/ServiceTable.vue").default },
    { path: "/product", component: require("./components/masters/product/ProductTable.vue").default },
    { path: "/employee", component: require("./components/masters/employee/EmployeeTable.vue").default },
    
     { path: "/attendance", component: require("./components/operations/attendance/AttendanceTable.vue").default },
     { path: "/attendance-report", component: require("./components/reports/AttendanceReport.vue").default },

     { path: "/images", component: require("./components/masters/image/ImageTable.vue").default },

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















Vue.component("change-password", require("./components/etc/changePassword.vue").default);

Vue.component("pre-loader", require("./components/etc/Loading.vue").default);
Vue.component("add-category", require("./components/masters/category/Category.vue").default);
Vue.component("add-designation", require("./components/masters/designation/Designation.vue").default);
Vue.component("add-service", require("./components/masters/service/Service.vue").default);
Vue.component("add-product", require("./components/masters/product/Product.vue").default);
Vue.component("add-employee", require("./components/masters/employee/Employee.vue").default);
Vue.component("add-customer", require("./components/masters/customer/Customer.vue").default);
Vue.component("add-booking", require("./components/booking/Booking.vue").default);

Vue.component("add-employee-attendance", require("./components/operations/attendance/Attendance.vue").default);
Vue.component("add-image", require("./components/masters/image/Image.vue").default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
});
